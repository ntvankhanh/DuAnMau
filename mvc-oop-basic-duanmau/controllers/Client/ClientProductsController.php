<?php
require_once './models/ProductModel.php';


class ClientProductsController
{
    public function index()
    {
        $productModel = new ProductModel();
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $categoryId = isset($_GET['category']) ? intval($_GET['category']) : null;
        if ($categoryId) {
            $products = $productModel->getProductsByCategory($categoryId, 1000); // lấy tất cả sản phẩm của danh mục
        } else {
            $products = $productModel->getAllProduct($search);
        }
        include './views/Client/sanpham.php';
    }

    public function search()
    {
        $search = isset($_GET['search']) ? urlencode(trim($_GET['search'])) : '';
        header('Location: index.php?act=sanpham&search=' . $search);
        exit;
    }

    public function showDetail($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->getProductById($id);
        // Lấy sản phẩm liên quan nếu có $product
        $relatedProducts = [];
        if (!empty($product) && !empty($product['category_id'])) {
            $productModel = new ProductModel();
            $relatedProducts = $productModel->getProductsByCategory($product['category_id'], 4);
            // Loại bỏ sản phẩm hiện tại khỏi danh sách liên quan
            $relatedProducts = array_filter($relatedProducts, function ($p) use ($product) {
                return $p['id'] != $product['id'];
            });
        }
        include './views/Client/product_detail.php';
    }
}
