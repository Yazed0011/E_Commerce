<?php 
namespace Core;

class Requset{
    
    public static function body(){
        $input = file_get_contents("php://input");
        return json_decode($input, true);
    }
}