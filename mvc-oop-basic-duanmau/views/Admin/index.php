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
                <a class="nav-link active" href="index.php?act=category">
                    <i class="fas fa-list"></i> Quản lý danh mục
                </a>
                <a class="nav-link" href="index.php?act=products">
                    <i class="fas fa-box"></i> Quản lý sản phẩm
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="content col-md-9 col-lg-10">
            <div class="container-fluid">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="mb-4">Chào mừng đến với Trang quản trị</h2>
                        <p class="text-muted">Sử dụng menu bên trái để quản lý các danh mục, sản phẩm, người dùng và đơn hàng.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>