<?php
include_once("db.php");

// Créer le panier s'il n'existe pas
function CreateCart(){
    if (!isset($_SESSION['panier'])){
        $_SESSION['panier'] = array();
        $_SESSION['panier']['libelleProduit'] = array();
        $_SESSION['panier']['qteProduit'] = array();
        $_SESSION['panier']['prixProduit'] = array();
        $_SESSION['panier']['verrou'] = false;
    }
    return true;
}

// Récupérer le panier
function GetCart() {
    return isset($_SESSION['panier']) ? $_SESSION['panier'] : array();
}

// Ajouter un article au panier
function AddToCart($id) {
    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]++;
    } else {
        $_SESSION['panier'][$id] = 1;
    }
}

// Supprimer un article du panier
function RemoveFromCart($id) {
    if (isset($_SESSION['panier'][$id])) {
        unset($_SESSION['panier'][$id]);
    }
}

// Obtenir le nombre total d'articles dans le panier
function GetCartCount() {
    $count = 0;
    foreach ($_SESSION['panier'] as $key => $value) {
        $count += $value;
    }
    return $count;
}

// Vérifier si l'utilisateur existe
function CheckIfUserExist($type) {
    global $db_connec;

    $password = hash('sha256', $_POST["password"]);
    $sql = "SELECT * FROM `customer` WHERE login = ? AND mdp = ?";
    $stmt = $db_connec->prepare($sql);
    $stmt->bind_param('ss', $_POST[$type], $password);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0;
}

// Connecter l'utilisateur
function LoginUser() {
    if (CheckIfUserExist("username")) {
        global $db_connec;

        $password = hash('sha256', $_POST["password"]);
        $sql = "SELECT * FROM `customer` WHERE login = ? AND mdp = ?";
        $stmt = $db_connec->prepare($sql);
        $stmt->bind_param('ss', $_POST["username"], $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id_customer'];
            $_SESSION['login'] = true;
            return true;
        } else {
            header("Location: pages/login.php?erreur=1");
            exit();
        }
    } else {
        header("Location: pages/login.php?erreur=1");
        exit();
    }
}

// Créer un nouvel utilisateur
function CreateNewUser() {
    if (!CheckIfUserExist("login")) {
        global $db_connec;

        $password = hash('sha256', $_POST["password"]);
        $sql = "INSERT INTO `customer` (login, mdp, mail, nom, prenom, admin) VALUES (?, ?, ?, ?, 'Test', 0)";
        $stmt = $db_connec->prepare($sql);
        $stmt->bind_param('ssss', $_POST["login"], $password, $_POST["email"], $_POST["name"]);
        if ($stmt->execute()) {
            error_log("Debug: Missing required fields.");
            header("Location: ../index.php");
            exit();
        } else {
            error_log("Debug: Missing required fields.");
            header("Location: pages/login.php?erreur=2");
            exit();
        }
    }
}

// Ajouter un article au panier
function AddItemToCart($libelleProduit, $qteProduit, $prixProduit){
    // Si le panier existe
    if (CreateCart() && !IsLocked()) {
        // Si le produit existe déjà on ajoute seulement la quantité
        $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

        if ($positionProduit !== false) {
            $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;
        } else {
            // Sinon on ajoute le produit
            array_push($_SESSION['panier']['libelleProduit'], $libelleProduit);
            array_push($_SESSION['panier']['qteProduit'], $qteProduit);
            array_push($_SESSION['panier']['prixProduit'], $prixProduit);
        }
    } else {
        echo "Un problème est survenu, veuillez contacter l'administrateur du site.";
    }
}

// Supprimer un article du panier
function DeleteItemFromCart($libelleProduit){
    // Si le panier existe
    if (CreateCart() && !IsLocked()) {
        // Nous allons passer par un panier temporaire
        $tmp = array();
        $tmp['libelleProduit'] = array();
        $tmp['qteProduit'] = array();
        $tmp['prixProduit'] = array();
        $tmp['verrou'] = $_SESSION['panier']['verrou'];

        for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) {
            if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit) {
                array_push($tmp['libelleProduit'], $_SESSION['panier']['libelleProduit'][$i]);
                array_push($tmp['qteProduit'], $_SESSION['panier']['qteProduit'][$i]);
                array_push($tmp['prixProduit'], $_SESSION['panier']['prixProduit'][$i]);
            }
        }
        // On remplace le panier en session par notre panier temporaire à jour
        $_SESSION['panier'] = $tmp;
        // On efface notre panier temporaire
        unset($tmp);
    } else {
        echo "Un problème est survenu, veuillez contacter l'administrateur du site.";
    }
}

// Modifier la quantité d'un article dans le panier
function EditQtqOfItem($libelleProduit, $qteProduit){
    // Si le panier existe
    if (CreateCart() && !IsLocked()) {
        // Si la quantité est positive on modifie sinon on supprime l'article
        if ($qteProduit > 0) {
            // Recherche du produit dans le panier
            $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

            if ($positionProduit !== false) {
                $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
            }
        } else {
            DeleteItemFromCart($libelleProduit);
        }
    } else {
        echo "Un problème est survenu, veuillez contacter l'administrateur du site.";
    }
}

// Calculer le montant total du panier
function MontantGlobal(){
    $total = 0;
    for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) {
        $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
    }
    return $total;
}

// Vérifier si le panier est verrouillé
function IsLocked(){
    return isset($_SESSION['panier']) && $_SESSION['panier']['verrou'];
}

// Compter le nombre d'articles dans le panier
function CountItems() {
    return isset($_SESSION['panier']) ? count($_SESSION['panier']['libelleProduit']) : 0;
}

// Supprimer le panier
function DeleteCart(){
    unset($_SESSION['panier']);
}
?>
