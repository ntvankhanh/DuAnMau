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
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #2563eb;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }
        .card-body {
            padding: 30px;
        }
        .form-control {
            border-radius: 6px;
            padding: 10px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }
        .btn-primary {
            background-color: #2563eb;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #1e40af;
        }
        .btn-link {
            color: #2563eb;
            text-decoration: none;
        }
        .btn-link:hover {
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
            .form-container {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- menu -->
        <div class="sidebar col-md-3 col-lg-2">
            <a href="index.php" class="navbar-brand d-block">Admin Dashboard</a>
            <nav class="nav flex-column">
                <a class="nav-link active" href="index.php?act=category">
                    <i class="fas fa-list"></i> Quản lý danh mục
                </a>
                <a class="nav-link" href="index.php?act=products">
                    <i class="fas fa-box"></i> Quản lý sản phẩm
                </a>
            </nav>
        </div>

        <!-- Nội dung ở trong -->
        <div class="content col-md-9 col-lg-10">
            <div class="form-container">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Thêm danh mục mới</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php?act=category-store" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Tên danh mục:</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên danh mục" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Lưu
                                </button>
                                <a href="index.php?act=category" class="btn btn-link">Quay lại danh sách</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>