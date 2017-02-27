<?php

namespace app\controllers;

use vendor\core\engine\Controller;
use app\models\User;


class UserController extends Controller
{

    /**
     * Регистрация
     */
    public function actionRegister()
    {
        if (!isset($_SESSION['user'])) {

            $this->render('register');

            unset($_SESSION['errors']);

            if (isset($_POST['register'])) {

                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];


                $user = new User($username, $email, $password);
                $validation = $user->validationRegister();


                if (count($validation) != 0) {

                    $_SESSION['errors'] = $validation;
                    header('Location:/user/register');

                } else {

                    $success = $user->registerUser();
                    $_SESSION['success'] = $success;
                    header('Location:/user/login');

                }

            }
        } else {
            header('Location:/');

        }

    }

    /**
     * Авторизация
     */
    public function actionLogin()
    {
        if (!isset($_SESSION['user'])) {

            $this->render('login');

            unset($_SESSION['errors']);

            unset($_SESSION['success']);

            if (isset($_POST['login'])) {

                $email = $_POST['email'];

                $password = $_POST['password'];

                $user = new User('', $email, $password);


                $auth = $user->validationLogin();

                if (count($auth) != 0) {

                    $_SESSION['errors'] = $auth;

                    header("Location:/user/login");

                } else {
                    $currentUser = $user->checkUserExists();

                    $_SESSION['user'] = $currentUser[0]->username;

                    header("Location:/article/list");
                }


            }

        } else header('Location:/');
    }

    /**
     * Выход
     */

    public function actionLogout()
    {
        unset($_SESSION['user']);

        header("Location: /");
    }

}