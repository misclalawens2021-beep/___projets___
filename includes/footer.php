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