<?php 
namespace Routes;
use Controller\UserController;
use Core\Router;
class Web {
    public static function routes() {
        Router::get('/', [UserController::class, 'index']);
        Router::post('/signup', [UserController::class, 'signup']);
    }
}