<?php
$page_title = 'Contact';
require_once '../includes/header.php';

$success = false;
$errors  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation CSRF (à compléter avec un vrai token en session)
    $nom     = trim(htmlspecialchars($_POST['nom'] ?? ''));
    $email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $sujet   = trim(htmlspecialchars($_POST['sujet'] ?? ''));
    $message = trim(htmlspecialchars($_POST['message'] ?? ''));

    if (!$nom)     $errors[] = 'Le nom est requis.';
    if (!$email)   $errors[] = 'L\'email est invalide.';
    if (!$sujet)   $errors[] = 'Le sujet est requis.';
    if (strlen($message) < 10) $errors[] = 'Le message est trop court (10 caractères minimum).';

    if (empty($errors)) {
        // TODO : insérer en BDD
        // $pdo->prepare("INSERT INTO contacts (nom, email, sujet, message, date, traite) VALUES (?,?,?,?,NOW(),0)")
        //     ->execute([$nom, $email, $sujet, $message]);
        $success = true;
    }
}
?>

<section class="sc-page-hero">
    <div class="container">
        <div class="sc-accent-line"></div>
        <h1 class="sc-section-title">Contact</h1>
        <p class="sc-section-subtitle">Une question ? Écrivez-nous, nous répondons sous 24h</p>
    </div>
</section>

<section class="sc-section">
    <div class="container">
        <div class="row g-5">

            <!-- Formulaire -->
            <div class="col-lg-7 sc-reveal">
                <div class="sc-form-card">
                    <h2 class="sc-step-title mb-4">Envoyer un message</h2>

                    <?php if ($success): ?>
                        <div class="sc-alert sc-alert-success sc-alert-auto">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Message envoyé ! Nous vous répondrons dans les plus brefs délais.
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
                            <div class="col-12">
                                <label class="sc-label">Sujet *</label>
                                <select name="sujet" class="sc-input sc-select" required>
                                    <option value="">Choisir un sujet</option>
                                    <option value="Billetterie"   <?= ($_POST['sujet'] ?? '') === 'Billetterie'   ? 'selected' : '' ?>>Billetterie</option>
                                    <option value="Restauration"  <?= ($_POST['sujet'] ?? '') === 'Restauration'  ? 'selected' : '' ?>>Restauration</option>
                                    <option value="Boutique"      <?= ($_POST['sujet'] ?? '') === 'Boutique'      ? 'selected' : '' ?>>Boutique</option>
                                    <option value="VIP / Presse"  <?= ($_POST['sujet'] ?? '') === 'VIP / Presse'  ? 'selected' : '' ?>>VIP / Presse</option>
                                    <option value="Partenariat"   <?= ($_POST['sujet'] ?? '') === 'Partenariat'   ? 'selected' : '' ?>>Partenariat</option>
                                    <option value="Autre"         <?= ($_POST['sujet'] ?? '') === 'Autre'         ? 'selected' : '' ?>>Autre</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="sc-label">Message *</label>
                                <textarea name="message" class="sc-input sc-textarea" rows="5"
                                    placeholder="Décrivez votre demande..."
                                    required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="sc-btn-primary w-100 justify-content-center">
                                    <i class="bi bi-send-fill me-2"></i>Envoyer le message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Infos de contact -->
            <div class="col-lg-5 sc-reveal">
                <h2 class="sc-step-title mb-4">Nos coordonnées</h2>

                <div class="d-flex flex-column gap-3">
                    <?php
                    $sites = [
                        ['icon' => 'bi-geo-alt-fill',  'color' => 'var(--sc-blue)', 'titre' => 'Stade Principal',         'ligne1' => '1 Avenue du Stade',     'ligne2' => '75001 Paris'],
                        ['icon' => 'bi-ticket-fill',   'color' => 'var(--sc-red)',  'titre' => 'Billetterie Centre-ville', 'ligne1' => '45 Rue du Commerce',    'ligne2' => '75001 Paris'],
                        ['icon' => 'bi-bag-fill',       'color' => '#22c55e',        'titre' => 'Boutique Souvenirs',       'ligne1' => '12 Bd des Sports',      'ligne2' => '75001 Paris'],
                    ];
                    foreach ($sites as $s): ?>
                    <div class="sc-contact-card">
                        <div class="sc-contact-icon" style="background: rgba(<?= $s['color'] === 'var(--sc-blue)' ? '26,107,255' : ($s['color'] === 'var(--sc-red)' ? '232,32,58' : '34,197,94') ?>,0.12); color:<?= $s['color'] ?>">
                            <i class="bi <?= $s['icon'] ?>"></i>
                        </div>
                        <div>
                            <strong><?= $s['titre'] ?></strong>
                            <div class="sc-card-text" style="font-size:0.85rem;"><?= $s['ligne1'] ?><br><?= $s['ligne2'] ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="sc-contact-card mt-3">
                    <div class="sc-contact-icon" style="background: rgba(26,107,255,0.12); color:var(--sc-blue)">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div>
                        <strong>Téléphone</strong>
                        <div class="sc-card-text" style="font-size:0.85rem;">+33 1 23 45 67 89<br>Lun – Ven : 9h – 18h</div>
                    </div>
                </div>

                <div class="sc-contact-card mt-3">
                    <div class="sc-contact-icon" style="background: rgba(26,107,255,0.12); color:var(--sc-blue)">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div>
                        <strong>Email</strong>
                        <div class="sc-card-text" style="font-size:0.85rem;">
                            <a href="mailto:contact@stadiumcompany.com">contact@stadiumcompany.com</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>

<style>
.sc-page-hero { padding: 60px 0 30px; background: var(--sc-dark-2); border-bottom: 1px solid rgba(255,255,255,0.06); }
.sc-form-card { background: var(--sc-dark-3); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius-lg); padding: 2rem; }
.sc-step-title { font-family: var(--sc-font-display); font-size: 1.5rem; letter-spacing: 1px; }
.sc-label { display: block; color: var(--sc-muted); font-size: 0.82rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
.sc-input { width: 100%; background: var(--sc-dark-4); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--sc-radius); color: var(--sc-white); padding: 0.65rem 0.9rem; font-size: 0.9rem; transition: border-color var(--sc-transition); outline: none; font-family: var(--sc-font-body); }
.sc-input:focus { border-color: var(--sc-blue); }
.sc-select { appearance: none; cursor: pointer; }
.sc-select option { background: var(--sc-dark-3); }
.sc-textarea { resize: vertical; min-height: 120px; }
.sc-alert { padding: 1rem 1.25rem; border-radius: var(--sc-radius); font-size: 0.9rem; margin-bottom: 1.5rem; }
.sc-alert-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #22c55e; }
.sc-alert-error { background: rgba(232,32,58,0.1); border: 1px solid rgba(232,32,58,0.3); color: var(--sc-red); }
.sc-contact-card { background: var(--sc-dark-3); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius); padding: 1.1rem; display: flex; align-items: flex-start; gap: 14px; }
.sc-contact-icon { width: 42px; height: 42px; border-radius: var(--sc-radius); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
</style>