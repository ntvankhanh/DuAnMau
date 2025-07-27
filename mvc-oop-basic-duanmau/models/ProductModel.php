<?php
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class ProductModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }


    
    // Lấy sản phẩm theo id danh mục, chỉ lấy sản phẩm status = 1
    public function getProductsByCategory($categoryId, $limit = 8)
    {
        $sql = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.status = 1 AND p.category_id = :category_id ORDER BY p.category_id ASC LIMIT $limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy tất cả sản phẩm, có thể tìm kiếm theo tên, không giới hạn số lượng
    public function getProducts($search = '')
    {
        $sql = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.status = 1";
        if (!empty($search)) {
            $sql .= " AND (p.name LIKE :search OR c.name LIKE :search)";
        }
        $sql .= " ORDER BY p.category_id ASC LIMIT 8";
        $stmt = $this->conn->prepare($sql);
        if (!empty($search)) {
            $searchParam = '%' . $search . '%';
            $stmt->bindParam(':search', $searchParam);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy tất cả sản phẩm, có thể tìm kiếm theo tên
    public function getAllProduct($search = '')
    {
        $sql = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id";
        if (!empty($search)) {
            $sql .= " WHERE p.name LIKE :search";
        }
        $sql .= " ORDER BY p.category_id ASC";
        $stmt = $this->conn->prepare($sql);
        if (!empty($search)) {
            $searchParam = '%' . $search . '%';
            $stmt->bindParam(':search', $searchParam);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy 1 sản phẩm theo id (kèm tên danh mục)
    public function getProductById($id)
    {
        $sql = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Thêm sản phẩm mới
    public function createProduct($data)
    {
        $sql = "INSERT INTO products (name, img, price, quantity, category_id, date, status) VALUES (:name, :img, :price, :quantity, :category_id, :date, :status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':img', $data['img']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':quantity', $data['quantity']);
        $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':date', $data['date']);
        $stmt->bindParam(':status', $data['status']);
        return $stmt->execute();
    }

    // Cập nhật sản phẩm
    public function updateProduct($id, $data)
    {
        $sql = "UPDATE products SET name = :name, img = :img, price = :price, quantity = :quantity, category_id = :category_id, date = :date, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':img', $data['img']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':quantity', $data['quantity']);
        $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':date', $data['date']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
