<?php
require_once "datos_conexion.inc";

class table
{
    protected $tableName;
    protected $fieldNum; // number of fields to paint in table
    protected $fieldList = array(); // nombre de BD == nombre sale tabla, 1o obligatorio es el id
    protected $mysqli;
    protected $row;
    protected $nextRow;
    protected $registers;
    protected $fileBrowse, $fileUpdate, $fileDelete;
    private $cont = 0;

    function __construct($dbName, $tableName, $fieldList, $fileBrowse = "", $fileUpdate = "", $fileDelete = "", $opcio = 0)
    {
        $this->dbName = $dbName;
        $this->tableName = $tableName;
        $this->fieldNum = count($fieldList);
        for ($i = 0; $i < $this->fieldNum; $i++)
            $this->fieldList [$i] = $fieldList [$i];

        $this->fileBrowse = $fileBrowse;
        $this->fileUpdate = $fileUpdate;
        $this->fileDelete = $fileDelete;
        $this->connectDB($dbName);
    } //construct

//-------------------------------------------------------------------------
    private function connectDB($dbName)
    {
        // conectamos a la BD
        $this->mysqli = new mysqli (DB_HOST, DB_USER, DB_PASS, $dbName);
        $this->mysqli->set_charset('UTF8');
        if ($this->mysqli->connect_errno)
            echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
    }

//-------------------------------------------------------------------------

    public function paintTable()
    {
        $this->paintHeader();

        // loop to add results
        while ($row = $this->moreRegisters()) {
            if($this->cont%3===0){
                echo "</div><br/><div class=\"row\">";
                $this->paintRow();
            }else{
                $this->paintRow();
            }
            $this->cont++;
        }
        while($this->cont%3!==0){
            $this->paintEmptyRow();
            $this->cont++;
        }
        $this->paintFooter();
    }

//-------------------------------------------------------------------------

    public function paintHeader()
    {
        echo "<div class=\"row\">";

        // builing select string
        $sentenciaSQL = "select ";
        $sentenciaSQL .= implode(',', $this->fieldList);
        $sentenciaSQL .= " from " . $this->tableName ." ORDER BY Title";

        // echo $sentenciaSQL;
        $this->registers = $this->mysqli->query($sentenciaSQL);
        return $this->mysqli;
    } // paintHeader

//-------------------------------------------------------------------------
    public function paintRow()
    {
        $bookISBN = $this->row[$this->fieldList[0]];
        $bookTitle = $this->row[$this->fieldList[1]];
        $cover= $this->row[$this->fieldList[2]];
        echo "<div class=\"col\">
                     <div class=\"card\" style=\"width: 90%;\">
                    <img class=\"card-img-top\" src=\"./img/covers/".$cover."\" alt=\"Card image cap\">
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">".$bookTitle."</h4>
                        <a href=\"BookPage.php?isbn=".$bookISBN."\" class=\"btn btn-primary\">More info</a>
                    </div>
                </div>
               </div>";

    } // paintRow
    //-------------------------------------------------------------------------
    public function paintEmptyRow()
    {
        echo "<div class=\"col\">
               </div>";

    } // paintRow

//-------------------------------------------------------------------------
    public function moreRegisters()  // are there more registers to paint?
    {
        $this->row = $this->registers->fetch_assoc();
        return ($this->row);
    } // moreRegisters

//-------------------------------------------------------------------------
    public function paintFooter() // closes table and connection DB
    {
        echo "</div>";
    } // paint Footer


} // class Table


?>