<?php
require_once __DIR__ . '/../commons/function.php';
class UserModel {
    public function updateUser($id, $data) {
        $fields = [];
        $params = [];
        if (!empty($data['full_name'])) {
            $fields[] = 'full_name = ?';
            $params[] = $data['full_name'];
        }
        if (!empty($data['email'])) {
            $fields[] = 'email = ?';
            $params[] = $data['email'];
        }
        if (!empty($data['phone'])) {
            $fields[] = 'phone = ?';
            $params[] = $data['phone'];
        }
        if (!empty($data['avatar'])) {
            $fields[] = 'avatar = ?';
            $params[] = $data['avatar'];
        }
        if (!empty($data['password'])) {
            $fields[] = 'password = ?';
            $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        if (empty($fields)) return false;
        $params[] = $id;
        $sql = "UPDATE users SET ".implode(', ', $fields)." WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }
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
    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByPhone($phone) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->execute([$phone]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
