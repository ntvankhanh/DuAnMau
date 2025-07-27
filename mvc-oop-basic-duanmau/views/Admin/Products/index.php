
<?php include __DIR__ . '/../layout/Header.php'; ?>

<style>
    .product-list-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        background: #fff;
    }
    .search-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        gap: 16px;
        flex-wrap: wrap;
    }
    .search-form {
        display: flex;
        gap: 8px;
        flex: 1;
        max-width: 400px;
    }
    .search-form input[type="text"] {
        border-radius: 20px;
        border: 1px solid #ced4da;
        padding: 8px 16px;
        font-size: 15px;
    }
    .search-form button {
        border-radius: 20px;
        padding: 8px 20px;
        font-weight: 500;
    }
    .add-btn {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        color: #fff !important;
        padding: 10px 22px;
        border-radius: 22px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(78,84,200,0.08);
        transition: background 0.2s;
    }
    .add-btn:hover {
        background: linear-gradient(90deg, #8f94fb, #4e54c8);
        color: #fff;
    }
    .table {
        border-radius: 12px;
        overflow: hidden;
        background: #f8f9fa;
        margin-bottom: 0;
    }
    .table th {
        background: #4e54c8;
        color: #fff;
        border: none;
        font-weight: 600;
        text-align: center;
    }
    .table td {
        vertical-align: middle;
        text-align: center;
    }
    .table tbody tr {
        transition: background 0.2s;
    }
    .table tbody tr:hover {
        background: #e9ecef;
    }
    .button.edit {
        background: #00b894;
        color: #fff;
        border: none;
        border-radius: 16px;
        padding: 6px 16px;
        margin-right: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }
    .button.edit:hover {
        background: #019875;
    }
    .button.delete {
        background: #d63031;
        color: #fff;
        border: none;
        border-radius: 16px;
        padding: 6px 16px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }
    .button.delete:hover {
        background: #b71c1c;
    }
    .table img {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    }
</style>

        <!-- Main Content -->

        <div class="content col-md-9 col-lg-10">
            <div class="container-fluid">
                <div class="product-list-card shadow-sm border-0 mt-4 mb-4 p-4">
                    <h2 class="mb-4 text-center" style="font-weight:700; color:#4e54c8;">Danh sách sản phẩm</h2>
                    <div class="search-container">
                        <form method="get" class="search-form" action="index.php">
                            <input type="hidden" name="act" value="products">
                            <input type="text" name="search" placeholder="Tìm kiếm theo tên sản phẩm" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm</button>
                        </form>
                        <a href="index.php?act=product-create-form" class="add-btn">+ Thêm sản phẩm</a>
                    </div>
                    <div style="overflow-x:auto;">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Danh mục</th>
                                <th>Ngày</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; if (!empty($products)) foreach ($products as $p): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($p['name']) ?></td>
                                <td>
                                    <?php if (!empty($p['img'])): ?>
                                        <img src="Uploads/imgproduct/<?= htmlspecialchars($p['img']) ?>" width="60" />
                                    <?php endif; ?>
                                </td>
                                <td><span style="color:#4e54c8;font-weight:600;"><?= number_format($p['price']) ?> đ</span></td>
                                <td><?= htmlspecialchars($p['quantity']) ?></td>
                                <td>
                                  <?= htmlspecialchars($p['category_name'] ?? 'Không có') ?>
                                </td>
                                <td><?= htmlspecialchars($p['date']) ?></td>
                                <td>
                                    <span style="padding:4px 12px;border-radius:12px; font-size:13px; font-weight:500; background:<?= $p['status']==1?'#d1f8e0':'#ffe0e0' ?>; color:<?= $p['status']==1?'#00b894':'#d63031' ?>;">
                                        <?= $p['status'] == 1 ? 'Hiện' : 'Ẩn' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="index.php?act=product-edit-form&id=<?= $p['id'] ?>" class="button edit">Sửa</a>
                                    <a href="index.php?act=product-delete&id=<?= $p['id'] ?>" class="button delete" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


<?php include __DIR__ . '/../layout/footer.php'; ?>