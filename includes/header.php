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