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
        $user = $this->repo->getUserByEmail($data['email']);
        if($user){
            throw new Exception("Email already exists");
        }
        return $this->repo->createUser($data);
    }
}