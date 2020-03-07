<?php

namespace Controllers;

class Error extends \App\Controller
{

    public function error404 ($params)
    {
        return $this->render('Error404', $params);
    }

    public function error500 ($params)
    {
        return $this->render('Error500', $params);
    }

}
