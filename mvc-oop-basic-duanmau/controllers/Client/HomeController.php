<?php
class HomeController {

    public function index() {
        // Nếu có tìm kiếm thì chuyển hướng sang trang sản phẩm
        if (isset($_GET['search']) && trim($_GET['search']) !== '') {
            $search = urlencode(trim($_GET['search']));
            header('Location: index.php?act=sanpham&search=' . $search);
            exit;
        }
        require_once './models/ProductModel.php';
        $productModel = new ProductModel();
        $products = $productModel->getProducts();
        include './views/Client/index.php';
    }


}