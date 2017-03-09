<?php

namespace vendor\core;


class Router
{
    /**
     * Таблица маршрутов сайта
     * @var array
     */
    protected static $routes = [];

    /**
     * Текущий маршрут
     * @var array
     */
    protected static $route = [];


    /**
     * Добавление маршрута в таблицу маршрутов
     * @param string $regexp
     * @param array $route ([controller, action, params])
     */
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;

    }


    /**
     * Поиск текущего URL в таблице маршрутов
     * @param string $url текущий URL
     * @return bool
     */

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {

            if (preg_match("~$pattern~i", $url, $matches)) {

                foreach ($matches as $key => $value) {

                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }

                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }

                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * ?????????????? URL ?? ??????????? ????????
     * @param string $url ???????? URL
     * @return void
     */
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        
        try {
            
            if (self::matchRoute($url)) {

                $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
                
                if (class_exists($controller)) {
                    
                    $cObj = new $controller(self::$route);
                    $action = 'action' . self::upperCamelCase(self::$route['action']);
                    $parameters = self::$route['parameter'];
                    
                    if (method_exists($cObj, $action)) {
                        
                        $cObj->$action($parameters);
                    } else {
                        
                        throw new  \Exception();
                    }
                    
                } else {
                    
                    throw new  \Exception();
                }
            }
        } catch (\Exception $e) {
            
            header("Location:/public/404.html");
        }

    }

    /**
     * ??????????? ?????? ????? ????? ? ???????? ????????
     * @param string $name
     * @return string $name
     */

    public static function upperCamelCase($name)
    {

        return $name = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));

    }

    public static function lowerCamelCase($name)
    {

        return lcfirst(self::upperCamelCase($name));

    }

    public static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url, 2);
            if (false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }
}