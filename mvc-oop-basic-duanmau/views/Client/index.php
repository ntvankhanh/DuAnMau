<?php 
// Include header
include __DIR__ . '/layout/Header.php';
?>

<main class="container my-5">
    <!-- Slideshow Section -->
    <section class="mb-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner rounded-3">
                <div class="carousel-item active">
                    <img src="https://png.pngtree.com/background/20230410/original/pngtree-dessert-delicious-ice-cream-cake-background-picture-image_2384529.jpg" class="d-block w-100" alt="Banner 1" style="height: 700px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="https://png.pngtree.com/thumb_back/fh260/background/20230408/pngtree-cake-cut-coffee-illustration-background-image_2150869.jpg" class="d-block w-100" alt="Banner 2" style="height: 700px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="https://png.pngtree.com/thumb_back/fh260/background/20230408/pngtree-dessert-cheese-cake-illustration-background-image_2206266.jpg" class="d-block w-100" alt="Banner 3" style="height: 700px; object-fit: cover;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Original Content -->
    <h1 class="display-5 fw-bold mb-3">Trang chủ</h1>
    <p class="lead text-muted mb-4">Chào mừng bạn đến với cửa hàng của chúng tôi!</p>

    <?php
    require_once './models/ProductModel.php';
    $productModel = new ProductModel();
    // Lấy tất cả danh mục
    $categories = $productModel->conn->query("SELECT * FROM categories")->fetchAll();
    ?>

    <section id="products">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $cat): ?>
                <?php $catProducts = $productModel->getProductsByCategory($cat['id'], 8); ?>
                <?php if (!empty($catProducts)): ?>
                    <h2 class="mt-5 mb-3 fs-3 text-primary"><?= htmlspecialchars($cat['name']) ?></h2>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                        <?php foreach ($catProducts as $p): ?>
                            <div class="col">
                                <div class="card h-100 border-light shadow-sm transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                                    <a href="index.php?act=sanphamct&id=<?= $p['id'] ?>" class="d-block">
                                        <?php if (!empty($p['img'])): ?>
                                            <img src="Uploads/imgproduct/<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="card-img-top img-fluid p-3" style="height: 200px; object-fit: cover;">
                                        <?php else: ?>
                                            <img src="https://via.placeholder.com/120x120?text=No+Image" alt="No image" class="card-img-top img-fluid p-3" style="height: 200px; object-fit: cover;">
                                        <?php endif; ?>
                                    </a>
                                    <div class="card-body text-center">
                                        <h5 class="card-title fw-semibold text-dark text-truncate" style="min-height: 48px;">
                                            <a href="index.php?act=sanphamct&id=<?= $p['id'] ?>" class="text-decoration-none text-dark">
                                                <?= htmlspecialchars($p['name']) ?>
                                            </a>
                                        </h5>
                                        <p class="card-text text-success fw-bold fs-5"><?= number_format($p['price']) ?> đ</p>
                                        <?php if (isset($p['is_new']) && $p['is_new']): ?>
                                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">New</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info mt-4" role="alert">
                <i class="bi bi-info-circle me-2"></i>Chưa có sản phẩm nào.
            </div>
        <?php endif; ?>
    </section>
</main>

<?php 
include __DIR__ . '/layout/footer.php';
?>