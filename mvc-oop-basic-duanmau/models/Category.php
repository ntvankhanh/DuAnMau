<?php
require_once __DIR__ . '/../commons/function.php';

class Category {
    public $id;
    public $name;
    private $conn;

    // Truyền kết nối PDO từ ngoài vào
    public function __construct($conn, $id = null, $name = null) {
        $this->conn = $conn;
        $this->id = $id;
        $this->name = $name;
    }

    // Lấy tất cả danh mục
    public function all() {
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    // Lấy 1 danh mục theo id
    public function find($id) {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Thêm mới danh mục
    public function create($name) {
        $sql = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name]);
    }

    // Cập nhật danh mục
    public function update($id, $name) {
        $sql = "UPDATE categories SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $id]);
    }

    // Xóa danh mục
    public function delete($id) {
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
