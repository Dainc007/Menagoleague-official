<?php


class DatabaseConnection
{
    private $password;
    private $dsn;
    private $username;


    public function __construct()
    {
        $this->password = "Rv8K@79sIA!0D";
        $host = getenv('DB_HOST_NAME') ?? 'localhost';
        $this->dsn = "mysql:host={$host};dbname=14760_menago;charset=utf8";
        $this->username = '14760_menago';
    }

    public function getNewConnection(){
        try{
            $con = new PDO($this->dsn,$this->username,$this->password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (Exception $ex) {
            echo 'Not Connected '.$ex->getMessage();
        }
    }

}