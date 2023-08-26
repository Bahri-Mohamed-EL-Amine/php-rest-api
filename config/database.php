<?php
class Database
{


    // declaration
    private $hostname;
    private $dbname;
    private $username;
    private $password;

    private $conn;

    public function connect()
    {

        // initialisation
        $this->hostname = "localhost";
        $this->dbname = "rest_api";
        $this->username = "root";
        $this->password = "admin";


        // connection
        $this->conn = new mysqli(
            $this->hostname,
            $this->username,
            $this->password,
            $this->dbname,
        );

        if ($this->conn->connect_errno) {
            // has errors
            print_r($this->conn->connect_error.'\n');
            exit;
        } else {
            // no errors => return connection
            echo "connected to database successfully \n";
            return $this->conn;
        }

    }
}

?>