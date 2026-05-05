<?php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../core/DB.php';
require_once __DIR__ . '/../core/router.php';
require_once __DIR__ . '/../core/Request.php';
require_once __DIR__ . '/../core/Requset.php';
require_once __DIR__ . '/../Model/UserModel.php';
require_once __DIR__ . '/../Repositories/UserRepository.php';
require_once __DIR__ . '/../Services/UserService.php';
require_once __DIR__ . '/../Validation/Auth/SignUp.php';
require_once __DIR__ . '/../Controller/UserController.php';
require_once __DIR__ . '/../Route/web.php';

use Core\Router;
use Routes\Web;

Web::routes();

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$uri = $_SERVER['REQUEST_URI'] ?? '/';

echo Router::dispatch($method, $uri);
