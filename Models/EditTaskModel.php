<?php
namespace Models;
use App;

class EditTaskModel {

    static function getOneTask($id) {
        App::$db->init();
        $db_result = App::$db->getOne("SELECT * FROM task WHERE id = $id");
        App::$db->close();
        array_walk($db_result, function (&$str) {
            $str = str_replace('&lt', '<', $str);
            $str = str_replace('&gt', '>', $str);
        });
        $db_result['id'] = $id;
        return $db_result;
    }

    static function storeChanges($id, $user_name, $email, $content) {
        $_SESSION['edit_cache'] = [$id => array(
            'user_name' => protectString($user_name),
            'email' => protectString($email),
            'content' => protectString($content),
            'edited' => 1
        )];
    }

    static function performChanges() {
        App::$db->init();
        foreach ($_SESSION['edit_cache'] as $id => $changes) {
            $change_expression = '';
            foreach ($changes as $key => $value) {
                if ($change_expression) $change_expression .= ', ';
                $change_expression .= "$key = '$value'";
            }
            App::$db->execute("UPDATE task SET $change_expression WHERE id = $id");
        }
        unset($_SESSION['edit_cache']);
        App::$db->close();
    }
}

function protectString($str) {
    $str = str_replace('<', '&lt', $str);
    $str = str_replace('>', '&gt', $str);
    return ($str);
}

?>
