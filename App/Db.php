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

    public function getAll(string $query) {
        if ($this->error) return null;
        $result = mysqli_query($this->link, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getOne(string $query) {
        if ($this->error) return null;
        $result = mysqli_query($this->link, $query);
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    public function execute(string $query) {
        if ($stmt = mysqli_prepare($this->link, $query)) {
            mysqli_stmt_execute($stmt);
        }
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
