<?php

namespace Controllers;

class NewTask extends \App\Controller
{

    public function index ($params)
    {
      if (isset($_POST['submit'])) {
          $this->addRow($_POST['user_name'], $_POST['email'], $_POST['content']);
          header('Location: /Home/index/added');
      } else {
          return $this->render('NewTask');
      }
    }

}
