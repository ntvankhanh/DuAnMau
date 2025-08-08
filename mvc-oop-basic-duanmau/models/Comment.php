<?php
class Comment {
    // Lấy tất cả bình luận (admin)
    public function getAllComments() {
        $sql = "SELECT c.*, u.username, p.name as product_name FROM comments c JOIN users u ON c.user_id = u.id JOIN products p ON c.product_id = p.id ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Xóa bình luận (admin, không kiểm tra user)
    public function deleteCommentAdmin($id) {
        $sql = "DELETE FROM comments WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getCommentsByProduct($product_id) {
        $sql = "SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.product_id = ? ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetchAll();
    }

    public function addComment($user_id, $product_id, $content) {
        $sql = "INSERT INTO comments (user_id, product_id, content) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$user_id, $product_id, $content]);
    }

    public function updateComment($id, $user_id, $content) {
        $sql = "UPDATE comments SET content = ? WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$content, $id, $user_id]);
    }

    public function deleteComment($id, $user_id) {
        $sql = "DELETE FROM comments WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id, $user_id]);
    }
}
