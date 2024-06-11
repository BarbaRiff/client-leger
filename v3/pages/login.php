<?php
session_start();
include_once("functions.php");

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION["login"])) {
    // Vérifier si l'utilisateur a des données de panier dans la base de données
    $id_customer = $_SESSION["user_id"];
    $sql = "SELECT * FROM cart WHERE id_customer = '$id_customer'";
    $result = mysqli_query($db_connec, $sql);

    // Si des données de panier existent dans la base de données, les charger dans la session
    if (mysqli_num_rows($result) > 0) {
        // Réinitialiser le panier dans la session
        DeleteCart();

        // Récupérer les données de panier depuis la base de données et les stocker dans la session
        while ($row = mysqli_fetch_assoc($result)) {
            AddItemToCart($row['libelleProduit'], $row['qteProduit'], $row['prixProduit']);
        }
    }

    // Rediriger vers la page principale
    header("Location: ../index.php");
    exit();
}

// Vérifie si la méthode de requête est POST (pour le formulaire de connexion)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require("db.php");

    // Échappe les caractères spéciaux pour éviter les injections SQL
    $username = mysqli_real_escape_string($db_connec, $_POST["username"]);
    $password = hash('sha256', $_POST["password"]);

    // Requête SQL pour vérifier les informations de connexion dans la base de données
    $sql = "SELECT * FROM `customer` WHERE login = ? AND mdp = ?";
    $stmt = $db_connec->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si les informations de connexion sont correctes
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION["login"] = $user["login"];
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["id"] = session_id();

        // Redirection vers la page principale après connexion
        header("Location: ../index.php");
        exit();
    } else {
        // Redirection avec un message d'erreur en cas d'échec de connexion
        header("Location: login.php?erreur=1");
        exit();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Motion Case | Login</title>
</head>
<body>
    <div class="container" id="container">
        <!-- Formulaire de création de compte -->
        <div class="form-container sign-up-container">
            <form action="../index.php" method="post">
                <h1>Create Account</h1>
                <input type="text" name="login" placeholder="Login"/>
                <input type="text" name="name" placeholder="Name"/>
                <input type="email" name="email" placeholder="Email"/>
                <input type="password" name="password" placeholder="Password"/>
                <button>Sign Up</button>
            </form>
        </div>
        <!-- Formulaire de connexion -->
        <div class="form-container sign-in-container">
            <form action="../index.php" method="post">
                <h1>Sign in</h1>
                <input type="text" name="username" placeholder="Username"/>
                <input type="password" name="password" placeholder="Password"/>
                <?php if(isset($_GET["erreur"])) echo "Erreur de login ou de mot de passe";?>
                <a href="#">Forgot your password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <!-- Overlay pour basculer entre les formulaires -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/login.js"></script>
</body>
</html>
