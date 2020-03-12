<?php
namespace Models;
use App;

class NewTaskModel {

    static function add($user_name, $email, $content) {
        App::$db->init();
        $user_name = protectString($user_name);
        $email = protectString($email);
        $content = protectString($content);
        App::$db->execute("INSERT INTO task (user_name, email, content, edited, done)
            VALUES ('$user_name', '$email', '$content', 0, 0)");
        App::$db->close();
    }

}

function protectString($str) {
    $str = str_replace('<', '&lt', $str);
    $str = str_replace('>', '&gt', $str);
    return ($str);
}

?>
