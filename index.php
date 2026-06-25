<?php
$page_title = 'Accueil';
require_once 'includes/header.php';
?>

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

<?php require_once 'includes/footer.php'; ?>

<!-- CSS spécifique à la page d'accueil -->
<style>
/* Hero */
.sc-hero { position: relative; }
.sc-slide {
    height: 580px;
    background: var(--sc-dark);
    background-image:
        radial-gradient(ellipse at 20% 50%, rgba(26,107,255,0.35) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 50%, rgba(232,32,58,0.3) 0%, transparent 60%);
}
.sc-slide-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to right, rgba(10,12,16,0.85) 40%, rgba(10,12,16,0.2));
}
.sc-slide-content {
    position: relative; z-index: 2;
    max-width: 600px;
}
.sc-hero-title {
    font-family: var(--sc-font-display);
    font-size: clamp(2.8rem, 6vw, 5rem);
    letter-spacing: 3px;
    line-height: 1.05;
    color: var(--sc-white);
    margin-bottom: 1rem;
}
.sc-hero-subtitle {
    color: rgba(240,242,248,0.75);
    font-size: 1.05rem;
    max-width: 480px;
}
.sc-carousel-ctrl {
    width: 48px; height: 48px;
    background: rgba(26,107,255,0.2);
    border: 1px solid rgba(26,107,255,0.4);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    top: 50%; transform: translateY(-50%);
    transition: background var(--sc-transition);
}
.sc-carousel-ctrl:hover { background: var(--sc-blue); }
.sc-carousel-ctrl.carousel-control-prev { left: 20px; }
.sc-carousel-ctrl.carousel-control-next { right: 20px; }
.carousel-indicators button {
    width: 30px; height: 3px;
    border-radius: 2px;
    background: rgba(255,255,255,0.4);
    border: none;
}
.carousel-indicators button.active { background: var(--sc-blue); width: 50px; }

/* Stats bar */
.sc-stats-bar {
    background: var(--sc-dark-3);
    border-top: 1px solid rgba(26,107,255,0.15);
    border-bottom: 1px solid rgba(26,107,255,0.15);
    padding: 28px 0;
}
.sc-stat-item { padding: 12px; }
.sc-stat-item + .sc-stat-item { border-left: 1px solid rgba(255,255,255,0.06); }
.sc-stat-number {
    font-family: var(--sc-font-display);
    font-size: 2.2rem;
    letter-spacing: 1px;
    background: var(--sc-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.sc-stat-label { color: var(--sc-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; }

/* Reveal animation */
.sc-reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.6s ease, transform 0.6s ease; }
.sc-revealed { opacity: 1; transform: translateY(0); }

@media (max-width: 767px) {
    .sc-slide { height: 500px; }
    .sc-stat-item + .sc-stat-item { border-left: none; border-top: 1px solid rgba(255,255,255,0.06); }
}
</style>