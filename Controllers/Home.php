<?php

namespace Controllers;

class Home extends \App\Controller
{

    public function index ($params)
    {
        if (!isset($_SESSION['home_state'])) {
            $_SESSION['home_state'] = ['column' => 'user_name', 'direction' => 'ASC', 'page' => 1];
        }
        $view_params = [];
        $view_params['message'] =
            in_array($params[0], ['added', 'login', 'logout', 'denied', 'changed', 'updated']) ?
            $params[0] : 'no_message';
        if ($view_params['message'] == 'no_message') {
            $_SESSION['home_state'] =  array(
                'column' => array_shift($params) ?: 'user_name',
                'direction' => array_shift($params) ?: 'ASC',
                'page' => array_shift($params) ?: 1
            );
        }
        $view_params['data'] = \Models\HomeModel::fetch($_SESSION['home_state']['column'], $_SESSION['home_state']['direction']);
        return $this->render('Home', $view_params);
    }
}
