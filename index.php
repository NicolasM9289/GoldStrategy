<?php session_start();

    // Si l'utilisateur n'est pas authentifié, redirection vers la page de connexion
    if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
        header("Location: login.php");
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
        <link rel="stylesheet" href="./assets/css/dashboard.css">

        <title>GoldStrategy - Dashboard</title>
    </head>

    <body>
        <!-- Header -->
        <header>
            <img src="./assets/img/logo.jpg" alt="Logo GoldStrategy">
            <div>
                <p class="welcome-message">Bienvenue, <?php echo $_SESSION['email'] ?></p>
                <a class="logout-btn" href='logout.php'>Déconnexion</a>
            </div>

        </header>

        <!-- Section génération du PDF -->
        <section id="pdf-generator">
            <h1>Générer un PDF</h1>
            <hr />
            <form id="pdf-form">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title" placeholder="Titre de votre document" required>
                    <span class="error-msg"></span>
                </div>

                <div class="form-group">
                    <label for="comment">Commentaire</label>
                    <textarea id="comment" name="comment" placeholder="Commentaire à insérer..." required></textarea>
                    <span class="error-msg"></span>
                </div>

                <div class="form-group">
                    <button type="submit" id="submit">Générer le PDF</button>
                </div>
            </form>
        </section>   
           
        <script src="./assets/js/dashboard.js"></script>

    </body>
</html>