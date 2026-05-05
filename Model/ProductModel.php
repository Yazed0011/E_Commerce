<?php 
namespace Model;
class ProductModel {
    private int $id;
    private string $name;
    private float $price;
    private int $quantity;
    private string $description;
    private string $image;
    private int $category_id;
    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->quantity = $data['quantity'];
        $this->description = $data['description'];
        $this->image = $data['image'];
        $this->category_id = $data['category_id'];
    }
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'image' => $this->image,
            'category_id' => $this->category_id,
        ];
    }
}