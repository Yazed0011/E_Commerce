<?php 
namespace Services;

use Exception;
use Repositories\UserRepository;
use Validation\Auth\SignUp;

class UserService{
    private $repo;

    public function __construct()
    {
        $this->repo= new UserRepository();
    }

    public function SignUp($data){
        $user = $this->repo->getUserByEmail($data);
        if($user){
            throw new Exception("Email Is Already Exits");
        }
        return $this->repo->createUser($data);
    }
}