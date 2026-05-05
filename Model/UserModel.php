<?php 
namespace Model;
class UserModel {
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private bool $admin;
    public function __construct(array $data) {
        $this->id=$data['id'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->admin = $data['admin'];
    }
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'admin' => $this->admin,
        ];
    }
}