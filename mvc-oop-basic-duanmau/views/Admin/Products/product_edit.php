
<?php include __DIR__ . '/../layout/Header.php'; ?>

<style>
    .product-form-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        background: #fff;
        margin-top: 32px;
        margin-bottom: 32px;
    }
    .product-form-card h2 {
        color: #4e54c8;
        font-weight: 700;
    }
    .product-form-card form {
        max-width: 500px;
        margin: 0 auto;
    }
    .form-group {
        margin-bottom: 18px;
    }
    .form-group label {
        font-weight: 500;
        margin-bottom: 6px;
        display: block;
        color: #333;
    }
    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="date"],
    .form-group input[type="file"],
    .form-group select {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #ced4da;
        padding: 8px 14px;
        font-size: 15px;
        background: #f8f9fa;
        transition: border 0.2s;
    }
    .form-group input[type="file"] {
        padding: 6px 0;
        background: none;
    }
    .form-group img {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        margin-top: 4px;
    }
    .btn-submit {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        color: #fff;
        border: none;
        border-radius: 22px;
        padding: 10px 32px;
        font-weight: 600;
        font-size: 16px;
        margin-right: 12px;
        box-shadow: 0 2px 8px rgba(78,84,200,0.08);
        transition: background 0.2s;
    }
    .btn-submit:hover {
        background: linear-gradient(90deg, #8f94fb, #4e54c8);
        color: #fff;
    }
    .back-link {
        color: #4e54c8;
        font-weight: 500;
        text-decoration: none;
        border-radius: 16px;
        padding: 8px 18px;
        transition: background 0.2s, color 0.2s;
    }
    .back-link:hover {
        background: #f0f0ff;
        color: #222;
        text-decoration: none;
    }
</style>

        <!-- Main Content -->

        <div class="content col-md-9 col-lg-10">
            <div class="container-fluid">
                <div class="product-form-card shadow-sm border-0 p-4">
                    <h2 class="mb-4 text-center">Sửa sản phẩm</h2>
                    <form action="index.php?act=product-update" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm:</label>
                            <input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Ảnh hiện tại:</label>
                            <?php if (!empty($product['img'])): ?>
                                <img src="Uploads/imgproduct/<?= htmlspecialchars($product['img']) ?>" width="60" />
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="img">Đổi ảnh:</label>
                            <input type="file" name="img" id="img">
                        </div>
                        <div class="form-group">
                            <label for="price">Giá:</label>
                            <input type="number" name="price" id="price" value="<?= htmlspecialchars($product['price']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Danh mục:</label>
                            <select name="category_id" id="category_id" required>
                                <option value="">-- Chọn danh mục --</option>
                                <?php if (!empty($categories)) foreach ($categories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat['id']) ?>" <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Ngày:</label>
                            <input type="date" name="date" id="date" value="<?= htmlspecialchars(date('Y-m-d', strtotime($product['date']))) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng thái:</label>
                            <select name="status" id="status">
                                <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Hiện</option>
                                <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-submit">Cập nhật</button>
                        <a href="index.php?act=products" class="back-link">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>

    </div>


<?php include __DIR__ . '/../layout/footer.php'; ?>