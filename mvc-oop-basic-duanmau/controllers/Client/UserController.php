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
        $userModel->register($data);
        header('Location: index.php?act=dangnhap');
        exit;
    }

    public function login($data) {
        require_once './models/User.php';
        $userModel = new UserModel();
        $user = $userModel->findByUsername($data['username'] ?? '');
        if ($user && password_verify($data['password'] ?? '', $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['login_error'] = 'Tên đăng nhập hoặc mật khẩu không đúng!';
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