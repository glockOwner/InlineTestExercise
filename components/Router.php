<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Получение строки запроса
     * @return string
     */
    private function getURI(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run(){
        //Получаем строку запроса
        $uri = $this->getURI();
        //Проверяем, есть ли строка запроса
        if (!empty(trim($_SERVER['REQUEST_URI'], '/')))
        {
            //Проверить наличие такого запроса в routes.php
            foreach ($this->routes as $uriPattern => $path){
                //Сравниваем $uriPattern и $uri
                if (preg_match("~$uriPattern~", $uri)){

                    //Получаем внутренний путь из внешнего согласно правилу
                    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                    //Определяем, какой контроллер, action и параметры будут обрабатывать запрос
                    $segments = explode('/', $internalRoute);
                    if ($_GET['product_brand'])
                    {
                        $newInternalRoute = explode('?' ,$internalRoute);
                        $segments = explode('/', $newInternalRoute[0]);
                    }

                    $controllerName = array_shift($segments) . 'Controller';
                    $controllerName = ucfirst($controllerName);

                    $actionName = 'action' . ucfirst(array_shift($segments));

                    $parameters = $segments;

                    //Подключяем файл класса-контроллера
                    $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                    if (file_exists($controllerFile)){
                        include_once "$controllerFile";
                    }

                    //Создаём объект, вызываем метод(т.е. action)
                    $controllerObject = new $controllerName;
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                    if ($result!=null) {
                        break;
                    }


                }
            }
        }
        else
        {
            //Контролер и экшн главной страницы
            $controllerName = 'IndexController';
            $actionName = 'actionIndex';

            //Подключяем файл класса-контроллера
            $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

            if (file_exists($controllerFile)){
                include_once "$controllerFile";
            }
            $controllerObject = new $controllerName;
            $controllerObject->$actionName();
        }

    }
}