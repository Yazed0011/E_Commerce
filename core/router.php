<?php 
namespace Core;
class Router {
    private static $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public static function get($path, $callback) {
        self::$routes['GET'][$path] = $callback;
    }

    public static function post($path, $callback) {
        self::$routes['POST'][$path] = $callback;
    }

    public static function dispatch($method, $uri) {
        $path = parse_url($uri, PHP_URL_PATH);
        $callback = self::$routes[$method][$path] ?? null;

        if ($callback === null) {
            http_response_code(404);
            return json_encode([
                'success' => false,
                'message' => 'Route not found',
            ]);
        }

        if (is_array($callback) && count($callback) === 2) {
            $controller = new $callback[0]();
            $action = $callback[1];
            return $controller->$action();
        }

        if (is_callable($callback)) {
            return call_user_func($callback);
        }

        http_response_code(500);
        return json_encode([
            'success' => false,
            'message' => 'Invalid route callback',
        ]);
    }
}