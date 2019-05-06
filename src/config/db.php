<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Content-Length, X-JSON");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: *");

class Db
{
    //private $dbhost = 'localhost';
    //private $dbuser = 'root';
    //private $dbpass = '';
    //private $dbname = 'social-net';

    private $dbhost = 'us-cdbr-iron-east-03.cleardb.net';
    private $dbuser = 'bcd26e9ebf14f2';
    private $dbpass = '4d91b0d1';
    private $dbname = 'heroku_9b7e2f5e0a290ef';

    public function connect()
    {
        $connect_string = "mysql:host=$this->dbhost;dbname=$this->dbname;";

        $dbConnection = new PDO($connect_string, $this->dbuser, $this->dbpass);

        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $dbConnection;
    }

}
