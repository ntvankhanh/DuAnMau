<?php 
// Include header
include __DIR__ . '/layout/Header.php';
?>

<main class="container my-5">
    <div class="bg-light rounded-3 shadow-sm p-4 mb-5">
        <?php if (!empty($product)): ?>
            <div class="row g-4">
                <!-- Product Image -->
                <div class="col-lg-5 col-md-6">
                    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                        <?php if (!empty($product['img'])): ?>
                            <img src="Uploads/imgproduct/<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid rounded-3" style="max-height: 400px; object-fit: cover; width: 100%;">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/400x400?text=No+Image" alt="No image" class="img-fluid rounded-3" style="max-height: 400px; object-fit: cover; width: 100%;">
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Product Details -->
                <div class="col-lg-7 col-md-6">
                    <div class="card border-0 shadow-lg rounded-3 p-4 h-100">
                        <h1 class="fs-2 fw-bold text-dark mb-3"><?= htmlspecialchars($product['name']) ?></h1>
                        <p class="text-muted mb-2"><i class="bi bi-tag me-2"></i>Danh mục: <strong><?= htmlspecialchars($product['category_name'] ?? 'Không có') ?></strong></p>
                        <p class="fs-3 text-primary fw-bold mb-3"><i class="bi bi-cash me-2"></i>Giá: <?= number_format($product['price']) ?> đ</p>
                        <p class="text-muted mb-4"><i class="bi bi-box-seam me-2"></i>Số lượng: <strong><?= htmlspecialchars($product['quantity']) ?></strong></p>
                        <div class="d-flex gap-3">
                            <a href="index.php?act=sanpham" class="btn btn-outline-secondary rounded-pill px-4"><i class="bi bi-arrow-left me-2"></i>Quay lại danh sách</a>
                            <button class="btn btn-primary rounded-pill px-4"><i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning d-flex align-items-center rounded-3" role="alert">
                <i class="bi bi-exclamation-circle-fill me-3 fs-4"></i>
                <span>Không tìm thấy thông tin sản phẩm.</span>
            </div>
        <?php endif; ?>
    </div>

    <!-- Comment Section -->
    <div class="bg-light rounded-3 shadow-sm p-4 mb-5">
        <h4 class="fw-bold text-dark mb-4">Bình luận sản phẩm</h4>
        <?php if (isset($_SESSION['user'])): ?>
            <form method="post" action="index.php?act=add-comment" class="mb-4">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <div class="mb-3">
                    <textarea name="content" class="form-control rounded-3" rows="4" placeholder="Nhập bình luận của bạn..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Gửi bình luận</button>
            </form>
        <?php else: ?>
            <p class="text-muted">Vui lòng <a href="index.php?act=dangnhap" class="text-primary fw-bold text-decoration-none">đăng nhập</a> để bình luận.</p>
        <?php endif; ?>

        <div class="mt-4">
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $c): ?>
                    <div class="border-0 border-bottom mb-3 pb-3">
                        <div class="d-flex align-items-center mb-2">
                            <strong class="text-dark"><?= htmlspecialchars($c['username']) ?></strong>
                            <span class="text-muted small ms-3"><?= $c['created_at'] ?></span>
                        </div>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $c['user_id'] && isset($_GET['edit_comment']) && $_GET['edit_comment'] == $c['id']): ?>
                            <form method="post" action="index.php?act=edit-comment">
                                <input type="hidden" name="comment_id" value="<?= $c['id'] ?>">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <textarea name="content" class="form-control rounded-3 mb-2" rows="3" required><?= htmlspecialchars($c['content']) ?></textarea>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-sm btn-success rounded-pill px-3">Lưu</button>
                                    <a href="index.php?act=sanphamct&id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Hủy</a>
                                </div>
                            </form>
                        <?php else: ?>
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1 me-3">
                                    <p class="mb-2"><?= nl2br(htmlspecialchars($c['content'])) ?></p>
                                </div>
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $c['user_id']): ?>
                                    <div class="d-flex gap-2">
                                        <a href="index.php?act=sanphamct&id=<?= $product['id'] ?>&edit_comment=<?= $c['id'] ?>" class="btn btn-sm btn-outline-warning rounded-pill px-3">Sửa</a>
                                        <a href="index.php?act=delete-comment&comment_id=<?= $c['id'] ?>&product_id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Bạn có chắc muốn xóa bình luận này?')">Xóa</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Chưa có bình luận nào.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Related Products -->
    <?php if (!empty($relatedProducts)): ?>
        <div class="bg-light rounded-3 shadow-sm p-4">
            <h3 class="fw-bold text-dark mb-4 text-center">Sản phẩm liên quan</h3>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php foreach ($relatedProducts as $rel): ?>
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                            <a href="index.php?act=sanphamct&id=<?= $rel['id'] ?>" class="text-decoration-none">
                                <img src="Uploads/imgproduct/<?= htmlspecialchars($rel['img']) ?>" class="card-img-top rounded-top-3" alt="<?= htmlspecialchars($rel['name']) ?>" style="height: 200px; object-fit: cover;">
                            </a>
                            <div class="card-body text-center">
                                <h6 class="card-title mb-2 text-dark fw-bold text-truncate" style="min-height: 48px;">
                                    <a href="index.php?act=sanphamct&id=<?= $rel['id'] ?>" class="text-decoration-none text-dark">
                                        <?= htmlspecialchars($rel['name']) ?>
                                    </a>
                                </h6>
                                <p class="text-primary fw-bold mb-0"><?= number_format($rel['price']) ?> đ</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php
include __DIR__ . '/layout/footer.php';
?>