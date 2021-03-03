<?php session_start();

    // Si utilisateur déjà connecté, redirection vers génération du PDF
    if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Site de test pour GoldStrategy/CNPH">
        <meta name="author" content="Nicolas Mourolin">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Styles CSS -->
        <link rel="stylesheet" href="./assets/css/global.css">
        <link rel="stylesheet" href="./assets/css/login.css">

        <title>GoldStrategy - Login</title>
    </head>

    <body>
        <div class="wrapper">
            <div id="form-content">

                <!-- Logo -->
                <div class="logo-container">
                    <img src="./assets/img/logo.jpg" alt="Logo GoldStrategy" />
                    <h1>GoldStrategy</h1>
                </div>
    
                <!-- Formulaire de connexion -->
                <form id="login-form">
                    <div class="form-group">
                        <label for="email">Adresse e-mail</label>
                        <input type="email" name="email" id="email" required autofocus>
                        <span class="error-msg"></span>
                    </div>
    
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="submit">Se connecter</button>
                    </div>
    
                </form>
            </div>
        </div>

        <script src="./assets/js/login.js"></script>

    </body>

</html>