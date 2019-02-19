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
    private $url;
    private $dbhost;
    private $dbuser;
    private $dbpass;
    private $dbname;


    public function connect() {
        $this->url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $this->dbhost = $url["host"];
        $this->dbuser = $url["user"];
        $this->dbpass = $url["pass"];
        $this->dbname = substr($url["path"], 1);
        $connect_string = "mysql:host=$this->dbhost;dbname=$this->dbname;";

        $dbConnection = new PDO($connect_string, $this->dbuser, $this->dbpass);

        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $dbConnection;
    }

     

}