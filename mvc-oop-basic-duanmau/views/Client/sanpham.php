<?php 
// Include header
include __DIR__ . '/layout/Header.php';
?>

<style>
    .product-list-home {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    .product-card-home {
        background: #fff;
        border-radius: 1rem;
        border: 1px solid #e9ecef;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease-in-out;
        position: relative;
        overflow: hidden;
    }
    .product-card-home:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        border-color: #4e54c8;
    }
    .product-card-home img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        border: 1px solid #dee2e6;
        background: #f8f9fa;
        transition: transform 0.3s ease;
    }
    .product-card-home:hover img {
        transform: scale(1.05);
    }
    .product-card-home .name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0.5rem;
        min-height: 48px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-card-home .price {
        color: #28a745;
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .product-card-home .status {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .product-card-home .status.hien {
        background: #d4edda;
        color: #28a745;
    }
    .product-card-home .status.an {
        background: #f8d7da;
        color: #dc3545;
    }
    /* Add a subtle badge for new products */
    .product-card-home .new-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #4e54c8;
        color: #fff;
        padding: 0.25rem 0.5rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
    }
    @media (max-width: 576px) {
        .product-list-home {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
        .product-card-home {
            padding: 1rem;
        }
        .product-card-home img {
            width: 100px;
            height: 100px;
        }
    }
</style>

<main class="container my-5">
    <h1 class="display-5 fw-bold mb-3">Trang sản phẩm</h1>
    <p class="lead text-muted mb-4">Chào mừng bạn đến với cửa hàng của chúng tôi!</p>

    <?php if (!empty($products)): ?>
        <div class="product-list-home">
            <?php foreach ($products as $p): ?>
                <div class="product-card-home">
                    <a href="index.php?act=sanphamct&id=<?= $p['id'] ?>" style="display:block; text-decoration:none; color:inherit;">
                        <?php if (!empty($p['img'])): ?>
                            <img src="Uploads/imgproduct/<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="img-fluid">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/120x120?text=No+Image" alt="No image" class="img-fluid">
                        <?php endif; ?>
                        <div class="name"><?= htmlspecialchars($p['name']) ?></div>
                    </a>
                    <div class="price"><?= number_format($p['price']) ?> đ</div>
                    <?php if (isset($p['is_new']) && $p['is_new']): ?>
                        <span class="new-badge">New</span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-4" role="alert">
            <i class="bi bi-info-circle me-2"></i>Chưa có sản phẩm nào.
        </div>
    <?php endif; ?>
</main>

<?php 
include __DIR__ . '/layout/footer.php';
?>