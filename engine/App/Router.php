<?php

namespace Engine\App;

class Router
{
    /**
     * Ссылка
     *
     * @var string|mixed
     */
    private string $uri;

    /**
     * Путь запроса
     *
     * @var array|false|string[]
     */
    private array $road;

    /**
     * Params
     *
     * @var array
     */
    public array $data;

    private array $pages;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->road = $this->getRoad();

        $this->data = $_REQUEST;
    }

    public function init()
    {
        if (isset($this->pages[$this->uri])) {
            $this->checkMethod($this->pages[$this->uri]['method']);
            $this->render();
        } else {
            echo "<b>404</b>";
        }
    }

    public function getRoad()
    {
        return explode('/', $this->uri);
    }

    public function get($router, $callback)
    {
        $this->pages = [
            $router => [
                'method' => 'GET',
                'callback' => $callback
            ]
        ];
    }

    public function post($router, $callback)
    {
        $this->pages = [
            $router => [
                'method' => 'POST',
                'callback' => $callback
            ]
        ];
    }

    private function render()
    {
        return $this->pages[$this->uri]['callback']();
    }

    private function checkMethod($method)
    {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
            exit("<b>Error. Method not allowed.</b>");
        }
    }
}