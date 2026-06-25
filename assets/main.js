/* ============================================================
   StadiumCompany — main.js
   ============================================================ */

document.addEventListener('DOMContentLoaded', function () {

    // ----- Navbar : effet scroll -----
    const navbar = document.querySelector('.sc-navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.borderBottomColor = 'rgba(26, 107, 255, 0.4)';
            } else {
                navbar.style.borderBottomColor = 'rgba(26, 107, 255, 0.2)';
            }
        });
    }

    // ----- Reveal au scroll (Intersection Observer) -----
    const revealEls = document.querySelectorAll('.sc-reveal');
    if (revealEls.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('sc-revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealEls.forEach(el => observer.observe(el));
    }

    // ----- Token CSRF : ajout automatique sur tous les formulaires -----
    // (Le token est généré côté PHP dans chaque formulaire, ce JS est un fallback)

    // ----- Flash messages : auto-fermeture -----
    const alerts = document.querySelectorAll('.sc-alert-auto');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s';
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    });

});