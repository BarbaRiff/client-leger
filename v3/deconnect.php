<?php
session_start();
include_once("pages/functions.php");
require("pages/db.php");

// Vérifier si la connexion à la base de données est établie
if (!$db_connec) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Initialiser l'ID du client à 0
$id_customer = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 0;

// Affichage de l'ID client pour débogage
echo "ID client : " . $id_customer . "<br>";

// Sauvegarde du panier dans la base de données
if (isset($_SESSION['login']) && isset($_SESSION['panier'])) {
    // Vérifier si le panier n'est pas vide
    if (!empty($_SESSION['panier']['libelleProduit'])) {
        // Parcourir les produits dans le panier
        $stmt = $db_connec->prepare("INSERT INTO cart (id_customer, libelleProduit, qteProduit, prixProduit, date_ajout) VALUES (?, ?, ?, ?, NOW())");

        foreach ($_SESSION['panier']['libelleProduit'] as $key => $libelleProduit) {
            // Récupérer la quantité et le prix du produit
            $qteProduit = $_SESSION['panier']['qteProduit'][$key];
            $prixProduit = $_SESSION['panier']['prixProduit'][$key];

            // Affichage des détails du produit pour débogage
            echo "Produit : $libelleProduit, Quantité : $qteProduit, Prix : $prixProduit<br>";

            // Préparer la requête d'insertion dans la table cart
            $stmt->bind_param('isid', $id_customer, $libelleProduit, $qteProduit, $prixProduit);
            
            // Exécuter la requête d'insertion
            if ($stmt->execute()) {
                echo "Enregistrement inséré avec succès pour $libelleProduit.<br>";
            } else {
                echo "Erreur lors de l'insertion de l'enregistrement pour $libelleProduit : " . $stmt->error . "<br>";
            }
        }
        $stmt->close();
    } else {
        echo "Le panier est vide.<br>";
    }
}

// Sauvegarder l'ID du client dans une variable temporaire avant de détruire la session
$id_temp = $id_customer;

// Destruction de la session
session_destroy();

// Utiliser l'ID du client sauvegardé pour une déconnexion dans la table cart
if ($id_temp != 0) {
    // Préparer la requête d'insertion dans la table cart
    $stmt = $db_connec->prepare("INSERT INTO cart (id_customer, libelleProduit, qteProduit, prixProduit, date_ajout) VALUES (?, 'Déconnexion', 0, 0, NOW())");
    $stmt->bind_param('i', $id_temp);
    
    // Exécuter la requête d'insertion
    if ($stmt->execute()) {
        echo "Enregistrement de déconnexion inséré avec succès.<br>";
    } else {
        echo "Erreur lors de l'insertion de l'enregistrement de déconnexion : " . $stmt->error . "<br>";
    }
    
    $stmt->close();
}

// Rediriger l'utilisateur vers la page de connexion
header("Location: pages/login.php");
exit();
?>
