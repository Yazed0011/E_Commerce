<?php 
namespace Controller;
use Services\UserService;
use Core\Requset;
use Validation\Auth\SignUp;

class UserController{
    private $services;
    public function __construct()
    {
        $this->services= new UserService();
    }
    public function SignUp(){
        // get data
        $data=Requset::body();

        (new SignUp())->validate($data);

        $user=$this->services->SignUp($data);
        
        return json_encode([
            "success" => true,
            "data" => $user->toArray()
        ]);
    }
}