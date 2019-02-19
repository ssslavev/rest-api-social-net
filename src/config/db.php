<?php
header("Access-Control-Allow-Origin:  http://localhost:4200");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");

class Db {
    //private $dbhost = 'localhost';
    //private $dbuser = 'root';
    //private $dbpass = '';
    //private $dbname = 'social-net';
    private $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    private $dbhost = $url["host"];
    private $dbuser = $url["user"];
    private $dbpass = $url["pass"];
    private $dbname = substr($url["path"], 1);

    public function connect() {
        $connect_string = "mysql:host=$this->dbhost;dbname=$this->dbname;";

        $dbConnection = new PDO($connect_string, $this->dbuser, $this->dbpass);

        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $dbConnection;
    }

     

}