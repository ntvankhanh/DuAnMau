<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...
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

// Hàm kiểm tra quyền admin
function checkAdminAccess() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        // Nếu không phải admin, chuyển hướng về trang chủ hoặc trang đăng nhập
        header('Location: /');
        exit();
    }
}

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
    // Trang client
    '/' => (new HomeController())->index(),
    'gioithieu' => include './views/Client/gioithieu.php',
    'search' => (new ClientProductsController())->search(),
    'sanpham' => (new ClientProductsController())->index(),
    'sanphamct' => (new ClientProductsController())->showDetail($_GET['id'] ?? 0),
    'dangnhap' => (new UserController())->showLoginForm(),
    'dangky' => (new UserController())->showRegisterForm(),
    'register' => (new UserController())->register($_POST),
    'login' => (new UserController())->login($_POST),
    'logout' => (new UserController())->logout(),

    // Trang admin - Kiểm tra quyền admin trước khi thực thi
    'admin' => (function() {
        checkAdminAccess();
        return (new AdminController())->index();
    })(),
    'products' => (function() {
        checkAdminAccess();
        return (new ProductController())->Home();
    })(),
    'product-create-form' => (function() {
        checkAdminAccess();
        return (new ProductController())->createForm();
    })(),
    'product-store' => (function() {
        checkAdminAccess();
        return (new ProductController())->store($_POST);
    })(),
    'product-edit-form' => (function() {
        checkAdminAccess();
        return (new ProductController())->editForm($_GET['id'] ?? 0);
    })(),
    'product-update' => (function() {
        checkAdminAccess();
        return (new ProductController())->update($_POST['id'] ?? 0, $_POST);
    })(),
    'product-delete' => (function() {
        checkAdminAccess();
        return (new ProductController())->delete($_GET['id'] ?? 0);
    })(),
    'category' => (function() {
        checkAdminAccess();
        return (new CategoryController())->index();
    })(),
    'category-create-form' => (function() {
        checkAdminAccess();
        return (new CategoryController())->createForm();
    })(),
    'category-store' => (function() {
        checkAdminAccess();
        return (new CategoryController())->store($_POST['name'] ?? '');
    })(),
    'category-edit-form' => (function() {
        checkAdminAccess();
        return (new CategoryController())->editForm($_GET['id'] ?? 0);
    })(),
    'category-update' => (function() {
        checkAdminAccess();
        return (new CategoryController())->update($_POST['id'] ?? 0, $_POST['name'] ?? '');
    })(),
    'category-delete' => (function() {
        checkAdminAccess();
        return (new CategoryController())->delete($_GET['id'] ?? 0);
    })(),
};
?>