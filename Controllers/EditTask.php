<?php

namespace Controllers;

class EditTask extends \App\Controller
{

    public function edit($params){
        if (isset($_POST['submit'])) {
            $_SESSION['edit_cache'] = [$_POST['id'] => array(
                'user_name' => $this->protectString($_POST['user_name']),
                'email' => $this->protectString($_POST['email']),
                'content' => $this->protectString($_POST['content']),
                'edited' => 1
            )];
            $this->performIfAdmin();
        } else {
            return $this->render('NewTask', $params);
        }
    }

    public function fulfil($params) {
        $_SESSION['edit_cache'] = [$params[0] => array('done' => 1)];
        $this->performIfAdmin();
    }

    private function performIfAdmin() {
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['login'] == 'admin') {
            $this->performChanges();
            header('Location: /Home/index/changed');
        } else {
            if(isset($_SESSION['logged_user'])) unset($_SESSION['logged_user']);
            header('Location: /Account/login');
        }
    }

}
