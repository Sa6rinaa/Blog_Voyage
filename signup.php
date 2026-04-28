<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = trim($_POST['pseudo'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($pseudo === '' || $email === '' || $password === '') {
        $error = 'Tous les champs sont obligatoires pour créer un compte.';
    } else {
        $_SESSION['user'] = [
            'email' => $email,
            'pseudo' => $pseudo
        ];

        if (isset($_SESSION['pending_reservation'])) {
            header('Location: reserver.php');
            exit;
        }

        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Azurea</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="logo">Azurea</div>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="login.php">Connexion</a>
    </nav>
</header>

<main class="form-page">
    <div class="form-panel">
        <h1>Créer un compte</h1>
        <p>Rejoignez Azurea et profitez d'offres exclusives dès maintenant.</p>
        <?php if ($error): ?>
            <div class="alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="signup.php" method="POST">
            <label>Pseudo</label>
            <input type="text" name="pseudo" placeholder="Votre pseudo" required>

            <label>Adresse email</label>
            <input type="email" name="email" placeholder="contact@azurea.com" required>

            <label>Mot de passe</label>
            <input type="password" name="password" placeholder="••••••••" required>

            <button class="btn btn-primary" type="submit">Créer mon compte</button>
        </form>
        <p class="small-text">Déjà inscrit ? <a href="login.php">Connexion</a></p>
    </div>
</main>
</body>
</html>
