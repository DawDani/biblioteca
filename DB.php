<?php
/**
 * Created by PhpStorm.
 * User: pytxy
 * Date: 12/9/17
 * Time: 8:23 PM
 */
require_once "datos_conexion.inc";

class DB
{
    private $conn;

    public function __construct($db_name = "library_db")
    {
        $this->conn = new mysqli (DB_HOST, DB_USER, DB_PASS, $db_name);
        $this->conn->set_charset('UTF8');
        if ($this->conn->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->conn->connect_error;
            die("rekt");
        }
    }

    public function select(array $values = ['*'], string $from = null, string $where = null)
    {
        $vals = '';
        foreach ($values as $val) {
            $vals .= $val . ',';
        }
        $query = "SELECT ";
        $this->conn->query();
    }

    public function selectRaw(string $query)
    {
        $rows = $this->conn->query($query);
        $out = [];
        while ($row = $rows->fetch_assoc()){
            $out[] = $row;
        }
        return $out;
    }

    public function close()
    {
        $this->conn->close();
    }
}