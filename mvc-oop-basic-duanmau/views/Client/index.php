
<?php 
// include header
include __DIR__ . '/layout/Header.php';
?>

<style>
    .product-list-home {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
        margin-top: 32px;
    }
    .product-card-home {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        padding: 18px 14px 16px 14px;
        text-align: center;
        transition: box-shadow 0.2s, transform 0.2s;
        border: 1px solid #f0f0f0;
    }
    .product-card-home:hover {
        box-shadow: 0 4px 24px rgba(78,84,200,0.12);
        transform: translateY(-4px) scale(1.02);
    }
    .product-card-home img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 10px;
        border: 1px solid #e0e0e0;
        background: #fafbff;
    }
    .product-card-home .name {
        font-size: 17px;
        font-weight: 600;
        color: #4e54c8;
        margin-bottom: 6px;
        min-height: 40px;
    }
    .product-card-home .price {
        color: #00b894;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 4px;
    }
    .product-card-home .status {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 500;
        background: #f0f0f0;
        color: #888;
        margin-bottom: 4px;
    }
    .product-card-home .status.hien {
        background: #d1f8e0;
        color: #00b894;
    }
    .product-card-home .status.an {
        background: #ffe0e0;
        color: #d63031;
    }
</style>

<main class="container my-5">
    <h1 class="mb-4">Trang chủ</h1>
    <p>Chào mừng bạn đến với trang chủ của chúng tôi!</p>

    <?php if (!empty($products)): ?>
        <div class="product-list-home">
            <?php foreach ($products as $p): ?>
                <div class="product-card-home">
                    <?php if (!empty($p['img'])): ?>
                        <img src="Uploads/imgproduct/<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/100x100?text=No+Image" alt="No image">
                    <?php endif; ?>
                    <div class="name"><?= htmlspecialchars($p['name']) ?></div>
                    <div class="price"><?= number_format($p['price']) ?> đ</div>
                    <div class="status <?= $p['status']==1?'hien':'an' ?>">
                        <?= $p['status']==1 ? 'Hiện' : 'Ẩn' ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-4">Chưa có sản phẩm nào.</div>
    <?php endif; ?>
</main>

<?php 
include __DIR__ . '/layout/footer.php';
?>