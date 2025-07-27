<?php 
// Include header
include __DIR__ . '/layout/Header.php';
?>

<main class="container my-5">
    <?php if (!empty($product)): ?>
        <div class="row g-4">
            <div class="col-md-5">
                <div class="card border-light shadow-sm text-center">
                    <?php if (!empty($product['img'])): ?>
                        <img src="Uploads/imgproduct/<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="card-img-top img-fluid rounded" style="max-height: 320px; object-fit: cover;">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/320x320?text=No+Image" alt="No image" class="card-img-top img-fluid rounded" style="max-height: 320px; object-fit: cover;">
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card border-light shadow-sm p-4">
                    <h1 class="card-title fw-bold text-primary mb-3"><?= htmlspecialchars($product['name']) ?></h1>
                    <p class="card-text text-muted mb-2">Danh mục: <strong><?= htmlspecialchars($product['category_name'] ?? 'Không có') ?></strong></p>
                    <p class="card-text fs-3 text-success fw-bold mb-3">Giá: <?= number_format($product['price']) ?> đ</p>
                    <p class="card-text mb-3">Số lượng: <strong><?= htmlspecialchars($product['quantity']) ?></strong></p>
                    <div class="d-flex gap-2">
                        <a href="index.php?act=sanpham" class="btn btn-outline-primary"><i class="bi bi-arrow-left me-2"></i>Quay lại danh sách</a>
                        <button class="btn btn-primary"><i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-4 d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-circle me-2 fs-5"></i>
            <span>Không tìm thấy thông tin sản phẩm.</span>
        </div>
    <?php endif; ?>

    <?php if (!empty($relatedProducts)): ?>
        <hr class="my-5">
        <h3 class="mb-4 text-center text-secondary">Sản phẩm liên quan</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
            <?php foreach ($relatedProducts as $rel): ?>
                <div class="col">
                    <div class="card h-100 border-light shadow-sm transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                        <a href="index.php?act=sanphamct&id=<?= $rel['id'] ?>" class="text-decoration-none">
                            <img src="Uploads/imgproduct/<?= htmlspecialchars($rel['img']) ?>" class="card-img-top" alt="<?= htmlspecialchars($rel['name']) ?>" style="height: 180px; object-fit: cover;">
                        </a>
                        <div class="card-body text-center">
                            <h6 class="card-title mb-2 text-primary text-truncate" style="min-height: 40px;">
                                <a href="index.php?act=sanphamct&id=<?= $rel['id'] ?>" class="text-decoration-none text-primary">
                                    <?= htmlspecialchars($rel['name']) ?>
                                </a>
                            </h6>
                            <p class="card-text text-success fw-bold mb-0"><?= number_format($rel['price']) ?> đ</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php 
include __DIR__ . '/layout/footer.php';
?>