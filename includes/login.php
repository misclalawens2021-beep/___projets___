<?php
$page_title = 'Connexion';
if (session_status() === PHP_SESSION_NONE) session_start();

// Rediriger si déjà connecté
if (isset($_SESSION['user'])) {
    header('Location: /pages/dashboard.php');
    exit;
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login    = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$login || !$password) {
        $error = 'Veuillez remplir tous les champs.';
    } else {
        // =====================================================
        // AUTHENTIFICATION LDAP (Active Directory)
        // À activer une fois le serveur AD opérationnel (SISR)
        // =====================================================
        $ldap_host   = '172.20.1.14';
        $ldap_port   = 389;
        $ldap_domain = 'stadiumcompany.com';
        $ldap_base   = 'DC=stadiumcompany,DC=com';

        $auth_ok = false;
        $user_info = [];

        // --- Tentative LDAP ---
        if (function_exists('ldap_connect')) {
            $ldap = @ldap_connect($ldap_host, $ldap_port);
            if ($ldap) {
                ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
                $bind_dn = $login . '@' . $ldap_domain;
                $bind = @ldap_bind($ldap, $bind_dn, $password);
                if ($bind) {
                    // Récupérer les infos de l'utilisateur
                    $filter = "(sAMAccountName=$login)";
                    $attrs  = ['cn', 'givenname', 'sn', 'mail', 'department', 'memberof'];
                    $search = @ldap_search($ldap, $ldap_base, $filter, $attrs);
                    if ($search) {
                        $entries = ldap_get_entries($ldap, $search);
                        if ($entries['count'] > 0) {
                            $entry = $entries[0];
                            $user_info = [
                                'login'   => $login,
                                'prenom'  => $entry['givenname'][0] ?? $login,
                                'nom'     => $entry['sn'][0] ?? '',
                                'email'   => $entry['mail'][0] ?? '',
                                'service' => $entry['department'][0] ?? '',
                                'role'    => 'employe',
                            ];
                            // Vérifier si admin (groupe GP_Admin)
                            $groups = $entry['memberof'] ?? [];
                            for ($i = 0; $i < ($groups['count'] ?? 0); $i++) {
                                if (str_contains($groups[$i], 'GP_Admin')) {
                                    $user_info['role'] = 'admin';
                                    break;
                                }
                            }
                            $auth_ok = true;
                        }
                    }
                    ldap_unbind($ldap);
                }
            }
        }

        // --- Mode démo (si LDAP non disponible) ---
        // À SUPPRIMER en production !
        if (!$auth_ok && $login === 'demo' && $password === 'demo1234') {
            $auth_ok = true;
            $user_info = [
                'login'   => 'demo',
                'prenom'  => 'Utilisateur',
                'nom'     => 'Demo',
                'email'   => 'demo@stadiumcompany.com',
                'service' => 'Administration',
                'role'    => 'employe',
            ];
        }
        if (!$auth_ok && $login === 'admin' && $password === 'admin1234') {
            $auth_ok = true;
            $user_info = [
                'login'   => 'admin',
                'prenom'  => 'Admin',
                'nom'     => 'StadiumCo',
                'email'   => 'admin@stadiumcompany.com',
                'service' => 'Administration',
                'role'    => 'admin',
            ];
        }

        if ($auth_ok) {
            session_regenerate_id(true);
            $_SESSION['user'] = $user_info;
            header('Location: /pages/dashboard.php');
            exit;
        } else {
            $error = 'Identifiants incorrects. Vérifiez votre login et mot de passe.';
        }
    }
}

require_once '../includes/header.php';
?>

<section class="sc-login-page">
    <div class="sc-login-bg">
        <div class="sc-login-bg-gradient"></div>
    </div>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: calc(100vh - 70px);">
            <div class="col-md-10 col-lg-8 col-xl-6 py-5">

                <div class="sc-login-card sc-reveal">

                    <!-- En-tête -->
                    <div class="text-center mb-4">
                        <div class="sc-login-logo mb-3">
                            <i class="bi bi-shield-fill-check"></i>
                        </div>
                        <h1 class="sc-section-title" style="font-size:2rem;">Espace Collaborateur</h1>
                        <p class="sc-card-text">Connectez-vous avec vos identifiants du domaine<br>
                            <strong style="color:var(--sc-blue);">stadiumcompany.com</strong>
                        </p>
                    </div>

                    <?php if ($error): ?>
                        <div class="sc-alert sc-alert-error sc-alert-auto mb-4">
                            <i class="bi bi-exclamation-triangle me-2"></i><?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="sc-label">Identifiant AD</label>
                            <div class="sc-input-group">
                                <i class="bi bi-person-fill sc-input-icon"></i>
                                <input type="text" name="login" class="sc-input sc-input-with-icon"
                                    placeholder="ex : jdupont"
                                    value="<?= htmlspecialchars($_POST['login'] ?? '') ?>"
                                    autocomplete="username" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="sc-label">Mot de passe</label>
                            <div class="sc-input-group">
                                <i class="bi bi-lock-fill sc-input-icon"></i>
                                <input type="password" name="password" id="passwordField"
                                    class="sc-input sc-input-with-icon"
                                    placeholder="••••••••"
                                    autocomplete="current-password" required>
                                <button type="button" class="sc-pwd-toggle" id="togglePwd" tabindex="-1">
                                    <i class="bi bi-eye-fill" id="togglePwdIcon"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="sc-btn-primary w-100 justify-content-center" style="padding:0.75rem;">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                        </button>
                    </form>

                    <hr style="border-color:rgba(255,255,255,0.08); margin: 1.75rem 0;">

                    <div class="sc-login-info">
                        <i class="bi bi-info-circle me-2" style="color:var(--sc-blue);"></i>
                        Accès réservé aux employés de StadiumCompany.<br>
                        En cas de problème, contactez le support IT :
                        <a href="mailto:support@stadiumcompany.com">support@stadiumcompany.com</a>
                    </div>

                    <!-- Comptes de démo (à supprimer en production) -->
                    <div class="sc-demo-box mt-3">
                        <p class="mb-2" style="color:var(--sc-muted);font-size:0.78rem;text-transform:uppercase;letter-spacing:1px;">Mode démo (sans AD)</p>
                        <div class="d-flex gap-2 flex-wrap">
                            <button class="sc-demo-btn" onclick="fillDemo('demo','demo1234')">
                                <i class="bi bi-person me-1"></i>Employé : demo / demo1234
                            </button>
                            <button class="sc-demo-btn sc-demo-btn-admin" onclick="fillDemo('admin','admin1234')">
                                <i class="bi bi-shield me-1"></i>Admin : admin / admin1234
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>

<style>
.sc-login-page { position: relative; }
.sc-login-bg { position: fixed; inset: 0; z-index: -1; pointer-events: none; }
.sc-login-bg-gradient {
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse at 15% 50%, rgba(26,107,255,0.12) 0%, transparent 55%),
        radial-gradient(ellipse at 85% 50%, rgba(232,32,58,0.1) 0%, transparent 55%);
}
.sc-login-card {
    background: var(--sc-dark-2);
    border: 1px solid rgba(26,107,255,0.2);
    border-radius: var(--sc-radius-lg);
    padding: 2.5rem;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}
.sc-login-logo {
    width: 64px; height: 64px; border-radius: 50%;
    background: var(--sc-gradient);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.8rem; color: white; margin: 0 auto;
}
.sc-label { display: block; color: var(--sc-muted); font-size: 0.82rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
.sc-input-group { position: relative; }
.sc-input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--sc-muted); font-size: 0.95rem; pointer-events: none; }
.sc-input { width: 100%; background: var(--sc-dark-4); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--sc-radius); color: var(--sc-white); padding: 0.7rem 0.9rem; font-size: 0.9rem; transition: border-color var(--sc-transition); outline: none; font-family: var(--sc-font-body); }
.sc-input-with-icon { padding-left: 2.4rem; }
.sc-input:focus { border-color: var(--sc-blue); }
.sc-pwd-toggle { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--sc-muted); cursor: pointer; padding: 4px; transition: color var(--sc-transition); }
.sc-pwd-toggle:hover { color: var(--sc-white); }
.sc-alert { padding: 0.9rem 1.1rem; border-radius: var(--sc-radius); font-size: 0.875rem; }
.sc-alert-error { background: rgba(232,32,58,0.1); border: 1px solid rgba(232,32,58,0.3); color: var(--sc-red); }
.sc-login-info { color: var(--sc-muted); font-size: 0.83rem; line-height: 1.7; }
.sc-demo-box { background: var(--sc-dark-3); border: 1px solid rgba(255,255,255,0.06); border-radius: var(--sc-radius); padding: 1rem; }
.sc-demo-btn {
    background: var(--sc-dark-4); border: 1px solid rgba(255,255,255,0.08);
    color: var(--sc-muted); font-size: 0.78rem; padding: 0.35rem 0.75rem;
    border-radius: var(--sc-radius); cursor: pointer; transition: all var(--sc-transition);
}
.sc-demo-btn:hover { border-color: var(--sc-blue); color: var(--sc-white); }
.sc-demo-btn-admin:hover { border-color: var(--sc-red); }
</style>

<script>
// Toggle mot de passe
const pwdField = document.getElementById('passwordField');
const toggleBtn = document.getElementById('togglePwd');
const toggleIcon = document.getElementById('togglePwdIcon');
if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        const isPassword = pwdField.type === 'password';
        pwdField.type = isPassword ? 'text' : 'password';
        toggleIcon.className = isPassword ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill';
    });
}

// Remplissage auto des comptes démo
function fillDemo(login, password) {
    document.querySelector('input[name="login"]').value = login;
    document.querySelector('input[name="password"]').value = password;
}
</script>