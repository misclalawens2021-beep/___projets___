<?php
$page_title = 'Billetterie';
require_once '../includes/header.php';
?>

<section class="sc-page-hero">
    <div class="container">
        <div class="sc-accent-line"></div>
        <h1 class="sc-section-title">Billetterie</h1>
        <p class="sc-section-subtitle">Choisissez votre événement et réservez vos places</p>
    </div>
</section>

<section class="sc-section">
    <div class="container">
        <div class="row g-5">

            <!-- Colonne gauche : sélection événement + catégorie -->
            <div class="col-lg-7">

                <!-- Étape 1 : Événement -->
                <div class="sc-step-block sc-reveal">
                    <div class="sc-step-header">
                        <span class="sc-step-num">01</span>
                        <h2 class="sc-step-title">Choisir un événement</h2>
                    </div>
                    <div class="row g-3 mt-2">
                        <?php
                        $evenements = [
                            ['id' => 1, 'titre' => 'Match de Football',  'date' => '28 Juin 2026',  'heure' => '20h30'],
                            ['id' => 2, 'titre' => 'Concert Rock',        'date' => '5 Juil. 2026',  'heure' => '19h00'],
                            ['id' => 3, 'titre' => 'Gala Sportif',        'date' => '12 Juil. 2026', 'heure' => '18h00'],
                            ['id' => 4, 'titre' => 'Derby Régional',      'date' => '19 Juil. 2026', 'heure' => '21h00'],
                        ];
                        foreach ($evenements as $evt): ?>
                        <div class="col-12">
                            <label class="sc-event-radio">
                                <input type="radio" name="evenement" value="<?= $evt['id'] ?>" <?= $evt['id'] === 1 ? 'checked' : '' ?>>
                                <div class="sc-event-radio-body">
                                    <div>
                                        <strong><?= $evt['titre'] ?></strong>
                                        <div class="sc-card-text small mt-1">
                                            <i class="bi bi-calendar3 me-1"></i><?= $evt['date'] ?>
                                            <span class="mx-2">·</span>
                                            <i class="bi bi-clock me-1"></i><?= $evt['heure'] ?>
                                        </div>
                                    </div>
                                    <i class="bi bi-check-circle-fill sc-radio-check"></i>
                                </div>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Étape 2 : Catégorie de place -->
                <div class="sc-step-block sc-reveal mt-4">
                    <div class="sc-step-header">
                        <span class="sc-step-num">02</span>
                        <h2 class="sc-step-title">Catégorie de place</h2>
                    </div>
                    <div class="row g-3 mt-2">
                        <?php
                        $categories = [
                            ['nom' => 'Pelouse',  'desc' => 'Zone debout, ambiance garantie', 'prix' => 25,  'color' => '#22c55e'],
                            ['nom' => 'Tribune',  'desc' => 'Place assise avec bonne visibilité', 'prix' => 45,  'color' => 'var(--sc-blue)'],
                            ['nom' => 'VIP',      'desc' => 'Siège premium avec service inclus', 'prix' => 120, 'color' => '#f59e0b'],
                            ['nom' => 'Loge',     'desc' => 'Loge privée, jusqu\'à 10 personnes', 'prix' => 500, 'color' => 'var(--sc-red)'],
                        ];
                        foreach ($categories as $i => $cat): ?>
                        <div class="col-6">
                            <label class="sc-cat-radio">
                                <input type="radio" name="categorie" value="<?= $cat['nom'] ?>" <?= $i === 1 ? 'checked' : '' ?>>
                                <div class="sc-cat-radio-body">
                                    <span class="sc-cat-dot" style="background:<?= $cat['color'] ?>"></span>
                                    <div>
                                        <strong><?= $cat['nom'] ?></strong>
                                        <div class="sc-card-text" style="font-size:0.78rem;"><?= $cat['desc'] ?></div>
                                    </div>
                                    <span class="sc-cat-prix text-gradient"><?= $cat['prix'] ?> €</span>
                                </div>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Étape 3 : Quantité -->
                <div class="sc-step-block sc-reveal mt-4">
                    <div class="sc-step-header">
                        <span class="sc-step-num">03</span>
                        <h2 class="sc-step-title">Nombre de places</h2>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <button class="sc-qty-btn" id="qtyMinus"><i class="bi bi-dash"></i></button>
                        <span class="sc-qty-val" id="qtyVal">1</span>
                        <button class="sc-qty-btn" id="qtyPlus"><i class="bi bi-plus"></i></button>
                        <span class="sc-card-text">(max 10 par commande)</span>
                    </div>
                </div>

            </div>

            <!-- Colonne droite : récapitulatif -->
            <div class="col-lg-5">
                <div class="sc-recap sc-reveal sticky-top" style="top: 90px;">
                    <h3 class="sc-recap-title">Récapitulatif</h3>

                    <div class="sc-recap-line">
                        <span class="sc-card-text">Événement</span>
                        <span id="recapEvt">Match de Football</span>
                    </div>
                    <div class="sc-recap-line">
                        <span class="sc-card-text">Date</span>
                        <span id="recapDate">28 Juin 2026 — 20h30</span>
                    </div>
                    <div class="sc-recap-line">
                        <span class="sc-card-text">Catégorie</span>
                        <span id="recapCat">Tribune</span>
                    </div>
                    <div class="sc-recap-line">
                        <span class="sc-card-text">Quantité</span>
                        <span id="recapQty">1 place</span>
                    </div>

                    <hr style="border-color: rgba(255,255,255,0.08);">

                    <div class="sc-recap-total">
                        <span>Total</span>
                        <span class="text-gradient" id="recapTotal">45,00 €</span>
                    </div>

                    <?php if (isset($_SESSION['user'])): ?>
                        <button class="sc-btn-primary w-100 justify-content-center mt-4" id="btnReserver">
                            <i class="bi bi-lock-fill me-2"></i>Confirmer la réservation
                        </button>
                    <?php else: ?>
                        <a href="/pages/login.php" class="sc-btn-primary w-100 justify-content-center mt-4 d-flex">
                            <i class="bi bi-person-fill me-2"></i>Se connecter pour réserver
                        </a>
                        <p class="sc-card-text text-center mt-2" style="font-size:0.8rem;">
                            Un compte est requis pour finaliser votre réservation
                        </p>
                    <?php endif; ?>

                    <div class="sc-recap-garanties mt-4">
                        <div class="sc-garantie"><i class="bi bi-shield-check-fill"></i> Paiement sécurisé</div>
                        <div class="sc-garantie"><i class="bi bi-envelope-fill"></i> Billet envoyé par email</div>
                        <div class="sc-garantie"><i class="bi bi-qr-code"></i> QR Code d'entrée</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>

<style>
.sc-page-hero { padding: 60px 0 30px; background: var(--sc-dark-2); border-bottom: 1px solid rgba(255,255,255,0.06); }
.sc-step-block { background: var(--sc-dark-3); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius-lg); padding: 1.75rem; }
.sc-step-header { display: flex; align-items: center; gap: 14px; }
.sc-step-num { font-family: var(--sc-font-display); font-size: 2rem; background: var(--sc-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1; }
.sc-step-title { font-family: var(--sc-font-display); font-size: 1.3rem; letter-spacing: 1px; margin: 0; }

.sc-event-radio input { display: none; }
.sc-event-radio-body {
    display: flex; justify-content: space-between; align-items: center;
    background: var(--sc-dark-4); border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--sc-radius); padding: 1rem 1.25rem; cursor: pointer;
    transition: border-color var(--sc-transition), background var(--sc-transition);
}
.sc-event-radio input:checked + .sc-event-radio-body { border-color: var(--sc-blue); background: rgba(26,107,255,0.08); }
.sc-radio-check { color: rgba(255,255,255,0.15); font-size: 1.2rem; transition: color var(--sc-transition); }
.sc-event-radio input:checked + .sc-event-radio-body .sc-radio-check { color: var(--sc-blue); }

.sc-cat-radio input { display: none; }
.sc-cat-radio-body {
    display: flex; align-items: center; gap: 10px;
    background: var(--sc-dark-4); border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--sc-radius); padding: 0.9rem 1rem; cursor: pointer;
    transition: border-color var(--sc-transition); height: 100%;
}
.sc-cat-radio input:checked + .sc-cat-radio-body { border-color: var(--sc-blue); background: rgba(26,107,255,0.08); }
.sc-cat-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
.sc-cat-prix { margin-left: auto; font-weight: 700; white-space: nowrap; }

.sc-qty-btn {
    width: 38px; height: 38px; border-radius: 50%;
    background: var(--sc-dark-4); border: 1px solid rgba(255,255,255,0.1);
    color: var(--sc-white); font-size: 1rem; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: background var(--sc-transition);
}
.sc-qty-btn:hover { background: var(--sc-blue); border-color: var(--sc-blue); }
.sc-qty-val { font-family: var(--sc-font-display); font-size: 2rem; min-width: 40px; text-align: center; }

.sc-recap { background: var(--sc-dark-3); border: 1px solid rgba(26,107,255,0.2); border-radius: var(--sc-radius-lg); padding: 1.75rem; }
.sc-recap-title { font-family: var(--sc-font-display); font-size: 1.4rem; letter-spacing: 1px; margin-bottom: 1.25rem; }
.sc-recap-line { display: flex; justify-content: space-between; padding: 0.6rem 0; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.9rem; }
.sc-recap-total { display: flex; justify-content: space-between; font-size: 1.25rem; font-weight: 700; padding-top: 0.5rem; }
.sc-recap-garanties { display: flex; flex-direction: column; gap: 8px; }
.sc-garantie { display: flex; align-items: center; gap: 8px; color: var(--sc-muted); font-size: 0.82rem; }
.sc-garantie i { color: var(--sc-blue); }
</style>

<script>
const prix = { 'Pelouse': 25, 'Tribune': 45, 'VIP': 120, 'Loge': 500 };
const dates = { 1: '28 Juin 2026 — 20h30', 2: '5 Juil. 2026 — 19h00', 3: '12 Juil. 2026 — 18h00', 4: '19 Juil. 2026 — 21h00' };
const titres = { 1: 'Match de Football', 2: 'Concert Rock', 3: 'Gala Sportif', 4: 'Derby Régional' };
let qty = 1, cat = 'Tribune';

function updateRecap() {
    const total = (prix[cat] * qty).toFixed(2).replace('.', ',');
    document.getElementById('recapQty').textContent = qty + ' place' + (qty > 1 ? 's' : '');
    document.getElementById('recapCat').textContent = cat;
    document.getElementById('recapTotal').textContent = total + ' €';
}

document.querySelectorAll('input[name="evenement"]').forEach(r => {
    r.addEventListener('change', function () {
        document.getElementById('recapEvt').textContent = titres[this.value];
        document.getElementById('recapDate').textContent = dates[this.value];
    });
});

document.querySelectorAll('input[name="categorie"]').forEach(r => {
    r.addEventListener('change', function () { cat = this.value; updateRecap(); });
});

document.getElementById('qtyPlus').addEventListener('click', () => { if (qty < 10) { qty++; document.getElementById('qtyVal').textContent = qty; updateRecap(); } });
document.getElementById('qtyMinus').addEventListener('click', () => { if (qty > 1) { qty--; document.getElementById('qtyVal').textContent = qty; updateRecap(); } });
</script>