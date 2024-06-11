<?php 
require_once("pages/db.php");
include("pages/functions.php");
session_start();
$id_session = session_id();

// Vérifiez la connexion à la base de données
if (!$db_connec) {
    die("Connection failed: " . mysqli_connect_error());
}

$requestSqlForGetItems = "SELECT * FROM `coque` JOIN `motif` ON coque.Id_motif = motif.Id_motif JOIN `modele` ON coque.Id_modele = modele.Id_modele";
$result = mysqli_query($db_connec, $requestSqlForGetItems);

if (!$result) {
    die("Query failed: " . mysqli_error($db_connec));
}

if (isset($_POST["username"])) {
    if (LoginUser()) {
        $_SESSION['login'] = $_POST['username'];
        $req = "SELECT * FROM customer WHERE login='" . mysqli_real_escape_string($db_connec, $_SESSION['login']) . "'";
        $res = mysqli_query($db_connec, $req);
        
        if ($res && mysqli_num_rows($res) > 0) {
            $ligne = mysqli_fetch_assoc($res);
            $_SESSION["admin"] = $ligne["admin"];
            $login = $_SESSION['login'];

            $req = "INSERT INTO connexions (login, datedeb) VALUES ('$login', NOW())";
            mysqli_query($db_connec, $req);

            $req = "SELECT MAX(id) as maxi FROM connexions";
            $res = mysqli_query($db_connec, $req);

            if ($res) {
                $ligne = mysqli_fetch_assoc($res);
                $_SESSION["id"] = $ligne["maxi"];
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/main.css?=1584529395">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo+Bhai">
    <title>Motion Case | Main</title>
</head>
<body>
    <nav>
        <div class="navbar-container">
            <div class="logo">
                <a href="index.php"><h1>Motion Case</h1></a>
            </div>
            <div class="search">
                <form method="post">
                    <i class="fas fa-search"></i>
                    <input name="searchBar" type="text" placeholder="Search...">
                </form>
            </div>
            <?php if(isset($_SESSION['login'])): ?>
                <a href="deconnect.php" class="btn-nav">Déconnexion</a>
                <?php if($_SESSION["admin"] == 1): ?>
                    <!--<a href='pages/admin.php' class="btn-nav">LOGS</a>-->
                <?php endif; ?>
                <a href="#" class="btn-nav"><?php echo $_SESSION["login"]; ?></a>
            <?php else: ?>
                <a href="pages/login.php" class="btn-nav">Connexion</a>
            <?php endif; ?>
            <a href="pages/cart.php" class="btn-nav"><i class="fas fa-shopping-cart"></i></a>
        </div>
    </nav>
    <div class="main-container">
        <?php
            if (isset($_POST["login"])) {
                CreateNewUser();
            }

            if (isset($_POST["searchBar"])) {
                $request = mysqli_real_escape_string($db_connec, $_POST["searchBar"]);
                $sql = "SELECT * FROM `coque` JOIN `motif` ON coque.Id_motif = motif.Id_motif JOIN `modele` ON coque.Id_modele = modele.Id_modele WHERE motif.motif LIKE '%$request%'";
                $result = mysqli_query($db_connec, $sql);
                
                if (!$result || mysqli_num_rows($result) == 0) {
                    echo '<div class="titleError">Aucun résultat pour votre recherche</div>';
                }
            }

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="item">';
                    echo '<div class="item-img">';
                    echo '<a href="pages/item.php?id='.$row['Id_Coque'].'">';
                    echo '<img src="assets/images/items/'.$row['Id_Coque'].'/principal.jpg">';
                    echo '</a>';
                    echo '</div>';      
                    echo '<div class="item-info">';
                    echo '<h2>'.$row['motif'].'</h2>';
                    echo '<p>'.$row['modele'].'</p>';
                    echo '<p>Prix: '.$row['Prix'].'€</p>';
                    echo '</div>';
                    echo '<input type="button" onclick="location.href=`pages/cart.php?action=ajout&amp;l='.$row['motif'].'&amp;q=1&amp;p='.$row['Prix'].'`" value="Ajouter au panier">';
                    echo '</div>';
                }
            }
        ?>
    </div>
    <script src="../assets/js/main.js"></script>
</body>
</html>
