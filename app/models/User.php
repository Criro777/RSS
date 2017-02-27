<?php

namespace app\models;


use vendor\core\Db;
use app\models\Comment;


class User
{
    protected $username;
    protected $email;
    protected $password;
    protected $db;

    /**
     * User constructor.
     * @param string $username
     * @param $email
     * @param $password
     */
    public function __construct($username = '', $email, $password)
    {
        $this->db = Db::instance();
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Регистрация пользователя
     * @return bool
     */
    public function registerUser()
    {

        $sql = "INSERT INTO users (username, email, password)  VALUES (:username, :email, :password)";

        $result = $this->db->execute($sql, [':username' => $this->username,
            ':email' => $this->email,
            ':password' => crypt($this->password, "salt")]);

        return $result;

    }

    /**
     * Валидация полей при регистрации
     * @return array <p>Массив ошибок при регистрации пользователя</p>
     */

    public function validationRegister()
    {


        $errorsRegister = [];


        if (strlen($this->username) <= 2 or $this->username == '') {

            $errorsRegister[] = 'Имя не должно быть короче 2-х символов';
        }
        if (strlen($this->password) <= 6 or $this->password == '') {

            $errorsRegister[] = 'Пароль не должен быть короче 6-ти символов';
        }

        if ($this->email == '') {

            $errorsRegister[] = 'Введите корректный email';
        }

        if (!User::checkEmailExists()) {

            $errorsRegister[] = 'Такой email уже используется';
        }


        return $errorsRegister;
    }

    /**
     * Валидация полей формы при авторизации
     * @return array <p>Массив ошибок при авторизации пользователя</p>
     */
    public function validationLogin()
    {

        $errorsLogin = [];

        if ($this->email == '') {
            $errorsLogin[] = 'Введите корректный email';
        }


        if (!self::checkUserExists()) {
        $errorsLogin[] = 'Пользователь не найден';
        }

        return $errorsLogin;

    }

    /**
     * Аутентификация пользователя
     * @param $email <p>Email пользователя</p>
     * @param $password <p>Пароль пользователя</p>
     * @return array|bool
     */
    public function checkUserExists()
    {

        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";

        $user = $this->db->query($sql, [$this->email, crypt($this->password, "salt")]);

        if ($user) {

            return $user;
        }
        return false;
    }

    /**
     * Проверка существования введённого  Email-а в базе данных
     * @return bool
     */
    public function checkEmailExists()
    {

        $sql = "SELECT * FROM users WHERE email = :email";

        $result = $this->db->query($sql, [':email' => $this->email]);

        if ($result) {

            return true;
        }
        return false;
    }

}