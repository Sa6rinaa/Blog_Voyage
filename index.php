<?php
session_start();
$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Azurea - Le monde vous attend</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">Azurea</div>
    <nav>
        <a href="#">Accueil</a>
        <a href="#destinations">Destinations</a>
        <?php if (!$user): ?>
            <a href="login.php">Connexion</a>
            <a href="signup.php" class="btn-inscription">Créer un compte</a>
        <?php else: ?>
            <span class="user-badge">Bonjour, <?= htmlspecialchars($user['pseudo']) ?></span>
            <a href="logout.php">Déconnexion</a>
        <?php endif; ?>
    </nav>
</header>

<section class="hero">
    <div class="hero-copy">
        <span class="badge">VOYAGES D'EXCEPTION DEPUIS 2010</span>
        <h1>Le monde<br>vous attend.</h1>
        <p>Des destinations soigneusement sélectionnées, des expériences inoubliables. Réservez votre prochaine aventure en quelques clics.</p>
        <div class="hero-actions">
            <a href="#destinations" class="btn btn-primary">Découvrir les voyages →</a>
            <?php if (!$user): ?>
                <a href="signup.php" class="btn btn-outline">Créer un compte</a>
            <?php else: ?>
                <a href="#destinations" class="btn btn-outline">Voir les offres</a>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($user): ?>
        <div class="hero-welcome">
            <p>Bienvenue sur Azurea, <strong><?= htmlspecialchars($user['pseudo']) ?></strong>.</p>
            <p>Explorez vos destinations préférées et achetez facilement vos voyages.</p>
        </div>
    <?php endif; ?>
</section>

<section class="info-grid container">
    <article class="info-card">
        <span class="icon">✈️</span>
        <h3>Sélection experte</h3>
        <p>Chaque destination est testée et approuvée par nos guides voyageurs.</p>
    </article>
    <article class="info-card">
        <span class="icon">🔒</span>
        <h3>Réservation sécurisée</h3>
        <p>Paiement protégé, annulation flexible et assistance 24/7 incluse.</p>
    </article>
    <article class="info-card">
        <span class="icon">🌍</span>
        <h3>Expériences uniques</h3>
        <p>Hébergements de charme, activités locales et rencontres authentiques.</p>
    </article>
</section>

<section id="destinations" class="container destinations-section">
    <div class="section-header">
        <div>
            <span class="small-title">COUPS DE CŒUR</span>
            <h2>Destinations vedettes</h2>
        </div>
        <a href="#" class="link-secondary">Voir tout →</a>
    </div>

    <div class="destinations-grid">
        <article class="voyage-card">
            <div class="card-image bali"></div>
            <div class="card-body">
                <small>INDONÉSIE</small>
                <h3>Bali, île des dieux</h3>
                <p>Plages de rêve, rizières en terrasses et temples millénaires.</p>
                <div class="card-footer">
                    <span>10 jours</span>
                    <strong>1490€</strong>
                </div>
                <form action="reserver.php" method="POST">
                    <input type="hidden" name="destination" value="Bali, île des dieux">
                    <input type="hidden" name="price" value="1490€">
                    <input type="hidden" name="duration" value="10 jours">
                    <button class="btn btn-buy">Réserver</button>
                </form>
            </div>
        </article>
        <article class="voyage-card">
            <div class="card-image marrakech"></div>
            <div class="card-body">
                <small>MAROC</small>
                <h3>Magie de Marrakech</h3>
                <p>Souks colorés, palais somptueux et nuits étoilées dans le désert.</p>
                <div class="card-footer">
                    <span>5 jours</span>
                    <strong>690€</strong>
                </div>
                <form action="reserver.php" method="POST">
                    <input type="hidden" name="destination" value="Magie de Marrakech">
                    <input type="hidden" name="price" value="690€">
                    <input type="hidden" name="duration" value="5 jours">
                    <button class="btn btn-buy">Réserver</button>
                </form>
            </div>
        </article>
        <article class="voyage-card">
            <div class="card-image tokyo"></div>
            <div class="card-body">
                <small>JAPON</small>
                <h3>Tokyo électrique</h3>
                <p>Entre néons de Shibuya et jardins zen, vivez la dualité du Japon.</p>
                <div class="card-footer">
                    <span>8 jours</span>
                    <strong>1890€</strong>
                </div>
                <form action="reserver.php" method="POST">
                    <input type="hidden" name="destination" value="Tokyo électrique">
                    <input type="hidden" name="price" value="1890€">
                    <input type="hidden" name="duration" value="8 jours">
                    <button class="btn btn-buy">Réserver</button>
                </form>
            </div>
        </article>
        <article class="voyage-card">
            <div class="card-image maldives"></div>
            <div class="card-body">
                <small>MALDIVES</small>
                <h3>Maldives paradisiaques</h3>
                <p>Eaux turquoise, bungalows sur pilotis et fonds marins éblouissants.</p>
                <div class="card-footer">
                    <span>7 jours</span>
                    <strong>2490€</strong>
                </div>
                <form action="reserver.php" method="POST">
                    <input type="hidden" name="destination" value="Maldives paradisiaques">
                    <input type="hidden" name="price" value="2490€">
                    <input type="hidden" name="duration" value="7 jours">
                    <button class="btn btn-buy">Réserver</button>
                </form>
            </div>
        </article>
    </div>
</section>

<section class="cta-section">
    <div class="container cta-card">
        <h2>Prêt à partir ?</h2>
        <p>Créez votre compte et accédez à des offres exclusives sur toutes nos destinations.</p>
        <?php if (!$user): ?>
            <a href="signup.php" class="btn btn-primary">Commencer l'aventure</a>
        <?php else: ?>
            <a href="#destinations" class="btn btn-primary">Voir les voyages</a>
        <?php endif; ?>
    </div>
</section>

<footer class="footer">
    <div class="container footer-inner">
        <span class="logo-footer">Azurea</span>
        <p>© 2026 Azurea. Agence de voyage haut de gamme.</p>
    </div>
</footer>

</body>
</html>