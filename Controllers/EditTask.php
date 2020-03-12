<?php

namespace Controllers;

class EditTask extends \App\Controller
{

    public function edit($params){
        if (isset($_POST['submit'])) {
            \Models\EditTaskModel::storeChanges($_POST['id'], $_POST['user_name'], $_POST['email'], $_POST['content']);
            $this->performIfAdmin();
        } else {
            return $this->render('NewTask', \Models\EditTaskModel::getOneTask($params[0]));
        }
    }

    public function fulfil($params) {
        $_SESSION['edit_cache'] = [$params[0] => array('done' => 1)];
        $this->performIfAdmin();
    }

    private function performIfAdmin() {
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['login'] == 'admin') {
            \Models\EditTaskModel::performChanges();
            header('Location: /Home/index/changed');
        } else {
            if(isset($_SESSION['logged_user'])) unset($_SESSION['logged_user']);
            header('Location: /Account/login');
        }
    }

}
