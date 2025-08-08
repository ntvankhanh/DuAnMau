<?php
class UserController {
    public function showUpdateForm() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=dangnhap');
            exit;
        }
        $user = $_SESSION['user'];
        include './views/Client/update_user.php';
    }

    public function update($data) {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=dangnhap');
            exit;
        }
        require_once './models/User.php';
        $userModel = new UserModel();
        $id = $_SESSION['user']['id'];
        $errors = [];
        // Validate các trường cần thiết
        if (empty($data['full_name'])) $errors[] = 'Họ tên không được để trống!';
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ!';
        if (!empty($data['phone']) && !preg_match('/^[0-9]{10,11}$/', $data['phone'])) $errors[] = 'Số điện thoại phải từ 10-11 chữ số!';
        // Xử lý upload avatar
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (in_array($_FILES['avatar']['type'], $allowedTypes) && $_FILES['avatar']['size'] <= 2 * 1024 * 1024) {
                $targetDir = 'uploads/avatar/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                $fileName = time() . '_' . basename($_FILES['avatar']['name']);
                $targetFile = $targetDir . $fileName;
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                    $data['avatar'] = $targetFile;
                } else {
                    $errors[] = 'Lỗi tải lên ảnh đại diện!';
                }
            } else {
                $errors[] = 'File ảnh không hợp lệ hoặc quá lớn!';
            }
        }
        if (!empty($errors)) {
            $_SESSION['error_message'] = implode(' ', $errors);
            header('Location: index.php?act=update-user');
            exit;
        }
        // Thực hiện cập nhật
        $userModel->updateUser($id, $data);
        // Cập nhật lại session
        $user = $userModel->findByUsername($_SESSION['user']['username']);
        $_SESSION['user'] = $user;
        $_SESSION['success_message'] = 'Cập nhật thông tin thành công!';
        header('Location: index.php?act=update-user');
        exit;
    }
    public function showRegisterForm() {
        include './views/Client/dangky.php';
    }

    public function showLoginForm() {
        include './views/Client/dangnhap.php';
    }

    public function register($data) {
        require_once './models/User.php';
        $userModel = new UserModel();
        
        // Khởi tạo mảng chứa lỗi
        $errors = [];
        
        // Kiểm tra các trường bắt buộc
        $requiredFields = [
            'username' => 'Tên tài khoản',
            'password' => 'Mật khẩu',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'full_name' => 'Họ và tên'
        ];
        
        foreach ($requiredFields as $field => $label) {
            if (empty($data[$field])) {
                $errors[] = "$label không được để trống!";
            }
        }

        // Kiểm tra định dạng email
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email không đúng định dạng! Vui lòng nhập email hợp lệ.";
        }

        // Kiểm tra định dạng số điện thoại (10-11 chữ số)
        if (!empty($data['phone']) && !preg_match('/^[0-9]{10,11}$/', $data['phone'])) {
            $errors[] = "Số điện thoại phải chứa từ 10 đến 11 chữ số!";
        }

        // Kiểm tra trùng tên tài khoản
        $username = $data['username'] ?? '';
        if ($userModel->findByUsername($username)) {
            $errors[] = 'Tên tài khoản đã được sử dụng!';
        }

        // Kiểm tra trùng email
        if (!empty($data['email']) && $userModel->findByEmail($data['email'])) {
            $errors[] = 'Email này đã được sử dụng!';
        }

        // Kiểm tra trùng số điện thoại
        if (!empty($data['phone']) && $userModel->findByPhone($data['phone'])) {
            $errors[] = 'Số điện thoại này đã được sử dụng!';
        }

        // Nếu có lỗi, lưu thông báo và chuyển hướng
        if (!empty($errors)) {
            $_SESSION['error_message'] = implode( $errors);
            header('Location: index.php?act=dangky');
            exit;
        }

        // Thực hiện đăng ký nếu không có lỗi
        $userModel->register($data);
        $_SESSION['success_message'] = 'Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.';
        header('Location: index.php?act=dangnhap');
        exit;
    }

    public function login($data) {
        require_once './models/User.php';
        $userModel = new UserModel();
        $user = $userModel->findByUsername($data['username'] ?? '');
        if ($user && password_verify($data['password'] ?? '', $user['password'])) {
            $_SESSION['user'] = $user;
            $_SESSION['success_message'] = 'Đăng nhập thành công!';
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['error_message'] = 'Tên tài khoản hoặc mật khẩu không đúng!';
            header('Location: index.php?act=dangnhap');
            exit;
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>