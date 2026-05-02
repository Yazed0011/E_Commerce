<?php
namespace Core;

class Request {
    public static function body() {
        $input = file_get_contents("php://input");
        return json_decode($input, true) ?? [];
    }
}
