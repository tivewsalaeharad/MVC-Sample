<?php

namespace Controllers;

class Home extends \App\Controller
{

    public function index ($params)
    {
        return $this->render('Home', $params);
    }

}
