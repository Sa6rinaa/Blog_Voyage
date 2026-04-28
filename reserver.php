<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user'])) {
        $_SESSION['pending_reservation'] = $_POST;
        header('Location: login.php');
        exit;
    }

    $reservation = [
        'destination' => $_POST['destination'] ?? 'Destination Azurea',
        'price' => $_POST['price'] ?? '',
        'duration' => $_POST['duration'] ?? ''
    ];
    $_SESSION['reservation'] = $reservation;
} elseif (isset($_SESSION['pending_reservation']) && isset($_SESSION['user'])) {
    $reservation = $_SESSION['pending_reservation'];
    unset($_SESSION['pending_reservation']);
    $_SESSION['reservation'] = $reservation;
} else {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'] ?? null;
$reservation = $_SESSION['reservation'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation - Azurea</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="logo">Azurea</div>
    <nav>
        <a href="index.php">Accueil</a>
        <?php if ($user): ?>
            <span class="user-badge">Bonjour, <?= htmlspecialchars($user['pseudo']) ?></span>
            <a href="logout.php">Déconnexion</a>
        <?php else: ?>
            <a href="login.php">Connexion</a>
        <?php endif; ?>
    </nav>
</header>

<main class="reservation-page">
    <div class="reservation-panel">
        <h1>Votre réservation</h1>
        <?php if ($reservation && $user): ?>
            <p>Merci, <strong><?= htmlspecialchars($user['pseudo']) ?></strong> !</p>
            <div class="reservation-card">
                <p><strong>Destination :</strong> <?= htmlspecialchars($reservation['destination']) ?></p>
                <p><strong>Durée :</strong> <?= htmlspecialchars($reservation['duration']) ?></p>
                <p><strong>Prix :</strong> <?= htmlspecialchars($reservation['price']) ?></p>
            </div>
            <p class="success-text">Votre voyage est réservé ! Nous vous enverrons une confirmation par email.</p>
        <?php else: ?>
            <p>Votre réservation n'a pas pu être traitée. Retournez à l'accueil pour choisir votre voyage.</p>
        <?php endif; ?>
        <a class="btn btn-primary" href="index.php">Retour à l'accueil</a>
    </div>
</main>
</body>
</html>
