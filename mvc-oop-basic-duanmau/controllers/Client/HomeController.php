<?php
class HomeController {

    public function index() {
        require_once './models/ProductModel.php';
        $productModel = new ProductModel();
        $products = $productModel->getAllProduct();
        include './views/Client/index.php';
    }


}