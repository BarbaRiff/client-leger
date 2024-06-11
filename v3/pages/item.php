<?php 
    require_once("db.php");
    $itemId = $_GET["id"];
    $sql = "SELECT * FROM coque JOIN `motif` ON coque.Id_motif = motif.Id_motif AND coque.Id_Coque = " . $itemId . " JOIN `modele` ON coque.Id_modele = modele.Id_modele";
    $itemResult = mysqli_query($db_connec, $sql);
    $item = mysqli_fetch_assoc($itemResult);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/item.css?=1584529395">
    <link rel="stylesheet" href="../assets/css/main.css?=1584529395">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo Bhai">
    <title>Motion Case | <?= $item["motif"] ?></title>
</head>
<body>
    <?php 
        include("functions.php");
        if (isset($_POST["searchBar"])) {
            header("Location: ../index.php");
        }
    ?>

    <nav>
        <div class="navbar-container">
            <div class="logo">
                <a href="../index.php"><h1>Motion Case</h1></a>
            </div>
            <div class="search">
                <form method="post">
                    <i class="fas fa-search"></i>
                    <input name="searchBar" type="text" placeholder="Search...">
                </form>
            </div>
            <ul>
                <li><a id="login" href="login.php"><i class="fas fa-user-alt"></i></a></li>
                <li><a id="cart" href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="images">
            <img id='mainImage' class='image' src='../assets/images/items/<?= $itemId ?>/principal.jpg'>
                <img class='image' src='../assets/images/items/<?= $itemId ?>/principal.jpg'>
                <img class='image' src='../assets/images/items/<?= $itemId ?>/second.jpg'>
                <img class='image' src='../assets/images/items/<?= $itemId ?>/third.jpg'>
                <img class='image' src='../assets/images/items/<?= $itemId ?>/fourth.jpg'>
                <img class='image' src='../assets/images/items/<?= $itemId ?>/fifth.jpg'>
                </div>

<div class="details-container">
    <h2><?= $item["motif"] ?></h2>
    <p><?= $item["modele"] ?></p>
    <p>Prix : <?= $item["Prix"] ?>€</p>
    <p>Description : <?= $item["description"] ?></p>
    <form method="post">
        <label for="iphoneModel">Modèle d'iPhone :</label>
        <select id="iphoneModel" name="iphoneModel">
            <?php
                // Récupérer les différents modèles d'iPhone depuis la base de données
                $sql_modele = "SELECT * FROM modele";
                $result_modele = mysqli_query($db_connec, $sql_modele);
                while ($row_modele = mysqli_fetch_assoc($result_modele)) {
                    echo "<option value='" . $row_modele['modele'] . "'>" . $row_modele['modele'] . "</option>";
                }
            ?>
        </select>
</div>
</div>

<script src="../assets/js/item.js?=1584529395"></script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
</body>
</html>