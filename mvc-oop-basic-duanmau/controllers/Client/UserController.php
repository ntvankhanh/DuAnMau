<?php
class UserController {
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