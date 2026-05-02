<?php 
namespace Controller;
use Services\UserService;
use Core\Request;
use Validation\Auth\SignUp;
use Exception;

class UserController{
    private $service;
    public function __construct()
    {
        $this->service= new UserService();
    }
    public function index() {
        return json_encode([
            "success" => true,
            "message" => "E_Commerce API is running"
        ]);
    }

    public function signup(){
        $data = Request::body();
        $validationResult = (new SignUp())->validate($data);

        if ($validationResult !== true) {
            http_response_code(422);
            return json_encode([
                "success" => false,
                "errors" => $validationResult
            ]);
        }

        try {
            $user = $this->service->signup($data);
            return json_encode([
                "success" => true,
                "data" => $user->toArray()
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            return json_encode([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}