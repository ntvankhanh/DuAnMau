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
        .add-btn {
            background-color: #2563eb;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }
        .add-btn:hover {
            background-color: #1d4ed8;
            color: white;
        }
        .button {
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 5px;
        }
        .button.edit {
            background-color: #2563eb;
            color: white;
        }
        .button.delete {
            background-color: #dc3545;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        img {
            max-width: 60px;
            height: auto;
        }
        /* Cải tiến giao diện form tìm kiếm và nút thêm sản phẩm */
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .search-form {
            position: relative;
            max-width: 400px;
            flex-grow: 1;
        }
        .search-form .form-control {
            border-radius: 50px;
            padding: 10px 20px;
            border: 1px solid #ced4da;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }
        .search-form .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.25);
        }
        .search-form .btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 50px;
            padding: 8px 15px;
            background-color: #2563eb;
            border: none;
        }
        .search-form .btn:hover {
            background-color: #1d4ed8;
        }
        .search-form .fa-search {
            margin-right: 5px;
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
            .search-form {
                max-width: 100%;
            }
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }
            .add-btn {
                width: fit-content;
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
                        <h2 class="mb-4 text-center">Danh sách sản phẩm</h2>
                        <div class="search-container">
                            <form method="get" class="search-form" action="index.php">
                                <input type="hidden" name="act" value="products">
                                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm</button>
                            </form>
                            <a href="index.php?act=product-create-form" class="add-btn">Thêm sản phẩm</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Ảnh</th>
                                    <th>Giá</th>
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
                                    <td><?= number_format($p['price']) ?> đ</td>
                                    <td>
                                      <?= htmlspecialchars($p['category_name'] ?? 'Không có') ?>
                                    </td>
                                    <td><?= htmlspecialchars($p['date']) ?></td>
                                    <td><?= $p['status'] == 1 ? 'Hiện' : 'Ẩn' ?></td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>