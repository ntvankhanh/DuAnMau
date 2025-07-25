<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản trị Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f3f5;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #1e293b;
            padding-top: 20px;
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 10px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #2563eb;
            color: white;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .content {
            padding: 30px;
        }
        .navbar-brand {
            color: white !important;
            font-weight: 600;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            margin-bottom: 8px;
            font-weight: 500;
            display: block;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .form-group img {
            max-width: 60px;
            height: auto;
            margin-top: 8px;
        }
        .btn-submit {
            background-color: #2563eb;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #1d4ed8;
        }
        .back-link {
            display: inline-block;
            margin-left: 10px;
            color: #2563eb;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                position: fixed;
                width: 100%;
                z-index: 1000;
            }
            .content {
                margin-top: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar col-md-3 col-lg-2">
            <a href="index.php" class="navbar-brand d-block">Admin Dashboard</a>
            <nav class="nav flex-column">
                <a class="nav-link" href="index.php?act=category">
                    <i class="fas fa-list"></i> Quản lý danh mục
                </a>
                <a class="nav-link active" href="index.php?act=products">
                    <i class="fas fa-box"></i> Quản lý sản phẩm
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="content col-md-9 col-lg-10">
            <div class="container-fluid">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>