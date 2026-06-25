<?php
$page_title = 'Boutique';
require_once '../includes/header.php';
?>

<section class="sc-page-hero">
    <div class="container">
        <div class="sc-accent-line"></div>
        <h1 class="sc-section-title">Boutique Officielle</h1>
        <p class="sc-section-subtitle">Produits exclusifs aux couleurs de StadiumCompany</p>
    </div>
</section>

<section class="sc-section">
    <div class="container">

        <!-- Filtres catégories -->
        <div class="sc-filters mb-5 sc-reveal">
            <button class="sc-filter-btn active" data-filter="tous">Tous</button>
            <button class="sc-filter-btn" data-filter="maillots">Maillots</button>
            <button class="sc-filter-btn" data-filter="accessoires">Accessoires</button>
            <button class="sc-filter-btn" data-filter="collectors">Collectors</button>
        </div>

        <!-- Grille produits -->
        <div class="row g-4" id="shopGrid">
            <?php
            $produits = [
                ['nom' => 'Maillot Domicile 2026',  'prix' => 79.99,  'cat' => 'maillots',    'stock' => 'En stock',   'badge' => 'Nouveau'],
                ['nom' => 'Maillot Extérieur 2026', 'prix' => 79.99,  'cat' => 'maillots',    'stock' => 'En stock',   'badge' => 'Nouveau'],
                ['nom' => 'Écharpe Officielle',      'prix' => 24.99,  'cat' => 'accessoires', 'stock' => 'En stock',   'badge' => null],
                ['nom' => 'Casquette StadiumCo',     'prix' => 19.99,  'cat' => 'accessoires', 'stock' => 'En stock',   'badge' => null],
                ['nom' => 'Mug Collector',            'prix' => 14.99,  'cat' => 'collectors',  'stock' => 'En stock',   'badge' => 'Limité'],
                ['nom' => 'Drapeau du Stade',         'prix' => 12.99,  'cat' => 'accessoires', 'stock' => 'En stock',   'badge' => null],
                ['nom' => 'Veste Supporter',          'prix' => 89.99,  'cat' => 'maillots',    'stock' => 'Rupture',    'badge' => null],
                ['nom' => 'Ballon Signé',             'prix' => 49.99,  'cat' => 'collectors',  'stock' => 'En stock',   'badge' => 'Limité'],
                ['nom' => 'Porte-clés Stade',         'prix' => 7.99,   'cat' => 'accessoires', 'stock' => 'En stock',   'badge' => null],
                ['nom' => 'Photo Encadrée',           'prix' => 34.99,  'cat' => 'collectors',  'stock' => 'En stock',   'badge' => null],
                ['nom' => 'Bonnet Hiver',             'prix' => 17.99,  'cat' => 'accessoires', 'stock' => 'En stock',   'badge' => null],
                ['nom' => 'Kit Supporter Complet',   'prix' => 149.99, 'cat' => 'collectors',  'stock' => 'En stock',   'badge' => 'Pack'],
            ];
            foreach ($produits as $p):
                $rupture = $p['stock'] === 'Rupture';
            ?>
            <div class="col-6 col-md-4 col-lg-3 sc-reveal sc-product-card" data-cat="<?= $p['cat'] ?>">
                <div class="sc-card h-100 <?= $rupture ? 'sc-card-rupture' : '' ?>">
                    <div class="sc-product-thumb position-relative">
                        <i class="bi bi-bag-fill sc-product-icon"></i>
                        <?php if ($p['badge']): ?>
                            <span class="sc-product-badge"><?= $p['badge'] ?></span>
                        <?php endif; ?>
                        <?php if ($rupture): ?>
                            <div class="sc-rupture-overlay">Rupture de stock</div>
                        <?php endif; ?>
                    </div>
                    <div class="sc-card-body d-flex flex-column">
                        <h4 class="sc-card-title" style="font-size:0.95rem;"><?= $p['nom'] ?></h4>
                        <p class="text-gradient fw-bold fs-5 mb-3"><?= number_format($p['prix'], 2, ',', ' ') ?> €</p>
                        <button class="sc-btn-primary w-100 justify-content-center mt-auto sc-add-cart"
                            <?= $rupture ? 'disabled style="opacity:0.4;cursor:not-allowed;"' : '' ?>>
                            <i class="bi bi-cart-plus"></i>
                            <?= $rupture ? 'Indisponible' : 'Ajouter au panier' ?>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- Toast panier -->
<div class="sc-toast" id="cartToast">
    <i class="bi bi-check-circle-fill me-2" style="color: #22c55e;"></i>
    Article ajouté au panier !
</div>

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
.sc-filter-btn:hover, .sc-filter-btn.active { background: var(--sc-blue); color: var(--sc-white); border-color: var(--sc-blue); }

.sc-product-thumb {
    height: 180px; background: var(--sc-dark-4);
    display: flex; align-items: center; justify-content: center; overflow: hidden;
    background-image: radial-gradient(ellipse at center, rgba(26,107,255,0.1), transparent 70%);
}
.sc-product-icon { font-size: 3rem; opacity: 0.2; color: var(--sc-blue); }
.sc-product-badge {
    position: absolute; top: 10px; right: 10px;
    background: var(--sc-red); color: var(--sc-white);
    font-size: 0.7rem; font-weight: 700; padding: 3px 8px; border-radius: 10px;
    text-transform: uppercase; letter-spacing: 0.5px;
}
.sc-rupture-overlay {
    position: absolute; inset: 0; background: rgba(10,12,16,0.65);
    display: flex; align-items: center; justify-content: center;
    color: var(--sc-muted); font-size: 0.8rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase;
}
.sc-card-rupture { opacity: 0.7; }

.sc-toast {
    position: fixed; bottom: 30px; right: 30px; z-index: 9999;
    background: var(--sc-dark-3); border: 1px solid rgba(34,197,94,0.4);
    color: var(--sc-white); padding: 0.85rem 1.25rem; border-radius: var(--sc-radius);
    font-size: 0.9rem; display: flex; align-items: center;
    transform: translateY(80px); opacity: 0; transition: all 0.35s ease;
    pointer-events: none;
}
.sc-toast.show { transform: translateY(0); opacity: 1; }
</style>

<script>
document.querySelectorAll('.sc-filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.sc-filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        document.querySelectorAll('.sc-product-card').forEach(card => {
            card.style.display = (filter === 'tous' || card.dataset.cat === filter) ? '' : 'none';
        });
    });
});

const toast = document.getElementById('cartToast');
document.querySelectorAll('.sc-add-cart:not([disabled])').forEach(btn => {
    btn.addEventListener('click', function () {
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    });
});
</script>