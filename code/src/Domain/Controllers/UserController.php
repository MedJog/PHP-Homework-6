<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Domain\Models\User;
use Geekbrains\Application1\Application\Auth;

class UserController {

    public function actionIndex() {
        $users = User::getAllUsersFromStorage();
        
        $render = new Render();

        if(!$users){
            return $render->renderPage(
                'user-empty.tpl', 
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]);
        }
        else{
            return $render->renderPage(
                'user-index.tpl', 
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]);
        }
    }

    // обработка запроса для добавления и сохранения пользователя
    public function actionSave(): string{
        if(User::validateRequestData()) {
            $user = new User();
            $user->setParamsFromRequestData();
            $user->saveToStorage();

            $render = new Render();

            return $render->renderPage(
                'user-created.tpl', 
                [
                    'title' => 'Пользователь создан',
                    'message' => "Создан пользователь " . $user->getUserName() . " " . $user->getUserLastName()
                ]);
        }
        else {
            throw new \Exception("Переданные данные некорректны");
        }
}
// обновление данных
    public function actionUpdate(): string {
        // Если данные отправлены через POST (обновление пользователя)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['id']) || empty($_POST['id'])) {
                throw new \Exception("ID пользователя не передан в запросе.");
            }
            $id = (int) $_POST['id'] ?? null;
            
            if($id && User::exists($id)) {

                $user = new User();
                $user->setUserId($_POST['id']);
                
                 // Подготовим данные для обновления
                $arrayData = [];

                if (!empty($_POST['name'])) {
                    $arrayData['user_name'] = $_POST['name'];
                }
                if (!empty($_POST['lastname'])) {
                    $arrayData['user_lastname'] = $_POST['lastname'];
                }

                // Обновляем данные
                User::updateUser((int)$id, $arrayData);

                // Отображаем подтверждение
                $render = new Render();
                return $render->renderPage(
                    'user-updated.tpl',
                    [
                        'title' => 'Пользователь обновлен',
                        'message' => "Пользователь с ID $id был успешно обновлён."
                    ]
                );
            }
            throw new \Exception("Пользователь не существует");
        }


         // Если GET-запрос (отображение формы с текущими данными)
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'] ?? null;

            if ($id && User::exists($id)) {       
                $user = User::getById($id);
                
               // Получение данных пользователя из базы данных
                $render = new Render();
                return $render->renderPage(
                    'update.tpl',
                    [
                        'user' => $user, // Передача объекта пользователя в шаблон
                    ]
                );
            }
        
            throw new \Exception("Пользователь не найден");
        }
        // В случае, если ни одна ветка выше не сработала
        return "Некорректный запрос.";
        }

      
// удаление пользователя
    public function actionDelete(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (!isset($_POST['id']) || empty($_POST['id'])) {
                throw new \Exception("ID пользователя не передан в запросе.");
            }
            $id = (int) $_POST['id'];
           
            if ($id && User::exists($id)) {
                User::deleteFromStorage($id);

                $render = new Render();
                return $render->renderPage(
                    'user-removed.tpl', []
                );
            }
            throw new \Exception("Это функция delete. Пользователь не найден $id");
        }
    
        throw new \Exception("Некорректный метод запроса");
    }

// метод генерации формы
    public function actionEdit(): string {
        $render = new Render();
        
        return $render->renderPageWithForm(
                'user-form.tpl', 
                [
                    'title' => 'Форма создания пользователя'
                ]);
    }

// hash
    public function actionHash(): string {
        return Auth::getPasswordHash($_GET['pass_string']);
    }

    public function actionAuth(): string {
        $render = new Render();
        
        return $render->renderPageWithForm(
                'user-auth.tpl', 
                [
                    'title' => 'Форма логина'
                ]);
    }
// login
    public function actionLogin(): string {
        $result = false;

        if(isset($_POST['login']) && isset($_POST['password'])){
            $result = Application::$auth->proceedAuth($_POST['login'], $_POST['password']);
        }
        
        if(!$result){
            $render = new Render();

            return $render->renderPageWithForm(
                'user-auth.tpl', 
                [
                    'title' => 'Форма логина',
                    'auth-success' => false,
                    'auth-error' => 'Неверные логин или пароль'
                ]);
        }
        else{
            header('Location: /');
            return "";
        }
    }
}
