<?php

namespace Geekbrains\Application1\Domain\Models;

use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Infrastructure\Storage;
use \PDO;

class User {
    private ?int $idUser;
    private ?string $userName;
    private ?string $userLastName;
    private ?int $userBirthday;

    private static string $storageAddress = '/storage/birthdays.txt';

    // конструктор
    public function __construct(string $name = null, string $lastName = null, int $birthday = null, int $id_user = null){
        $this->userName = $name;
        $this->userLastName = $lastName;
        $this->userBirthday = $birthday;
        $this->idUser = $id_user;
    }
    
    public function setUserId(int $id_user): void {
        $this->idUser = $id_user;
    }

    public function getUserId(): ?int {
        return $this->idUser;
    }

    public function setName(string $userName) : void {
        $this->userName = $userName;
    }

    public function setLastName(string $userLastName) : void {
        $this->userLastName = $userLastName;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getUserLastName(): string {
        return $this->userLastName;
    }

    public function getUserBirthday(): int {
        return $this->userBirthday;
    }
    
    public function setBirthdayFromString(?string $birthdayString) : void {
        if ($birthdayString) {
            $this->userBirthday = strtotime($birthdayString);
        } else {
            $this->userBirthday = null; // устанавливаем null, если дата не указана
        }
    }
// получение даных из хранилища
    public static function getAllUsersFromStorage(): array {
        $sql = "SELECT * FROM users";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute();
        $result = $handler->fetchAll();

        $users = [];

        foreach($result as $item){
            $user = new User($item['user_name'], $item['user_lastname'], $item['user_birthday_timestamp'], $item['id_user']);
            $users[] = $user;
        }
    
    return $users;
}

// проверка данных
    public static function validateRequestData(): bool{
        $result = true;
        
        if(!(
            isset($_POST['name']) && !empty($_POST['name']) &&
            isset($_POST['lastname']) && !empty($_POST['lastname']) &&
            isset($_POST['birthday']) && !empty($_POST['birthday'])
        )){
            $result = false;
        }
        // Проверка на дату в формате DD-MM-YYYY
        if(!preg_match('/^(\d{2}-\d{2}-\d{4})$/', $_POST['birthday'])){
            $result =  false;
        }
         // Проверка на отсутствие HTML-тегов в имени и фамилии
        if (
            preg_match('/<[^>]*>/', $_POST['name']) || 
            preg_match('/<[^>]*>/', $_POST['lastname'])
        ) {
            $result = false;
        }
        // if(!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
        //     $result = false;
        // }

        return $result;
        
    }

    public function setParamsFromRequestData(): void {
        $this->userName = htmlspecialchars($_POST['name']);
        $this->userLastName = htmlspecialchars($_POST['lastname']);
        $this->setBirthdayFromString($_POST['birthday']); 
    }
    // Метод для сохранения пользователя
    public function saveToStorage(){
        $sql = "INSERT INTO users(user_name, user_lastname, user_birthday_timestamp) VALUES (:user_name, :user_lastname, :user_birthday)";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'user_name' => $this->userName,
            'user_lastname' => $this->userLastName,
            'user_birthday' => $this->userBirthday
        ]);
    }
    // наличие пользователя
    public static function exists(int $id): bool{
        $sql = "SELECT count(id_user) as user_count FROM users WHERE id_user = :id_user";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'id_user' => $id
        ]);

        $result = $handler->fetchAll();

        if(count($result) > 0 && $result[0]['user_count'] > 0){
            return true;
        }
        else{
            return false;
        }
    }
    // обновление данных пользователя
    public static function updateUser(int $user_id, array $userDataArray): void {
        $sql = "UPDATE users SET ";
    
        $counter = 0;
        foreach ($userDataArray as $key => $value) {
            $sql .= $key . " = :" . $key;
    
            if ($counter != count($userDataArray) - 1) {
                $sql .= ",";
            }
    
            $counter++;
        }
    
        // Добавляем условие WHERE для указания конкретного пользователя
        $sql .= " WHERE id_user = :id_user";
    
        $handler = Application::$storage->get()->prepare($sql);
    
        // Обновляем данные с учетом идентификатора пользователя
        $userDataArray['id_user'] = $user_id;
        $handler->execute($userDataArray);
    }
    
    // удаление пользователя
    public static function deleteFromStorage(int $user_id) : void {
        $sql = "DELETE FROM users WHERE id_user = :id_user";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id_user' => $user_id]);
    }
    // получение пользователя по id
    public static function getById(int $id): ?User {
        $sql = "SELECT id_user, user_name, user_lastname, user_birthday_timestamp FROM users WHERE id_user = :id_user";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id_user' => $id]);
        $result = $handler->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User($result['user_name'], $result['user_lastname'], $result['user_birthday_timestamp'], $result['id_user']);
        }
        
        return null;
    }

    
}