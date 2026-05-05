<?php 
namespace Middleware;
use Core\Token;
use Exception;
class Auth {
    private $token;
    public function __construct()
    {
        $this->token = new Token();
    }

    public function handle($request){
        $header = getallheaders();
        $AuthHeader = $header['Authorization'] ?? null;
        if(!$AuthHeader){
            throw new Exception("Unauthorized");
        }
        if(!str_starts_with($AuthHeader, 'Bearer ')){
            throw new Exception("Unauthorized");
        }
        $token = str_replace('Bearer ', '', $AuthHeader);
        $decoded = $this->token->verifyToken($token);
        if(!$decoded){
            throw new Exception("Unauthorized");
            }

            return [
                "id"       => (int) ($decoded->sub              ?? 0),
                "name"     => $decoded->data->name              ?? null,
                "email"    => $decoded->data->email             ?? null,
                "is_admin" => (int) ($decoded->data->is_admin   ?? 0),
            ];
    }

}