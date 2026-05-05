<?php 
namespace Core;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
class Token{
    private string $JWT_KEY;
    private int $JWT_EXPIRATION;
    private string $JWT_ALGORITHM;
    private array $payload;
    private array $header;


    public function __construct(){
        $this->JWT_KEY = getenv('JWT_KEY');
        $this->JWT_EXPIRATION = getenv('JWT_EXPIRATION');
        $this->JWT_ALGORITHM = getenv('JWT_ALGORITHM');
    }

    public function generateToken(array $data){
        if (empty($data['id'])) {
            throw new Exception("User ID is required");
        }
        $now = time();
        $payload = [
            "iss" => "E_Commerce API",
            "iat" => $now,
            "exp" => $now + $this->JWT_EXPIRATION,
            "sub" => (int) $data['id'],
            "payload" => [
                "email" => $data['email'] ?? null,
                "name" => $data['name'] ?? null,
                "admin" => $data['admin'] 
            ]
            ];
        $header = [
            "alg" => $this->JWT_ALGORITHM,
            "typ" => "JWT"
        ];
        $jwt = JWT::encode($header, $payload, $this->JWT_KEY);
        return $jwt;
}

    public function verifyToken(string $token){
        try {
            $decoded = JWT::decode($token, new Key($this->JWT_KEY, $this->JWT_ALGORITHM));
            return $decoded;
        } catch (\Exception $e) {
            throw new Exception("Invalid token: " . $e->getMessage());
        }
    }

    public function generateRefreshToken(array $data){
        return bin2hex(random_bytes(64));
    }
}