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

        // Lấy bình luận sản phẩm
        require_once './models/Comment.php';
        $conn = connectDB();
        $commentModel = new Comment($conn);
        $comments = $commentModel->getCommentsByProduct($id);

        // Lấy sản phẩm liên quan nếu có $product
        $relatedProducts = [];
        if (!empty($product) && !empty($product['category_id'])) {
            $relatedProducts = $productModel->getProductsByCategory($product['category_id'], 4);
            $relatedProducts = array_filter($relatedProducts, function ($p) use ($product) {
                return $p['id'] != $product['id'];
            });
        }
        include './views/Client/product_detail.php';
    }

    public function addComment()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error_message'] = 'Vui lòng đăng nhập để bình luận!';
            header('Location: index.php?act=dangnhap');
            exit;
        }
        
        // Validate input
        if (!isset($_POST['product_id']) || !is_numeric($_POST['product_id'])) {
            $_SESSION['error_message'] = 'Sản phẩm không hợp lệ!';
            header('Location: index.php?act=sanpham');
            exit;
        }
        
        $user_id = $_SESSION['user']['id'];
        $product_id = intval($_POST['product_id']);
        $content = isset($_POST['content']) ? trim($_POST['content']) : '';
        
        // Validate content
        if (empty($content)) {
            $_SESSION['error_message'] = 'Nội dung bình luận không được để trống!';
            header('Location: index.php?act=sanphamct&id=' . $product_id);
            exit;
        }
        
        if (strlen($content) < 5) {
            $_SESSION['error_message'] = 'Nội dung bình luận phải có ít nhất 5 ký tự!';
            header('Location: index.php?act=sanphamct&id=' . $product_id);
            exit;
        }
        
        if (strlen($content) > 1000) {
            $_SESSION['error_message'] = 'Nội dung bình luận không được vượt quá 1000 ký tự!';
            header('Location: index.php?act=sanphamct&id=' . $product_id);
            exit;
        }
        
        try {
            require_once './models/Comment.php';
            $conn = connectDB();
            $commentModel = new Comment($conn);
            $commentModel->addComment($user_id, $product_id, $content);
            $_SESSION['success_message'] = 'Thêm bình luận thành công!';
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Có lỗi xảy ra khi thêm bình luận!';
        }
        
        header('Location: index.php?act=sanphamct&id=' . $product_id);
        exit;
    }

     public function editComment()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error_message'] = 'Vui lòng đăng nhập để sửa bình luận!';
            header('Location: index.php?act=dangnhap');
            exit;
        }
        
        // Validate input
        if (!isset($_POST['comment_id']) || !is_numeric($_POST['comment_id'])) {
            $_SESSION['error_message'] = 'Bình luận không hợp lệ!';
            header('Location: index.php?act=sanpham');
            exit;
        }
        
        if (!isset($_POST['product_id']) || !is_numeric($_POST['product_id'])) {
            $_SESSION['error_message'] = 'Sản phẩm không hợp lệ!';
            header('Location: index.php?act=sanpham');
            exit;
        }
        
        $user_id = $_SESSION['user']['id'];
        $comment_id = intval($_POST['comment_id']);
        $product_id = intval($_POST['product_id']);
        $content = isset($_POST['content']) ? trim($_POST['content']) : '';
        
        // Validate content
        if (empty($content)) {
            $_SESSION['error_message'] = 'Nội dung bình luận không được để trống!';
            header('Location: index.php?act=sanphamct&id=' . $product_id);
            exit;
        }
        
        if (strlen($content) < 5) {
            $_SESSION['error_message'] = 'Nội dung bình luận phải có ít nhất 5 ký tự!';
            header('Location: index.php?act=sanphamct&id=' . $product_id);
            exit;
        }
        
        if (strlen($content) > 1000) {
            $_SESSION['error_message'] = 'Nội dung bình luận không được vượt quá 1000 ký tự!';
            header('Location: index.php?act=sanphamct&id=' . $product_id);
            exit;
        }
        
        try {
            require_once './models/Comment.php';
            $conn = connectDB();
            $commentModel = new Comment($conn);
            $result = $commentModel->updateComment($comment_id, $user_id, $content);
            
            if ($result) {
                $_SESSION['success_message'] = 'Cập nhật bình luận thành công!';
            } else {
                $_SESSION['error_message'] = 'Không thể cập nhật bình luận! Bạn chỉ có thể sửa bình luận của chính mình.';
            }
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Có lỗi xảy ra khi cập nhật bình luận!';
        }
        
        header('Location: index.php?act=sanphamct&id=' . $product_id);
        exit;
    }

    public function deleteComment()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error_message'] = 'Vui lòng đăng nhập để xóa bình luận!';
            header('Location: index.php?act=dangnhap');
            exit;
        }
        
        // Validate input
        if (!isset($_GET['comment_id']) || !is_numeric($_GET['comment_id'])) {
            $_SESSION['error_message'] = 'Bình luận không hợp lệ!';
            header('Location: index.php?act=sanpham');
            exit;
        }
        
        if (!isset($_GET['product_id']) || !is_numeric($_GET['product_id'])) {
            $_SESSION['error_message'] = 'Sản phẩm không hợp lệ!';
            header('Location: index.php?act=sanpham');
            exit;
        }
        
        $user_id = $_SESSION['user']['id'];
        $comment_id = intval($_GET['comment_id']);
        $product_id = intval($_GET['product_id']);
        
        try {
            require_once './models/Comment.php';
            $conn = connectDB();
            $commentModel = new Comment($conn);
            $result = $commentModel->deleteComment($comment_id, $user_id);
            
            if ($result) {
                $_SESSION['success_message'] = 'Xóa bình luận thành công!';
            } else {
                $_SESSION['error_message'] = 'Không thể xóa bình luận! Bạn chỉ có thể xóa bình luận của chính mình.';
            }
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Có lỗi xảy ra khi xóa bình luận!';
        }
        
        header('Location: index.php?act=sanphamct&id=' . $product_id);
        exit;
    }

}
