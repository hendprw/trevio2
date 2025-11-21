<?php
class User {
    private $conn;
    private $table = "users";

    public function __construct($db) { $this->conn = $db; }

    // DENGAN NOMOR HP BARU
    public function register($name, $email, $phone, $password, $role) {
        $query = "INSERT INTO " . $this->table . " (name, email, phone_number, password, role) VALUES (:name, :email, :phone, :password, :role)";
        $stmt = $this->conn->prepare($query);
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":password", $hashed);
        $stmt->bindParam(":role", $role);
        return $stmt->execute();
    }

    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // BARU: Ambil data user berdasarkan ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT id, name, email, phone_number, role FROM " . $this->table . " WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>