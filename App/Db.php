<?php

namespace App;

use App;

class Db
{

    private $link;
    private $error;

    public function init()
    {
        $settings = $this->getSettings();
        $this->link = mysqli_connect($settings['host'], $settings['user'], $settings['password'], $settings['dbname']);
        if (mysqli_connect_errno()) {
          $this->error = mysqli_connect_error();
        } else {
          $this->error = null;
          $this->createTaskIfNotExist();
        }
    }

    protected function getSettings()
    {
        $config = include ROOTPATH.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'Db.php';
        $result['host'] = $config['host'];
        $result['dbname'] = $config['dbname'];
        $result['user'] = $config['user'];
        $result['password'] = $config['password'];
        return $result;
    }

    public function getAllTasks($column, $direction) {
        if ($this->error) return null;
        $result = mysqli_query($this->link, "SELECT * FROM task ORDER BY $column $direction");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getOneTask($id) {
        if ($this->error) return null;
        $result = mysqli_query($this->link, "SELECT * FROM task WHERE id = $id");
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    public function addRow($user_name, $email, $content) {
        $query = "INSERT INTO task (user_name, email, content, edited, done)
            VALUES ('$user_name', '$email', '$content', 0, 0)";
        if ($stmt = mysqli_prepare($this->link, $query)) {
            mysqli_stmt_execute($stmt);
        }
    }

    public function performChanges() {
        foreach ($_SESSION['edit_cache'] as $id => $changes) {
            $change_expression = '';
            foreach ($changes as $key => $value) {
                if ($change_expression) $change_expression .= ', ';
                $change_expression .= "$key = '$value'";
            }
            $query = "UPDATE task SET $change_expression WHERE id = $id";
            if ($stmt = mysqli_prepare($this->link, $query)) {
                mysqli_stmt_execute($stmt);
            }
        }
        unset($_SESSION['edit_cache']);
    }

    public function close() {
        mysqli_close($this->link);
    }

    private function createTaskIfNotExist() {
        $query = "CREATE TABLE IF NOT EXISTS task (
            id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
            user_name VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL,
            content VARCHAR(50) NOT NULL,
            edited BOOLEAN NOT NULL,
            done BOOLEAN NOT NULL
        )";
        if ($stmt = mysqli_prepare($this->link, $query)) {
            mysqli_stmt_execute($stmt);
        }
    }

}
