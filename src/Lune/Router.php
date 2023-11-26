<?php

namespace Lune;

class Router
{
    protected array $routes = [];

    public function __construct()
    {
        foreach (HttpMethods::cases() as $httpMethod) {
            $this->routes[$httpMethod->value] = [];
        }
    }

    public function resolve(): callable
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'];

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            throw new HttpNotFoundException();
        }

        return $callback;
    }

    public function get(string $path, callable $callback): void
    {
        $this->routes[HttpMethods::GET->value][$path] = $callback;
    }

    public function post(string $path, callable $callback): void
    {
        $this->routes[HttpMethods::POST->value][$path] = $callback;
    }

    public function put(string $path, callable $callback): void
    {
        $this->routes[HttpMethods::PUT->value][$path] = $callback;
    }

    public function patch(string $path, callable $callback): void
    {
        $this->routes[HttpMethods::PATCH->value][$path] = $callback;
    }

    public function delete(string $path, callable $callback): void
    {
        $this->routes[HttpMethods::DELETE->value][$path] = $callback;
    }
}
