<?php 
namespace Services;

use Exception;
use Repositories\UserRepository;

class UserService{
    private $repo;

    public function __construct()
    {
        $this->repo= new UserRepository();
    }

    public function signup($data){

        $rows=[
            "name" => strip_tags($data['name']),
            "email" =>  strip_tags($data['email']),
            "admin" => (int) $data['admin'] ??  0,
            "password" =>  password_hash($data['password'] , PASSWORD_DEFAULT)
        ];

        $user = $this->repo->getUserByEmail($rows['email']);
        if($user){
            throw new Exception("Email already exists");
        }
        return $this->repo->createUser($rows);
    }
}