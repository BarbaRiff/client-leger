<?php
session_start();
include_once("functions.php");

$erreur = false;

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null);
// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Vérifiez si l'action est définie
if ($action !== null) {
    // Votre code d'action ici
}

// Votre code HTML et PHP pour afficher le panier ici
if ($action !== null) {
    if (!in_array($action, array('ajout', 'suppression', 'refresh'))) {
        $erreur = true;
    }

    $l = isset($_POST['l']) ? $_POST['l'] : (isset($_GET['l']) ? $_GET['l'] : null);
    $p = isset($_POST['p']) ? $_POST['p'] : (isset($_GET['p']) ? $_GET['p'] : null);
    $q = isset($_POST['q']) ? $_POST['q'] : (isset($_GET['q']) ? $_GET['q'] : null);

    $l = preg_replace('#\v#', '', $l);
    $p = floatval($p);

    if (is_array($q)) {
        $QteArticle = array();
        $i = 0;
        foreach ($q as $contenu) {
            $QteArticle[$i++] = intval($contenu);
        }
    } else {
        $q = intval($q);
    }
    if(!isset($_GET["1"])) header("location:../index.php");
    if(!isset($_GET["p"])) header("location: cart.php");
}

if (!$erreur) {
    switch ($action) {
        case "ajout":
            AddItemToCart($l, $q, $p);
            break;
        case "suppression":
            DeleteItemFromCart($l);
            break;
        case "refresh":
            for ($i = 0; $i < count($QteArticle); $i++) {
                EditQtqOfItem($_SESSION['panier']['libelleProduit'][$i], round($QteArticle[$i]));
            }
            break;
        default:
            break;
    }

}

echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre panier</title>
    <link rel="stylesheet" href="/E5/v3/assets/css/cart.css">
</head>
<body>
    <div class="cart-container">
        <form method="post" action="cart.php">
            <table>
                <tr>
                    <th colspan="4">Votre panier</th>
                </tr>
                <tr>
                    <th>Libellé</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Action</th>
                </tr>
                <?php
                if (CreateCart()) {
                    $nbArticles = count($_SESSION['panier']['libelleProduit']);
                    if ($nbArticles <= 0) {
                        echo "<tr><td colspan='4'>Votre panier est vide</td></tr>";
                    } else {
                        for ($i = 0; $i < $nbArticles; $i++) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]) . "</td>";
                            echo "<td><input type='text' size='4' name='q[]' value='" . htmlspecialchars($_SESSION['panier']['qteProduit'][$i]) . "'/></td>";
                            echo "<td>" . htmlspecialchars($_SESSION['panier']['prixProduit'][$i]) . "€</td>";
                            echo "<td><a href='cart.php?action=suppression&l=" . rawurlencode($_SESSION['panier']['libelleProduit'][$i]) . "'>Supprimer</a></td>";
                            echo "</tr>";
                        }
                        echo "<tr><td colspan='2'></td>";
                        echo "<td colspan='2'>Total : " . MontantGlobal() . "€</td></tr>";
                        echo "<tr><td colspan='4'>";
                        echo "<input type='submit' value='Rafraîchir'/>";
                        echo "<input type='hidden' name='action' value='refresh'/>";
                        echo "</td></tr>";
                    }
                }
               
                ?>
            </table>
            <div class="btn-container">
                <a href="../index.php" class="btn-return">Retour</a>
            </div>
        </form>
    </div>
</body>
</html>
