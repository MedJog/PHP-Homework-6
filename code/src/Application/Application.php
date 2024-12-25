<?php

namespace Geekbrains\Application1\Application;

use Geekbrains\Application1\Infrastructure\Config;
use Geekbrains\Application1\Infrastructure\Storage;
use Geekbrains\Application1\Application\Auth;

class Application {

    private const APP_NAMESPACE = 'Geekbrains\Application1\Domain\Controllers\\';

    private string $controllerName;
    private string $methodName;

    public static Config $config;
    public static Storage $storage;

    public static Auth $auth;

    
    public function __construct(){
        Application::$config = new Config();
        Application::$storage = new Storage();
        Application::$auth = new Auth();
    }


    public function run() : string {
        // session_start();
// разбиваем строку по символам
        $routeArray = explode('/', $_SERVER['REQUEST_URI']);
// если 1 элемент сущестует и не пуст
        if(isset($routeArray[1]) && $routeArray[1] != '') {
            $controllerName = $routeArray[1];
        }
        else{
            $controllerName = "page";
        }
// фомирмируем имя контроллера
        $this->controllerName = Application::APP_NAMESPACE . ucfirst($controllerName) . "Controller";
// если класс существует
        if(class_exists($this->controllerName)){
// пытаемся вызвать метод
            if(isset($routeArray[2]) && $routeArray[2] != '') {
                $methodName = $routeArray[2];
            }
            else {
                $methodName = "index";
            }

            $this->methodName = "action" . ucfirst($methodName);

            if(method_exists($this->controllerName, $this->methodName)){
                $controllerInstance = new $this->controllerName();
                return call_user_func_array(
                    [$controllerInstance, $this->methodName],
                    []
                );
            }
            else {
                // return "Метод не существует";
                return $this->renderErrorPage("Метод $this->methodName не существует", 404);
            }
        } else {
            // return "Класс $this->controllerName не существует";
            return $this->renderErrorPage("Класс $this->controllerName не существует", 404);
        }
        }
        // формируем страницу ошибки
        private function renderErrorPage(string $errorMessage, int $errorCode): string {
        // Устанавливаем HTTP-заголовок ошибки
            http_response_code($errorCode);

        // Используем класс Render для вывода страницы ошибки
            $renderer = new Render();
            return $renderer->renderPage('error.tpl', [
            'errorCode' => $errorCode,
            'errorMessage' => $errorMessage
        ], false);
    }

    }