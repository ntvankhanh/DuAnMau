<?php
require_once __DIR__ . '/../../models/Comment.php';
require_once __DIR__ . '/../../commons/function.php';

class CommentController {
    private $commentModel;
    public function __construct() {
        $conn = connectDB();
        $this->commentModel = new Comment($conn);
    }

    // Hiển thị tất cả bình luận
    public function index() {
        $comments = $this->commentModel->getAllComments();
        include __DIR__ . '/../../views/Admin/comment/index.php';
    }

    // Xóa bình luận
    public function delete($id) {
        $this->commentModel->deleteCommentAdmin($id);
        $_SESSION['success_message'] = 'Xóa bình luận thành công!';
        header('Location: index.php?act=admin-comments');
        exit;
    }
}
