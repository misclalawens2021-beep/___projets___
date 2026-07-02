<?php
// Démarrage de session si pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Page active pour surligner le lien courant dans la navbar
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' — StadiumCompany' : 'StadiumCompany' ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- CSS principal -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <?php if (isset($extra_css)): ?>
        <?= $extra_css ?>
    <?php endif; ?>
</head>
<body>

<!-- ===================== NAVBAR ===================== -->
<nav class="navbar navbar-expand-lg navbar-dark sc-navbar sticky-top">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand sc-logo" href="/index.php">
            <span class="sc-logo-icon"><i class="bi bi-shield-fill"></i></span>
            <span class="sc-logo-text">STADIUM<span>COMPANY</span></span>
        </a>

        <!-- Toggle mobile -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens de navigation -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link sc-nav-link <?= $current_page === 'index.php' ? 'active' : '' ?>"
                       href="/index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sc-nav-link <?= $current_page === 'evenements.php' ? 'active' : '' ?>"
                       href="/pages/evenements.php">Événements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sc-nav-link <?= $current_page === 'billetterie.php' ? 'active' : '' ?>"
                       href="/pages/billetterie.php">Billetterie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sc-nav-link <?= $current_page === 'restauration.php' ? 'active' : '' ?>"
                       href="/pages/restauration.php">Restauration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sc-nav-link <?= $current_page === 'boutique.php' ? 'active' : '' ?>"
                       href="/pages/boutique.php">Boutique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sc-nav-link <?= $current_page === 'contact.php' ? 'active' : '' ?>"
                       href="/pages/contact.php">Contact</a>
                </li>
            </ul>

            <!-- Bouton connexion / profil utilisateur -->
            <div class="sc-auth-btn">
                <?php if (isset($_SESSION['user'])): ?>
                    <!-- Utilisateur connecté -->
                    <div class="dropdown">
                        <button class="btn sc-btn-user dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-2"></i>
                            <?= htmlspecialchars($_SESSION['user']['prenom'] ?? 'Mon compte') ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end sc-dropdown">
                            <li>
                                <a class="dropdown-item" href="/pages/dashboard.php">
                                    <i class="bi bi-speedometer2 me-2"></i>Tableau de bord
                                </a>
                            </li>
                            <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>
                            <li>
                                <a class="dropdown-item" href="/pages/admin/index.php">
                                    <i class="bi bi-gear-fill me-2"></i>Administration
                                </a>
                            </li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="/pages/logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <!-- Non connecté -->
                    <a href="/pages/login.php" class="btn sc-btn-login">
                        <i class="bi bi-person-fill me-2"></i>Connexion
                    </a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</nav>
<!-- ===================== FIN NAVBAR ===================== -->


<!-- ===================== HERO — CARROUSEL ===================== -->
<section class="sc-hero">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

        <!-- Indicateurs -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <!-- Slides -->
        <div class="carousel-inner">

            <div class="carousel-item active">
                <div class="sc-slide sc-slide-1">
                    <div class="sc-slide-overlay"></div>
                    <div class="container h-100 d-flex align-items-center">
                        <div class="sc-slide-content sc-reveal">
                            <span class="sc-badge sc-badge-blue mb-3">
                                <i class="bi bi-calendar-event"></i> Événement à venir
                            </span>
                            <h1 class="sc-hero-title">Le Stade<br><span class="text-gradient">au Cœur de l'Action</span></h1>
                            <p class="sc-hero-subtitle">Matchs, concerts, spectacles — vivez des expériences inoubliables au cœur du meilleur stade de la région.</p>
                            <div class="d-flex gap-3 flex-wrap mt-4">
                                <a href="/pages/evenements.php" class="sc-btn-primary">
                                    <i class="bi bi-calendar3"></i> Voir les événements
                                </a>
                                <a href="/pages/billetterie.php" class="sc-btn-outline">
                                    <i class="bi bi-ticket-fill"></i> Acheter des billets
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="sc-slide sc-slide-2">
                    <div class="sc-slide-overlay"></div>
                    <div class="container h-100 d-flex align-items-center">
                        <div class="sc-slide-content">
                            <span class="sc-badge sc-badge-red mb-3">
                                <i class="bi bi-star-fill"></i> Expérience VIP
                            </span>
                            <h1 class="sc-hero-title">Vivez le<br><span class="text-gradient">Grand Spectacle</span></h1>
                            <p class="sc-hero-subtitle">Des loges VIP, une restauration de luxe et un accueil personnalisé pour une expérience unique.</p>
                            <div class="d-flex gap-3 flex-wrap mt-4">
                                <a href="/pages/restauration.php" class="sc-btn-primary">
                                    <i class="bi bi-fork-knife"></i> Notre restaurant
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="sc-slide sc-slide-3">
                    <div class="sc-slide-overlay"></div>
                    <div class="container h-100 d-flex align-items-center">
                        <div class="sc-slide-content">
                            <span class="sc-badge sc-badge-green mb-3">
                                <i class="bi bi-bag-fill"></i> Boutique officielle
                            </span>
                            <h1 class="sc-hero-title">Portez les<br><span class="text-gradient">Couleurs du Stade</span></h1>
                            <p class="sc-hero-subtitle">Maillots, écharpes, souvenirs exclusifs — retrouvez tous nos produits officiels en boutique ou en ligne.</p>
                            <div class="d-flex gap-3 flex-wrap mt-4">
                                <a href="/pages/boutique.php" class="sc-btn-primary">
                                    <i class="bi bi-shop"></i> Visiter la boutique
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Contrôles -->
        <button class="carousel-control-prev sc-carousel-ctrl" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="carousel-control-next sc-carousel-ctrl" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <i class="bi bi-chevron-right"></i>
        </button>

    </div>
</section>

<!-- ===================== STATS ===================== -->
<section class="sc-stats-bar">
    <div class="container">
        <div class="row g-0 text-center">
            <div class="col-6 col-md-3 sc-stat-item">
                <div class="sc-stat-number">50 000</div>
                <div class="sc-stat-label">Places assises</div>
            </div>
            <div class="col-6 col-md-3 sc-stat-item">
                <div class="sc-stat-number">170+</div>
                <div class="sc-stat-label">Employés permanents</div>
            </div>
            <div class="col-6 col-md-3 sc-stat-item">
                <div class="sc-stat-number">3</div>
                <div class="sc-stat-label">Sites connectés</div>
            </div>
            <div class="col-6 col-md-3 sc-stat-item">
                <div class="sc-stat-number">200+</div>
                <div class="sc-stat-label">Événements par an</div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== ÉVÉNEMENTS À VENIR ===================== -->
<section class="sc-section">
    <div class="container">
        <div class="sc-reveal">
            <div class="sc-accent-line"></div>
            <h2 class="sc-section-title">Prochains Événements</h2>
            <p class="sc-section-subtitle">Ne ratez aucun match, concert ou spectacle</p>
        </div>

        <div class="row g-4">
            <!-- Card événement (à remplacer par une boucle PHP/MySQL) -->
            <?php
            // Données fictives — à remplacer par une requête BDD
            $evenements = [
                ['titre' => 'Match de Football', 'date' => '28 Juin 2026', 'categorie' => 'Sport', 'badge' => 'sc-badge-blue', 'icon' => 'bi-trophy-fill', 'places' => '12 500'],
                ['titre' => 'Concert Rock', 'date' => '5 Juil. 2026', 'categorie' => 'Musique', 'badge' => 'sc-badge-red', 'icon' => 'bi-music-note-beamed', 'places' => '48 000'],
                ['titre' => 'Gala Sportif', 'date' => '12 Juil. 2026', 'categorie' => 'Spectacle', 'badge' => 'sc-badge-green', 'icon' => 'bi-star-fill', 'places' => '5 200'],
            ];
            foreach ($evenements as $evt): ?>
            <div class="col-md-4 sc-reveal">
                <div class="sc-card h-100">
                    <div class="sc-card-img d-flex align-items-center justify-content-center" style="background: var(--sc-dark-4);">
                        <i class="bi <?= $evt['icon'] ?>" style="font-size: 3.5rem; opacity: 0.3;"></i>
                    </div>
                    <div class="sc-card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="sc-badge <?= $evt['badge'] ?>"><?= $evt['categorie'] ?></span>
                            <span class="sc-card-text"><i class="bi bi-calendar3 me-1"></i><?= $evt['date'] ?></span>
                        </div>
                        <h3 class="sc-card-title"><?= $evt['titre'] ?></h3>
                        <p class="sc-card-text flex-grow-1">
                            <i class="bi bi-people-fill me-1"></i><?= $evt['places'] ?> places disponibles
                        </p>
                        <a href="/pages/billetterie.php" class="sc-btn-primary mt-3" style="justify-content: center;">
                            <i class="bi bi-ticket-fill"></i> Réserver
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="/pages/evenements.php" class="sc-btn-outline">
                <i class="bi bi-grid-3x3-gap-fill me-2"></i>Tous les événements
            </a>
        </div>
    </div>
</section>

<!-- ===================== BOUTIQUE — PRODUITS ===================== -->
<section class="sc-section" style="background: var(--sc-dark-2);">
    <div class="container">
        <div class="sc-reveal">
            <div class="sc-accent-line"></div>
            <h2 class="sc-section-title">Boutique Officielle</h2>
            <p class="sc-section-subtitle">Les produits incontournables aux couleurs du stade</p>
        </div>

        <!-- Rangée 1 -->
        <div class="row g-4 mb-4">
            <?php
            $produits_row1 = [
                ['nom' => 'Maillot Domicile 2026', 'prix' => '79,99 €'],
                ['nom' => 'Écharpe Officielle', 'prix' => '24,99 €'],
                ['nom' => 'Casquette StadiumCo', 'prix' => '19,99 €'],
                ['nom' => 'Mug Collector', 'prix' => '14,99 €'],
            ];
            foreach ($produits_row1 as $p): ?>
            <div class="col-6 col-md-3 sc-reveal">
                <div class="sc-card h-100">
                    <div class="sc-card-img d-flex align-items-center justify-content-center" style="background: var(--sc-dark-4); height:160px;">
                        <i class="bi bi-bag-fill" style="font-size: 2.5rem; opacity: 0.25;"></i>
                    </div>
                    <div class="sc-card-body">
                        <h4 class="sc-card-title" style="font-size:1rem;"><?= $p['nom'] ?></h4>
                        <p class="text-gradient fw-bold"><?= $p['prix'] ?></p>
                        <a href="/pages/boutique.php" class="sc-btn-primary w-100 justify-content-center" style="font-size:0.8rem; padding:0.4rem;">
                            <i class="bi bi-cart-plus"></i> Ajouter
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Rangée 2 -->
        <div class="row g-4">
            <?php
            $produits_row2 = [
                ['nom' => 'Drapeau du Stade', 'prix' => '12,99 €'],
                ['nom' => 'Veste Supporter', 'prix' => '89,99 €'],
                ['nom' => 'Ballon Signé', 'prix' => '49,99 €'],
                ['nom' => 'Porte-clés Stade', 'prix' => '7,99 €'],
            ];
            foreach ($produits_row2 as $p): ?>
            <div class="col-6 col-md-3 sc-reveal">
                <div class="sc-card h-100">
                    <div class="sc-card-img d-flex align-items-center justify-content-center" style="background: var(--sc-dark-4); height:160px;">
                        <i class="bi bi-shop" style="font-size: 2.5rem; opacity: 0.25;"></i>
                    </div>
                    <div class="sc-card-body">
                        <h4 class="sc-card-title" style="font-size:1rem;"><?= $p['nom'] ?></h4>
                        <p class="text-gradient fw-bold"><?= $p['prix'] ?></p>
                        <a href="/pages/boutique.php" class="sc-btn-primary w-100 justify-content-center" style="font-size:0.8rem; padding:0.4rem;">
                            <i class="bi bi-cart-plus"></i> Ajouter
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="/pages/boutique.php" class="sc-btn-outline">
                <i class="bi bi-shop me-2"></i>Voir toute la boutique
            </a>
        </div>
    </div>
</section>

<!-- ===================== SERVICES ===================== -->
<section class="sc-section">
    <div class="container">
        <div class="sc-reveal text-center mb-5">
            <div class="sc-accent-line mx-auto"></div>
            <h2 class="sc-section-title">Nos Services</h2>
            <p class="sc-section-subtitle">Tout ce qu'il faut pour une expérience parfaite</p>
        </div>
        <div class="row g-4 text-center">
            <?php
            $services = [
                ['icon' => 'bi-ticket-fill',    'titre' => 'Billetterie',   'desc' => 'Réservez vos places en ligne, choisissez votre catégorie et recevez votre billet par email.',   'lien' => '/pages/billetterie.php', 'color' => 'var(--sc-blue)'],
                ['icon' => 'bi-fork-knife',     'titre' => 'Restauration',  'desc' => 'Un restaurant gastronomique pour les grandes occasions et un service de restauration rapide.',    'lien' => '/pages/restauration.php','color' => 'var(--sc-red)'],
                ['icon' => 'bi-bag-fill',       'titre' => 'Boutique',      'desc' => 'Des produits officiels aux couleurs du stade, disponibles sur place et en ligne.',               'lien' => '/pages/boutique.php',    'color' => '#22c55e'],
                ['icon' => 'bi-star-fill',      'titre' => 'Espace VIP',    'desc' => 'Loges privées, accueil personnalisé et programme exclusif pour les clients VIP.',                'lien' => '/pages/login.php',       'color' => '#f59e0b'],
            ];
            foreach ($services as $s): ?>
            <div class="col-md-6 col-lg-3 sc-reveal">
                <div class="sc-card h-100 p-4">
                    <div class="sc-service-icon mb-3" style="color: <?= $s['color'] ?>">
                        <i class="bi <?= $s['icon'] ?>" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="sc-card-title"><?= $s['titre'] ?></h3>
                    <p class="sc-card-text"><?= $s['desc'] ?></p>
                    <a href="<?= $s['lien'] ?>" class="sc-btn-outline mt-3" style="justify-content:center; font-size:0.85rem;">
                        En savoir plus
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== FOOTER ===================== -->
<footer class="sc-footer mt-auto">

    <div class="sc-footer-top">
        <div class="container">
            <div class="row gy-4">

                <!-- Colonne 1 — Logo & description -->
                <div class="col-lg-4 col-md-6">
                    <div class="sc-footer-brand">
                        <span class="sc-logo-icon"><i class="bi bi-shield-fill"></i></span>
                        <span class="sc-logo-text">STADIUM<span>COMPANY</span></span>
                    </div>
                    <p class="sc-footer-desc mt-3">
                        Le stade multi-événements de référence. Matchs, concerts, spectacles —
                        vivez des expériences inoubliables.
                    </p>
                    <div class="sc-social-links mt-3">
                        <a href="#" class="sc-social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="sc-social-link" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="sc-social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="sc-social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Colonne 2 — Navigation -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="sc-footer-title">Navigation</h6>
                    <ul class="sc-footer-links">
                        <li><a href="/index.php">Accueil</a></li>
                        <li><a href="/pages/evenements.php">Événements</a></li>
                        <li><a href="/pages/billetterie.php">Billetterie</a></li>
                        <li><a href="/pages/restauration.php">Restauration</a></li>
                        <li><a href="/pages/boutique.php">Boutique</a></li>
                        <li><a href="/pages/apropos.php">À propos</a></li>
                    </ul>
                </div>

                <!-- Colonne 3 — Nos sites -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="sc-footer-title">Nos sites</h6>
                    <ul class="sc-footer-links sc-footer-locations">
                        <li>
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            <div>
                                <strong>Stade Principal</strong><br>
                                <small>1 Avenue du Stade, Paris</small>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-ticket-fill me-2"></i>
                            <div>
                                <strong>Billetterie Centre-ville</strong><br>
                                <small>45 Rue du Commerce, Paris</small>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-bag-fill me-2"></i>
                            <div>
                                <strong>Boutique Souvenirs</strong><br>
                                <small>12 Boulevard des Sports, Paris</small>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Colonne 4 — Contact -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="sc-footer-title">Contact</h6>
                    <ul class="sc-footer-links sc-footer-contact">
                        <li>
                            <i class="bi bi-envelope-fill me-2"></i>
                            <a href="mailto:contact@stadiumcompany.com">contact@stadiumcompany.com</a>
                        </li>
                        <li>
                            <i class="bi bi-telephone-fill me-2"></i>
                            <span>+33 1 23 45 67 89</span>
                        </li>
                        <li>
                            <i class="bi bi-clock-fill me-2"></i>
                            <span>Lun – Ven : 9h – 18h</span>
                        </li>
                    </ul>
                    <a href="/pages/contact.php" class="btn sc-btn-footer-contact mt-3">
                        <i class="bi bi-chat-dots-fill me-2"></i>Nous contacter
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Barre du bas -->
    <div class="sc-footer-bottom">
        <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
            <p class="mb-0 small">
                &copy; <?= date('Y') ?> StadiumCompany. Tous droits réservés.
            </p>
            <div class="sc-footer-legal-links">
                <a href="/pages/mentions-legales.php">Mentions légales</a>
                <span class="mx-2">·</span>
                <a href="/pages/mentions-legales.php#cgu">CGU</a>
                <span class="mx-2">·</span>
                <a href="/pages/mentions-legales.php#confidentialite">Confidentialité</a>
            </div>
        </div>
    </div>

</footer>
<!-- ===================== FIN FOOTER ===================== -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS principal -->
<script src="/assets/js/main.js"></script>

<?php if (isset($extra_js)): ?>
    <?= $extra_js ?>
<?php endif; ?>

</body>
</html>