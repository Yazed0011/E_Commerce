<?php
namespace Repositories;

use Database\DB;
use PDO;
use Model\UserModel;

class UserRepository {
    private $conn;

    public function __construct() {
        $this->conn = DB::getInstance()->getConnection();
    }

    public function createUser(array $data) {
        $sql = "INSERT INTO users (name, email, password, admin) VALUES (:name, :email, :password, :admin)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':admin', $data['admin']);
        $stmt->execute();
        $id = (int) $this->conn->lastInsertId();
        return $this->getUserById($id);
    }

    public function getUserByEmail(string $email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new UserModel($row) : null;
    }

    public function getUserById(int $id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new UserModel($row) : null;
    }

    public function updateUser(int $id, array $data) {
        $sql = "UPDATE users SET name = :name, email = :email, password = :password, admin = :admin WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':admin', $data['admin'], PDO::PARAM_BOOL);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteUser(int $id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getAllUsers() {
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new UserModel($row), $rows);
    }

    public function getUserByAdmin(bool $admin) {
        $sql = "SELECT * FROM users WHERE admin = :admin";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':admin', $admin, PDO::PARAM_BOOL);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new UserModel($row), $rows);
    }
}
