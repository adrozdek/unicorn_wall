<?php

namespace App\Core;

use TreeRoute\Router;

/**
 * Class App
 * @package App\Core
 */
class App
{
    /**
     * @param $url
     */
    public function run($url)
    {
        try {
            $this->dispatch($url);
            $conf = new Config();
            $conf->getConfig('db.host.param3.trzy3.loc');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $url
     * @throws \Exception
     */
    public function dispatch($url)
    {
        $router = $this->prepareRouter();

        $method = 'GET';
        $result = $router->dispatch($method, $url);

        if (!isset($result['error'])) {
            $handler = $result['handler'];
            $params = $result['params'];

            if (count(explode('.', $handler)) != 2) {
                throw new \Exception('Wrong handler name');
            }
            list($controller, $method) = explode('.', $handler);

            $controller = 'App\Controllers\\' . ucfirst($controller) . 'Controller';
            if (class_exists($controller) && method_exists(new $controller, $method)) {
                call_user_func_array([new $controller, $method], $params);
            } else {
                throw new \Exception('Controller or Action not exists.');
            }

        } else {
            throw new \Exception('Error ' . $result['error']['code']);
        }
    }

    /**
     * @return Router
     */
    private function prepareRouter()
    {
        $router = new Router();

        //config do ustawienia urli:
        $config = new Config();
        $urls = $config->getConfig('urls');

        foreach ($urls as $route => $handler) {
            $router->get($route, $handler);
        }

        return $router;
    }
}
