<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('ROOT', dirname(__FILE__));

class Db {

    
    
    public static function getConnection()
    {

        $params = array(
            'host' => 'localhost',
            'dbname' => 'zinchenko_shop',
            'user' => 'root',
            'password' => '',
        );
        

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->exec("set names utf8");
        
        return $db;
    }

}

class User
{
    public static function register($name, $email, $password) {
        $role = "";
        
        $db = Db::getConnection();
        
        //$sql = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';

        //$sql = 'INSERT INTO user (name, email, password) VALUES (?, ?, ?)';
        
        $result = $db->prepare('INSERT INTO user (id, name, email, password, role) VALUES (?, ?, ?, ?, ?)');

       // INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES (NULL, 'Константин', 'korenev@iled.com.ua', '260481', '');

        //$result->bindParam(':name', $name, PDO::PARAM_STR);
        //$result->bindParam(':email', $email, PDO::PARAM_STR);
        //$result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute(array(NULL, $name, $email, $password, $role));

        //return $result->execute();
        //$result = $result->execute();
        /*
        if($result->execute()) {
            print_r($result);
        } else {
            print_r('result false');
        }
        */
        
    }
    /**
     * Проверяет имя: не меньше, чем 2 символа
     */
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет имя: не меньше, чем 6 символов
     */
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет email
     */
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    public static function checkEmailExists($email) {
        
        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn()) {
            return true;
        }
        return false;
    }
}



class UserController
{

    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
            
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }
            
            if ($errors == false) {
                $result = User::register($name, $email, $password);
            }

        }
         require_once(ROOT . '/views/user/register.php');

        return true;
    }

}

$registerUser = new UserController;

$registerUser->actionRegister();
