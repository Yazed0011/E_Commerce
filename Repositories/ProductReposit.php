<?php 
namespace Repositories;

use Database\DB;
use Model\ProductModel;
use PDO;
class ProductRepository {
    private $conn;
    public function __construct() {
        $this->conn = DB::getInstance()->getConnection();
    }
    public function createProduct(array $data) {
        $sql = "INSERT INTO products (name, price, quantity, description, image, category_id) VALUES (:name, :price, :quantity, :description, :image, :category_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':quantity', $data['quantity']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->execute();
        $id = (int) $this->conn->lastInsertId();
        return $this->getProductById($id);
    }
    public function getProductById(int $id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new ProductModel($row) : null;
    }
    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn(array $row) => new ProductModel($row) , $rows);
    }
    public function updateProduct(int $id, array $data) {
        $sql = "UPDATE products SET name = :name, price = :price, quantity = :quantity, description = :description, image = :image, category_id = :category_id WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id" , $id , PDO::PARAM_INT);
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $data['quantity'], PDO::PARAM_INT);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':image', $data['image'], PDO::PARAM_INT);
        $stmt->execute();
    }
    public function deleteProduct(int $id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function getProductsByCategoryId(int $category_id) {
        $sql = "SELECT * FROM products WHERE category_id = :category_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn(array $row) => new ProductModel($row) , $rows);
    }
    public function getProductsByPrice(float $price) {
        $sql = "SELECT * FROM products WHERE price = :price";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn(array $row) => new ProductModel($row) , $rows);
    }
    public function getProductsByQuantity(int $quantity) {
        $sql = "SELECT * FROM products WHERE quantity = :quantity";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn(array $row) => new ProductModel($row) , $rows);
    }
    public function getProductsByDescription(string $description) {
        $sql = "SELECT * FROM products WHERE description = :description";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn(array $row) => new ProductModel($row) , $rows);
    }
    public function getProductsByName(string $name) {
        $sql = "SELECT * FROM products WHERE name = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn(array $row) => new ProductModel($row) , $rows);
    }
}