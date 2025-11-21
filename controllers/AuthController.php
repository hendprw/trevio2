<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userModel->login($_POST['email'], $_POST['password']);
            if ($user) {
                $_SESSION['user'] = $user;
                if($user['role'] == 'admin') header("Location: /admin/dashboard");
                elseif($user['role'] == 'owner') header("Location: /profile");
                else header("Location: /");
            } else {
                echo "<script>alert('Login gagal!'); window.location='/login';</script>";
            }
        } else {
            require __DIR__ . '/../views/auth/login.php';
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Default role user unless specified (simple logic)
            $role = $_POST['role'] ?? 'user'; 
            if($this->userModel->register($_POST['name'], $_POST['email'], $_POST['password'], $role)) {
                header("Location: /login");
            } else {
                echo "Register Failed";
            }
        } else {
            require __DIR__ . '/../views/auth/register.php';
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /login");
    }
}
?>