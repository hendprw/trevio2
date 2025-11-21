<?php
require_once __DIR__ . '/../models/User.php';

class ProfileController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
        if (!isset($_SESSION['user'])) {
            header("Location: /login"); exit;
        }
    }

    public function index() {
        // Ambil data user terbaru dari DB (agar kalau ada update langsung refresh)
        $user_id = $_SESSION['user']['id'];
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Render View
        require __DIR__ . '/../views/dashboard/profile.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['user']['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            // Password logic could go here
            
            $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            
            if ($stmt->execute([$name, $email, $id])) {
                $_SESSION['user']['name'] = $name; // Update session
                $_SESSION['user']['email'] = $email;
                echo "<script>alert('Profile updated!'); window.location='/profile';</script>";
            } else {
                echo "<script>alert('Failed to update.'); window.location='/profile';</script>";
            }
        }
    }
}
?>