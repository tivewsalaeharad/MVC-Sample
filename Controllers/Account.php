<?php

namespace Controllers;

class Account extends \App\Controller
{

    public function login ($params) {
        if (isset($_POST['submit'])) {
            if ($_POST['username'] != 'admin' || $_POST['password'] != '123') {
                header('Location: /Home/index/denied');
            } else {
                $_SESSION['logged_user'] = ['login' => 'admin'];
                if (isset($_SESSION['edit_cache'])) {
                    $this->performChanges();
                    header('Location: /Home/index/updated');
                } else {
                    header('Location: /Home/index/login');
                }
            }
        } else {
            return $this->render('Login');
        }
    }

    public function logout($params) {
        unset($_SESSION['logged_user']);
        unset($_SESSION['edit_cache']);
        header('Location: /Home/index/logout');
    }

}
