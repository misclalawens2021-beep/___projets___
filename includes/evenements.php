<?php
$page_title = 'Événements';
require_once '../includes/header.php';
?>

<section class="sc-page-hero">
    <div class="container">
        <div class="sc-accent-line"></div>
        <h1 class="sc-section-title">Événements</h1>
        <p class="sc-section-subtitle">Tous les matchs, concerts et spectacles à venir</p>
    </div>
</section>

<section class="sc-section">
    <div class="container">

        <!-- Filtres -->
        <div class="sc-filters mb-5 sc-reveal">
            <button class="sc-filter-btn active" data-filter="tous">Tous</button>
            <button class="sc-filter-btn" data-filter="sport">
                <i class="bi bi-trophy-fill me-1"></i>Sport
            </button>
            <button class="sc-filter-btn" data-filter="musique">
                <i class="bi bi-music-note-beamed me-1"></i>Musique
            </button>
            <button class="sc-filter-btn" data-filter="spectacle">
                <i class="bi bi-star-fill me-1"></i>Spectacle
            </button>
        </div>

        <!-- Grille d'événements -->
        <div class="row g-4" id="eventsGrid">
            <?php
            // Données fictives — à remplacer par requête BDD
            $evenements = [
                ['titre' => 'Match de Football',     'date' => '28 Juin 2026',  'heure' => '20h30', 'categorie' => 'sport',    'badge' => 'sc-badge-blue',  'icon' => 'bi-trophy-fill',       'places' => '12 500', 'prix' => '25'],
                ['titre' => 'Concert Rock',           'date' => '5 Juil. 2026',  'heure' => '19h00', 'categorie' => 'musique',  'badge' => 'sc-badge-red',   'icon' => 'bi-music-note-beamed', 'places' => '48 000', 'prix' => '45'],
                ['titre' => 'Gala Sportif',           'date' => '12 Juil. 2026', 'heure' => '18h00', 'categorie' => 'spectacle','badge' => 'sc-badge-green', 'icon' => 'bi-star-fill',         'places' => '5 200',  'prix' => '60'],
                ['titre' => 'Derby Régional',         'date' => '19 Juil. 2026', 'heure' => '21h00', 'categorie' => 'sport',    'badge' => 'sc-badge-blue',  'icon' => 'bi-trophy-fill',       'places' => '50 000', 'prix' => '30'],
                ['titre' => 'Festival Électro',       'date' => '26 Juil. 2026', 'heure' => '22h00', 'categorie' => 'musique',  'badge' => 'sc-badge-red',   'icon' => 'bi-music-note-beamed', 'places' => '35 000', 'prix' => '55'],
                ['titre' => 'Championnat Athlétisme', 'date' => '2 Août 2026',   'heure' => '10h00', 'categorie' => 'sport',    'badge' => 'sc-badge-blue',  'icon' => 'bi-trophy-fill',       'places' => '20 000', 'prix' => '20'],
            ];
            foreach ($evenements as $evt): ?>
            <div class="col-md-6 col-lg-4 sc-reveal sc-event-card" data-categorie="<?= $evt['categorie'] ?>">
                <div class="sc-card h-100">
                    <div class="sc-card-img d-flex align-items-center justify-content-center sc-event-thumb">
                        <i class="bi <?= $evt['icon'] ?>"></i>
                    </div>
                    <div class="sc-card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="sc-badge <?= $evt['badge'] ?>"><?= ucfirst($evt['categorie']) ?></span>
                            <span class="sc-card-text small">À partir de <strong class="text-gradient"><?= $evt['prix'] ?> €</strong></span>
                        </div>
                        <h3 class="sc-card-title"><?= $evt['titre'] ?></h3>
                        <div class="sc-event-meta mt-1 mb-3">
                            <span><i class="bi bi-calendar3 me-1"></i><?= $evt['date'] ?></span>
                            <span><i class="bi bi-clock me-1"></i><?= $evt['heure'] ?></span>
                            <span><i class="bi bi-people-fill me-1"></i><?= $evt['places'] ?> places</span>
                        </div>
                        <a href="/pages/billetterie.php" class="sc-btn-primary mt-auto justify-content-center">
                            <i class="bi bi-ticket-fill"></i> Réserver
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php require_once '../includes/footer.php'; ?>

<style>
.sc-page-hero { padding: 60px 0 30px; background: var(--sc-dark-2); border-bottom: 1px solid rgba(255,255,255,0.06); }
.sc-filters { display: flex; flex-wrap: wrap; gap: 10px; }
.sc-filter-btn {
    background: var(--sc-dark-3); color: var(--sc-muted);
    border: 1px solid rgba(255,255,255,0.08); border-radius: 20px;
    padding: 0.4rem 1.1rem; font-size: 0.875rem; cursor: pointer;
    transition: all var(--sc-transition);
}
.sc-filter-btn:hover, .sc-filter-btn.active {
    background: var(--sc-blue); color: var(--sc-white); border-color: var(--sc-blue);
}
.sc-event-thumb {
    height: 180px; background: var(--sc-dark-4);
    background-image: radial-gradient(ellipse at center, rgba(26,107,255,0.15), transparent 70%);
}
.sc-event-thumb i { font-size: 3.5rem; opacity: 0.25; color: var(--sc-blue); }
.sc-event-meta { display: flex; flex-direction: column; gap: 5px; color: var(--sc-muted); font-size: 0.82rem; }
.sc-event-meta span i { color: var(--sc-blue); }
</style>

<script>
document.querySelectorAll('.sc-filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.sc-filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        document.querySelectorAll('.sc-event-card').forEach(card => {
            card.style.display = (filter === 'tous' || card.dataset.categorie === filter) ? '' : 'none';
        });
    });
});
</script>