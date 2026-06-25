<?php
$page_title = 'Restauration';
require_once '../includes/header.php';
?>

<section class="sc-page-hero">
    <div class="container">
        <div class="sc-accent-line"></div>
        <h1 class="sc-section-title">Restauration</h1>
        <p class="sc-section-subtitle">Une expérience gastronomique au cœur du stade</p>
    </div>
</section>

<!-- Présentation -->
<section class="sc-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 sc-reveal">
                <div class="sc-accent-line"></div>
                <h2 class="sc-section-title">Le Restaurant <span class="text-gradient">du Stade</span></h2>
                <p style="color:var(--sc-muted); line-height:1.8;" class="mb-4">
                    Situé au cœur de StadiumCompany, notre restaurant gastronomique vous accueille 
                    avant, pendant et après chaque événement. Profitez d'une cuisine raffinée avec 
                    vue panoramique sur le stade.
                </p>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="sc-info-chip">
                            <i class="bi bi-people-fill"></i>
                            <div><strong>14</strong><br><span>Employés dédiés</span></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="sc-info-chip">
                            <i class="bi bi-clock-fill"></i>
                            <div><strong>12h – 22h</strong><br><span>Jours d'événements</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 sc-reveal">
                <div class="sc-resto-visual">
                    <i class="bi bi-fork-knife"></i>
                    <p>Restaurant panoramique</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Menus -->
<section class="sc-section" style="background: var(--sc-dark-2);">
    <div class="container">
        <div class="text-center sc-reveal mb-5">
            <div class="sc-accent-line mx-auto"></div>
            <h2 class="sc-section-title">Nos Menus</h2>
            <p class="sc-section-subtitle">Une cuisine qui sublime chaque occasion</p>
        </div>
        <div class="row g-4">
            <?php
            $menus = [
                ['nom' => 'Menu Découverte',  'prix' => '35 €',  'desc' => 'Entrée + Plat ou Plat + Dessert', 'items' => ['Soupe du moment', 'Plat du jour', 'Dessert au choix'], 'color' => 'var(--sc-blue)', 'icon' => 'bi-egg-fried'],
                ['nom' => 'Menu Prestige',    'prix' => '65 €',  'desc' => 'Entrée + Plat + Dessert + Café',  'items' => ['Foie gras maison', 'Magret de canard', 'Fondant chocolat', 'Café gourmand'], 'color' => '#f59e0b', 'icon' => 'bi-award-fill'],
                ['nom' => 'Menu VIP',         'prix' => '120 €', 'desc' => 'Expérience gastronomique complète','items' => ['Plateau de fruits de mer', 'Filet mignon', 'Assortiment de fromages', 'Dessert du chef', 'Champagne inclus'], 'color' => 'var(--sc-red)', 'icon' => 'bi-star-fill'],
            ];
            foreach ($menus as $menu): ?>
            <div class="col-md-4 sc-reveal">
                <div class="sc-card h-100 sc-menu-card">
                    <div class="sc-menu-header" style="background: radial-gradient(ellipse at top, rgba(<?= $menu['color'] === 'var(--sc-blue)' ? '26,107,255' : ($menu['color'] === '#f59e0b' ? '245,158,11' : '232,32,58') ?>,0.2), transparent);">
                        <i class="bi <?= $menu['icon'] ?>" style="font-size:2.5rem; color:<?= $menu['color'] ?>"></i>
                        <h3 class="sc-card-title mt-3"><?= $menu['nom'] ?></h3>
                        <p class="sc-card-text"><?= $menu['desc'] ?></p>
                        <div class="sc-menu-prix" style="color:<?= $menu['color'] ?>"><?= $menu['prix'] ?></div>
                        <span class="sc-menu-label">par personne</span>
                    </div>
                    <div class="sc-card-body">
                        <ul class="sc-menu-items">
                            <?php foreach ($menu['items'] as $item): ?>
                            <li><i class="bi bi-check2 me-2" style="color:<?= $menu['color'] ?>"></i><?= $item ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Réservation de table -->
<section class="sc-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="text-center sc-reveal mb-5">
                    <div class="sc-accent-line mx-auto"></div>
                    <h2 class="sc-section-title">Réserver une Table</h2>
                    <p class="sc-section-subtitle">Disponible les jours d'événements uniquement</p>
                </div>

                <div class="sc-form-card sc-reveal">
                    <?php
                    $success = false;
                    $errors  = [];

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $nom        = trim(htmlspecialchars($_POST['nom'] ?? ''));
                        $email      = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                        $date       = trim($_POST['date'] ?? '');
                        $couverts   = (int) ($_POST['couverts'] ?? 0);
                        $commentaire = trim(htmlspecialchars($_POST['commentaire'] ?? ''));

                        if (!$nom)    $errors[] = 'Le nom est requis.';
                        if (!$email)  $errors[] = 'L\'email est invalide.';
                        if (!$date)   $errors[] = 'La date est requise.';
                        if ($couverts < 1 || $couverts > 20) $errors[] = 'Nombre de couverts invalide (1–20).';

                        if (empty($errors)) {
                            // TODO : insérer en BDD via PDO
                            // $pdo->prepare("INSERT INTO reservations_restaurant ...")->execute([...]);
                            $success = true;
                        }
                    }
                    ?>

                    <?php if ($success): ?>
                        <div class="sc-alert sc-alert-success">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Réservation envoyée ! Nous vous confirmons par email sous 24h.
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>
                        <div class="sc-alert sc-alert-error mb-4">
                            <?php foreach ($errors as $e): ?>
                                <div><i class="bi bi-exclamation-triangle me-2"></i><?= $e ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="sc-label">Nom complet *</label>
                                <input type="text" name="nom" class="sc-input" placeholder="Jean Dupont"
                                    value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="sc-label">Email *</label>
                                <input type="email" name="email" class="sc-input" placeholder="jean@email.com"
                                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="sc-label">Date souhaitée *</label>
                                <input type="date" name="date" class="sc-input"
                                    value="<?= htmlspecialchars($_POST['date'] ?? '') ?>"
                                    min="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="sc-label">Nombre de couverts *</label>
                                <input type="number" name="couverts" class="sc-input" min="1" max="20" placeholder="2"
                                    value="<?= htmlspecialchars($_POST['couverts'] ?? '') ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="sc-label">Commentaire / Allergies</label>
                                <textarea name="commentaire" class="sc-input sc-textarea" rows="3"
                                    placeholder="Régime particulier, occasion spéciale..."><?= htmlspecialchars($_POST['commentaire'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="sc-btn-primary w-100 justify-content-center">
                                    <i class="bi bi-calendar-check-fill me-2"></i>Envoyer la demande
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>

<style>
.sc-page-hero { padding: 60px 0 30px; background: var(--sc-dark-2); border-bottom: 1px solid rgba(255,255,255,0.06); }
.sc-resto-visual {
    height: 340px; border-radius: var(--sc-radius-lg);
    background: var(--sc-dark-3); border: 1px solid rgba(255,255,255,0.06);
    background-image: radial-gradient(ellipse at center, rgba(232,32,58,0.15), transparent 70%);
    display: flex; flex-direction: column; align-items: center; justify-content: center;
}
.sc-resto-visual i { font-size: 5rem; opacity: 0.2; color: var(--sc-red); }
.sc-resto-visual p { color: var(--sc-muted); margin-top: 1rem; }
.sc-info-chip { background: var(--sc-dark-3); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius); padding: 1rem; display: flex; gap: 12px; align-items: center; }
.sc-info-chip i { font-size: 1.5rem; color: var(--sc-blue); }
.sc-info-chip strong { font-size: 1.1rem; }
.sc-info-chip span { color: var(--sc-muted); font-size: 0.8rem; }
.sc-menu-header { padding: 2rem; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.06); }
.sc-menu-prix { font-family: var(--sc-font-display); font-size: 2.5rem; letter-spacing: 1px; }
.sc-menu-label { color: var(--sc-muted); font-size: 0.8rem; }
.sc-menu-items { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px; }
.sc-menu-items li { color: var(--sc-muted); font-size: 0.88rem; }
.sc-form-card { background: var(--sc-dark-3); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius-lg); padding: 2rem; }
.sc-label { display: block; color: var(--sc-muted); font-size: 0.82rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
.sc-input { width: 100%; background: var(--sc-dark-4); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--sc-radius); color: var(--sc-white); padding: 0.65rem 0.9rem; font-size: 0.9rem; transition: border-color var(--sc-transition); outline: none; font-family: var(--sc-font-body); }
.sc-input:focus { border-color: var(--sc-blue); }
.sc-textarea { resize: vertical; min-height: 90px; }
.sc-alert { padding: 1rem 1.25rem; border-radius: var(--sc-radius); font-size: 0.9rem; margin-bottom: 1.5rem; }
.sc-alert-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #22c55e; }
.sc-alert-error { background: rgba(232,32,58,0.1); border: 1px solid rgba(232,32,58,0.3); color: var(--sc-red); }
</style>