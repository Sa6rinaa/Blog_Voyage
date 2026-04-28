<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$next = $_GET['next'] ?? 'index.php';
$error = '';
$accounts = [
    'contact@azurea.com' => ['pseudo' => 'AzureaVoyage', 'password' => 'azur123'],
    'client@voyage.com' => ['pseudo' => 'Voyageur', 'password' => 'voyage123']
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (isset($accounts[$email]) && $accounts[$email]['password'] === $password) {
        $_SESSION['user'] = [
            'email' => $email,
            'pseudo' => $accounts[$email]['pseudo']
        ];

        if (isset($_SESSION['pending_reservation'])) {
            header('Location: reserver.php');
            exit;
        }

        header('Location: ' . htmlspecialchars($next));
        exit;
    }

    $error = 'Adresse email ou mot de passe incorrect.';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Azurea</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="logo">Azurea</div>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="signup.php">Inscription</a>
    </nav>
</header>

<main class="form-page">
    <div class="form-panel">
        <h1>Connexion</h1>
        <p>Connectez-vous pour réserver votre prochain voyage et voir votre pseudo s'afficher.</p>
        <?php if ($error): ?>
            <div class="alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <label>Adresse email</label>
            <input type="email" name="email" placeholder="contact@azurea.com" required>

            <label>Mot de passe</label>
            <input type="password" name="password" placeholder="••••••••" required>

            <input type="hidden" name="next" value="<?= htmlspecialchars($next) ?>">
            <button class="btn btn-primary" type="submit">Se connecter</button>
        </form>
        <p class="small-text">Pas encore de compte ? <a href="signup.php">Créer un compte</a></p>
    </div>
</main>
</body>
</html>
