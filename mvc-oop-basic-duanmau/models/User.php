<?php
require_once __DIR__ . '/../commons/function.php';
class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function register($data) {
        $username = $data['username'] ?? '';
        $password = password_hash($data['password'] ?? '', PASSWORD_DEFAULT);
        $email = $data['email'] ?? '';
        $phone = $data['phone'] ?? '';
        $full_name = $data['full_name'] ?? '';
        $role = 'user';
        $avatar = null;
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO users (username, password, email, phone, avatar, full_name, role, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username, $password, $email, $phone, $avatar, $full_name, $role, $created_at]);
    }

       public function findByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
