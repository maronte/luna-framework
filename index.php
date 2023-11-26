<?php

require('./Router.php');

$router = new Router();

$router->get('/test', function () {
    return 'GET OK';
});

$router->post('/test', function () {
    return 'POST OK';
});

try {
    $action = $router->resolve();
} catch (HttpNotFoundException $e) {
    $action = function () use ($e) {
        http_response_code($e->getCode());
        return $e->getMessage();
    };
}

print($action());
