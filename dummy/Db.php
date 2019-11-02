<?php

class Db
{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    private $conn; //database connection

    protected function connect()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "csit314";

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        return $conn;
    }
}

?>
