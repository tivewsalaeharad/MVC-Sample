<?php
namespace Models;
use App;

class HomeModel {

    static function fetch($column, $direction) {
        App::$db->init();
        $db_result = App::$db->getAll("SELECT * FROM task ORDER BY $column $direction");
        App::$db->close();
        return $db_result;
    }

}

?>
