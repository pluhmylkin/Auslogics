<?php

class Db
{
    private $dbDriver = 'mysql';
    private $host = 'localhost';
    private $dbName = 'auslogics';
    private $username = 'root';
    private $password = 'root';
    private $db;
    private $sth;

    function __construct()
    {
        $this->connect();
    }

    function connect()
    {
        try {
            $this->db = new PDO($this->dbDriver . ":host=$this->host;dbname=$this->dbName;charset=UTF8", $this->username, $this->password);
            $this->query("SET NAMES  utf8;", 'set utf-8');
        } catch
        (PDOException  $e) {
            echo "Error: " . $e;
            die();
        }
    }

    /**
     * Native query
     * @param $query
     * @param string $info
     */
    function query($query)
    {
        try {
            $this->sth = $this->db->query($query);
        } catch (PDOException  $e) {
            die("Error: " . $e);
        }
    }

    /**
     * fetch
     * @return mixed
     */
    function fetch()
    {
        return $this->sth->fetch(PDO::FETCH_ASSOC);
    }

}