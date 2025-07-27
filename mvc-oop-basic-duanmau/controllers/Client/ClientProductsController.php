<?php
require_once './models/ProductModel.php';


class ClientProductsController {
    public function index() {
        $productModel = new ProductModel();
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $products = $productModel->getALlProduct($search);
        include './views/Client/sanpham.php';
    }

        public function search() {
        $search = isset($_GET['search']) ? urlencode(trim($_GET['search'])) : '';
        header('Location: index.php?act=sanpham&search=' . $search);
        exit;
    }
}
