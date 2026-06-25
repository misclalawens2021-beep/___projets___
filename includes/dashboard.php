<?php
$page_title = 'Tableau de bord';
if (session_status() === PHP_SESSION_NONE) session_start();

// Rediriger si non connecté
if (!isset($_SESSION['user'])) {
    header('Location: /pages/login.php');
    exit;
}

$user    = $_SESSION['user'];
$is_admin = ($user['role'] === 'admin');

require_once '../includes/header.php';
?>

<section class="sc-page-hero">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <div class="sc-accent-line"></div>
                <h1 class="sc-section-title">
                    Bonjour, <span class="text-gradient"><?= htmlspecialchars($user['prenom']) ?></span>
                </h1>
                <p class="sc-section-subtitle mb-0">
                    <?= $is_admin ? 'Administrateur' : 'Employé' ?> —
                    <?= htmlspecialchars($user['service'] ?: 'StadiumCompany') ?>
                </p>
            </div>
            <div class="sc-user-badge">
                <i class="bi bi-person-circle sc-user-avatar"></i>
                <div>
                    <div style="font-weight:600;"><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></div>
                    <div style="color:var(--sc-muted);font-size:0.82rem;"><?= htmlspecialchars($user['email'] ?: $user['login'] . '@stadiumcompany.com') ?></div>
                </div>
                <?php if ($is_admin): ?>
                    <span class="sc-badge sc-badge-red ms-2"><i class="bi bi-shield-fill me-1"></i>Admin</span>
                <?php else: ?>
                    <span class="sc-badge sc-badge-blue ms-2"><i class="bi bi-person-fill me-1"></i>Employé</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="sc-section">
    <div class="container">

        <!-- ===== STATS RAPIDES ===== -->
        <div class="row g-4 mb-5">
            <?php
            $stats = $is_admin
                ? [
                    ['icon' => 'bi-calendar-event-fill', 'color' => 'var(--sc-blue)',  'val' => '6',     'label' => 'Événements actifs'],
                    ['icon' => 'bi-ticket-fill',          'color' => 'var(--sc-red)',   'val' => '1 248', 'label' => 'Réservations totales'],
                    ['icon' => 'bi-bag-fill',              'color' => '#22c55e',         'val' => '342',   'label' => 'Commandes boutique'],
                    ['icon' => 'bi-chat-dots-fill',        'color' => '#f59e0b',         'val' => '12',    'label' => 'Messages non lus'],
                  ]
                : [
                    ['icon' => 'bi-ticket-fill',     'color' => 'var(--sc-blue)', 'val' => '3',  'label' => 'Mes réservations'],
                    ['icon' => 'bi-bag-fill',          'color' => 'var(--sc-red)',  'val' => '1',  'label' => 'Mes commandes'],
                    ['icon' => 'bi-calendar3',         'color' => '#22c55e',        'val' => '2',  'label' => 'Événements à venir'],
                    ['icon' => 'bi-star-fill',         'color' => '#f59e0b',        'val' => 'VIP', 'label' => 'Mon statut'],
                  ];
            foreach ($stats as $s): ?>
            <div class="col-6 col-md-3 sc-reveal">
                <div class="sc-stat-card">
                    <div class="sc-stat-card-icon" style="color:<?= $s['color'] ?>; background: rgba(<?= $s['color'] === 'var(--sc-blue)' ? '26,107,255' : ($s['color'] === 'var(--sc-red)' ? '232,32,58' : ($s['color'] === '#22c55e' ? '34,197,94' : '245,158,11')) ?>,0.12);">
                        <i class="bi <?= $s['icon'] ?>"></i>
                    </div>
                    <div class="sc-stat-card-val"><?= $s['val'] ?></div>
                    <div class="sc-stat-card-label"><?= $s['label'] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row g-4">

            <!-- Colonne principale -->
            <div class="col-lg-8">

                <?php if ($is_admin): ?>
                <!-- ===== ADMIN : Raccourcis gestion ===== -->
                <div class="sc-dash-block sc-reveal mb-4">
                    <h3 class="sc-dash-block-title">
                        <i class="bi bi-grid-fill me-2 text-gradient"></i>Administration
                    </h3>
                    <div class="row g-3">
                        <?php
                        $admin_links = [
                            ['icon' => 'bi-calendar-plus-fill', 'label' => 'Gérer les événements',  'href' => '/pages/admin/evenements.php', 'color' => 'var(--sc-blue)'],
                            ['icon' => 'bi-ticket-fill',         'label' => 'Gérer les réservations','href' => '/pages/admin/reservations.php','color' => 'var(--sc-red)'],
                            ['icon' => 'bi-bag-fill',             'label' => 'Gérer la boutique',     'href' => '/pages/admin/boutique.php',   'color' => '#22c55e'],
                            ['icon' => 'bi-people-fill',          'label' => 'Gérer les utilisateurs','href' => '/pages/admin/users.php',      'color' => '#f59e0b'],
                            ['icon' => 'bi-newspaper',            'label' => 'Gérer les actualités',  'href' => '/pages/admin/actualites.php', 'color' => 'var(--sc-blue)'],
                            ['icon' => 'bi-chat-dots-fill',       'label' => 'Messages de contact',   'href' => '/pages/admin/contacts.php',   'color' => 'var(--sc-red)'],
                        ];
                        foreach ($admin_links as $l): ?>
                        <div class="col-6 col-md-4">
                            <a href="<?= $l['href'] ?>" class="sc-admin-link">
                                <i class="bi <?= $l['icon'] ?>" style="color:<?= $l['color'] ?>; font-size:1.4rem;"></i>
                                <span><?= $l['label'] ?></span>
                                <i class="bi bi-chevron-right ms-auto" style="color:var(--sc-muted);font-size:0.8rem;"></i>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- ===== Prochains événements ===== -->
                <div class="sc-dash-block sc-reveal mb-4">
                    <h3 class="sc-dash-block-title">
                        <i class="bi bi-calendar-event-fill me-2 text-gradient"></i>Prochains événements
                    </h3>
                    <div class="d-flex flex-column gap-2">
                        <?php
                        $events = [
                            ['titre' => 'Match de Football', 'date' => '28 Juin 2026', 'heure' => '20h30', 'places' => '12 500', 'badge' => 'sc-badge-blue'],
                            ['titre' => 'Concert Rock',       'date' => '5 Juil. 2026', 'heure' => '19h00', 'places' => '48 000', 'badge' => 'sc-badge-red'],
                            ['titre' => 'Gala Sportif',       'date' => '12 Juil. 2026','heure' => '18h00', 'places' => '5 200',  'badge' => 'sc-badge-green'],
                        ];
                        foreach ($events as $e): ?>
                        <div class="sc-event-row">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <strong><?= $e['titre'] ?></strong>
                                    <span class="sc-badge <?= $e['badge'] ?>" style="font-size:0.7rem;">À venir</span>
                                </div>
                                <div class="sc-card-text" style="font-size:0.82rem;">
                                    <i class="bi bi-calendar3 me-1"></i><?= $e['date'] ?>
                                    <span class="mx-2">·</span>
                                    <i class="bi bi-clock me-1"></i><?= $e['heure'] ?>
                                    <span class="mx-2">·</span>
                                    <i class="bi bi-people-fill me-1"></i><?= $e['places'] ?> places
                                </div>
                            </div>
                            <a href="/pages/billetterie.php" class="sc-btn-outline" style="font-size:0.8rem; padding:0.35rem 0.85rem; white-space:nowrap;">
                                <i class="bi bi-ticket-fill me-1"></i>Réserver
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- ===== Mes réservations ===== -->
                <div class="sc-dash-block sc-reveal">
                    <h3 class="sc-dash-block-title">
                        <i class="bi bi-ticket-fill me-2 text-gradient"></i>Mes réservations
                    </h3>
                    <?php
                    // TODO : remplacer par une vraie requête BDD
                    // $stmt = $pdo->prepare("SELECT * FROM reservations WHERE id_user = ? ORDER BY date_resa DESC LIMIT 5");
                    // $stmt->execute([$user['login']]);
                    // $reservations = $stmt->fetchAll();
                    $reservations = [
                        ['evt' => 'Concert Rock',   'date' => '5 Juil. 2026', 'cat' => 'Tribune', 'montant' => '45,00 €', 'statut' => 'Confirmée', 'statut_class' => 'sc-badge-green'],
                        ['evt' => 'Gala Sportif',   'date' => '12 Juil. 2026','cat' => 'VIP',     'montant' => '120,00 €','statut' => 'En attente','statut_class' => 'sc-badge-blue'],
                    ];
                    if (empty($reservations)): ?>
                        <div class="text-center py-4" style="color:var(--sc-muted);">
                            <i class="bi bi-ticket" style="font-size:2.5rem; opacity:0.3;"></i>
                            <p class="mt-2">Aucune réservation pour le moment.</p>
                            <a href="/pages/billetterie.php" class="sc-btn-primary">Réserver des billets</a>
                        </div>
                    <?php else: ?>
                        <div class="sc-table-wrap">
                            <table class="sc-table">
                                <thead>
                                    <tr>
                                        <th>Événement</th>
                                        <th>Date</th>
                                        <th>Catégorie</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reservations as $r): ?>
                                    <tr>
                                        <td><?= $r['evt'] ?></td>
                                        <td><?= $r['date'] ?></td>
                                        <td><?= $r['cat'] ?></td>
                                        <td class="text-gradient fw-bold"><?= $r['montant'] ?></td>
                                        <td><span class="sc-badge <?= $r['statut_class'] ?>"><?= $r['statut'] ?></span></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Colonne latérale -->
            <div class="col-lg-4">

                <!-- Mon profil -->
                <div class="sc-dash-block sc-reveal mb-4">
                    <h3 class="sc-dash-block-title">
                        <i class="bi bi-person-fill me-2 text-gradient"></i>Mon profil
                    </h3>
                    <div class="d-flex flex-column gap-2 mt-3">
                        <?php
                        $profil = [
                            ['label' => 'Login',    'val' => $user['login']],
                            ['label' => 'Prénom',   'val' => $user['prenom']],
                            ['label' => 'Nom',      'val' => $user['nom'] ?: '—'],
                            ['label' => 'Email',    'val' => $user['email'] ?: $user['login'] . '@stadiumcompany.com'],
                            ['label' => 'Service',  'val' => $user['service'] ?: '—'],
                            ['label' => 'Rôle',     'val' => ucfirst($user['role'])],
                        ];
                        foreach ($profil as $p): ?>
                        <div class="sc-profile-row">
                            <span class="sc-card-text" style="font-size:0.8rem;"><?= $p['label'] ?></span>
                            <span style="font-size:0.88rem; font-weight:500;"><?= htmlspecialchars($p['val']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Accès rapides -->
                <div class="sc-dash-block sc-reveal mb-4">
                    <h3 class="sc-dash-block-title">
                        <i class="bi bi-lightning-fill me-2 text-gradient"></i>Accès rapides
                    </h3>
                    <div class="d-flex flex-column gap-2 mt-3">
                        <?php
                        $links = [
                            ['icon' => 'bi-calendar3',    'label' => 'Voir les événements', 'href' => '/pages/evenements.php'],
                            ['icon' => 'bi-ticket-fill',  'label' => 'Billetterie',          'href' => '/pages/billetterie.php'],
                            ['icon' => 'bi-fork-knife',   'label' => 'Restauration',         'href' => '/pages/restauration.php'],
                            ['icon' => 'bi-bag-fill',      'label' => 'Boutique',             'href' => '/pages/boutique.php'],
                            ['icon' => 'bi-chat-dots',    'label' => 'Contact / Support',    'href' => '/pages/contact.php'],
                        ];
                        foreach ($links as $l): ?>
                        <a href="<?= $l['href'] ?>" class="sc-quick-link">
                            <i class="bi <?= $l['icon'] ?>" style="color:var(--sc-blue);"></i>
                            <span><?= $l['label'] ?></span>
                            <i class="bi bi-chevron-right ms-auto" style="color:var(--sc-muted);font-size:0.75rem;"></i>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Déconnexion -->
                <div class="sc-reveal">
                    <a href="/pages/logout.php" class="sc-btn-outline w-100 justify-content-center"
                       style="border-color:rgba(232,32,58,0.3); color:var(--sc-red);"
                       onclick="return confirm('Voulez-vous vraiment vous déconnecter ?')">
                        <i class="bi bi-box-arrow-right me-2"></i>Se déconnecter
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>

<style>
.sc-page-hero { padding: 50px 0 30px; background: var(--sc-dark-2); border-bottom: 1px solid rgba(255,255,255,0.06); }
.sc-user-badge { display: flex; align-items: center; gap: 12px; background: var(--sc-dark-3); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius); padding: 0.75rem 1rem; }
.sc-user-avatar { font-size: 2.2rem; background: var(--sc-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

/* Stat cards */
.sc-stat-card { background: var(--sc-dark-3); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius-lg); padding: 1.5rem; text-align: center; transition: transform var(--sc-transition); }
.sc-stat-card:hover { transform: translateY(-3px); }
.sc-stat-card-icon { width: 52px; height: 52px; border-radius: var(--sc-radius); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin: 0 auto 0.75rem; }
.sc-stat-card-val { font-family: var(--sc-font-display); font-size: 2rem; letter-spacing: 1px; background: var(--sc-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.sc-stat-card-label { color: var(--sc-muted); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 2px; }

/* Blocs dashboard */
.sc-dash-block { background: var(--sc-dark-3); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius-lg); padding: 1.5rem; }
.sc-dash-block-title { font-family: var(--sc-font-display); font-size: 1.1rem; letter-spacing: 1px; margin-bottom: 1rem; display: flex; align-items: center; }

/* Admin links */
.sc-admin-link { display: flex; align-items: center; gap: 10px; background: var(--sc-dark-4); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius); padding: 0.85rem 1rem; color: var(--sc-light); font-size: 0.85rem; text-decoration: none; transition: border-color var(--sc-transition), background var(--sc-transition); }
.sc-admin-link:hover { border-color: var(--sc-blue); background: rgba(26,107,255,0.07); color: var(--sc-white); }

/* Event rows */
.sc-event-row { display: flex; align-items: center; gap: 12px; background: var(--sc-dark-4); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius); padding: 1rem; }

/* Table */
.sc-table-wrap { overflow-x: auto; }
.sc-table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }
.sc-table th { color: var(--sc-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.6rem 0.75rem; border-bottom: 1px solid rgba(255,255,255,0.08); font-weight: 500; white-space: nowrap; }
.sc-table td { padding: 0.75rem; border-bottom: 1px solid rgba(255,255,255,0.04); color: var(--sc-light); vertical-align: middle; }
.sc-table tr:last-child td { border-bottom: none; }
.sc-table tr:hover td { background: rgba(255,255,255,0.02); }

/* Profile rows */
.sc-profile-row { display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
.sc-profile-row:last-child { border-bottom: none; }

/* Quick links */
.sc-quick-link { display: flex; align-items: center; gap: 10px; padding: 0.65rem 0.75rem; border-radius: var(--sc-radius); color: var(--sc-light); font-size: 0.875rem; text-decoration: none; transition: background var(--sc-transition); }
.sc-quick-link:hover { background: rgba(26,107,255,0.08); color: var(--sc-white); }
</style>