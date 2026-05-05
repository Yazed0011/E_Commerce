<?php 
namespace Services;
use Repositories\ProductRepository;

class ProductServices{
    private $repo;

    public function __construct()
    {
        $this->repo= new ProductRepository();
    }

    public function Create($data){
        $rows =[
            "name" => strip_tags($data['name']),
            "price" => strip_tags($data['price']),
            "quantity" => (int) $data['quantity'],
            "description" => strip_tags($data['description']),
            "image" => strip_tags($data['image']),
            "category_id" => (int) ['category_id']
        ];
        return $this->repo->createProduct($rows);
    }
}