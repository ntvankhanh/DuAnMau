<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)
session_start(); // Bắt đầu phiên làm việc
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/Admin/ProductController.php';
require_once './controllers/Admin/CategoryController.php';
require_once './controllers/Admin/AdminController.php';

// Require file Controller Client
require_once './controllers/Client/HomeController.php';
require_once './controllers/Client/UserController.php';
require_once './controllers/Client/ClientProductsController.php';


// Require toàn bộ file Models
require_once './models/ProductModel.php';

// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match


match ($act) {
    // Trang client
    '/' => (new HomeController())->index(),
    'gioithieu' => include './views/Client/gioithieu.php',
    // Xử lý tìm kiếm: chuyển hướng sang trang sản phẩm
    'search' => (new ClientProductsController())->search(),
    'sanpham' =>(new ClientProductsController())->index(),
    'dangnhap' => (new UserController())->showLoginForm(),
    'dangky' => (new UserController())->showRegisterForm(),
    'register' => (new UserController())->register($_POST),
    'login' => (new UserController())->login($_POST),
    'logout' => (new UserController())->logout(),








    // Trang admin

    // Trang index admin
    'admin' => (new AdminController())->index(),

    // Sản phẩm: Hiển thị danh sách
    'products' => (new ProductController())->Home(),

    // Sản phẩm: Hiển thị form thêm mới
    'product-create-form' => (new ProductController())->createForm(),

    // Sản phẩm: Xử lý thêm mới
    'product-store' => (new ProductController())->store($_POST),

    // Sản phẩm: Hiển thị form sửa
    'product-edit-form' => (new ProductController())->editForm($_GET['id'] ?? 0),

    // Sản phẩm: Xử lý cập nhật
    'product-update' => (new ProductController())->update($_POST['id'] ?? 0, $_POST),

    // Sản phẩm: Xóa
    'product-delete' => (new ProductController())->delete($_GET['id'] ?? 0),

    // Hiển thị danh sách danh mục
    'category' => (new CategoryController())->index(),

    // Hiển thị form thêm mới danh mục
    'category-create-form' => (new CategoryController())->createForm(),

    // Xử lý thêm mới danh mục
    'category-store' => (new CategoryController())->store($_POST['name'] ?? ''),

    // Hiển thị form sửa danh mục
    'category-edit-form' => (new CategoryController())->editForm($_GET['id'] ?? 0),

    // Xử lý cập nhật danh mục
    'category-update' => (new CategoryController())->update($_POST['id'] ?? 0, $_POST['name'] ?? ''),

    // Xóa danh mục
    'category-delete' => (new CategoryController())->delete($_GET['id'] ?? 0),
};