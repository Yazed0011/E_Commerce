<?php 
namespace Model;
class UserModel {
    private $id;
    private $name;
    private $email;
    private $password;
    private $admin;
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