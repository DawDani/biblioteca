<?php

const MYSQLSERVER 	= 'localhost';
const MYSQLLOGIN 	= 'root';
const MYSQLPASS 	= '';

class table
{
	protected $tableName;
	protected $fieldNum; // number of fields to paint in table
	protected $fieldList = array(); // nombre de BD == nombre sale tabla, 1o obligatorio es el id
	protected $mysqli;
	protected $row; 
	protected $nextRow;
	protected $registers;
	protected $color;
	protected $fileBrowse, $fileUpdate, $fileDelete;
	private $search;

		function __construct($dbName, $tableName, $fieldList, $fileBrowse= "", $fileUpdate = "", $fileDelete= "", $search="")
		{
		$this->dbName    = $dbName;
		$this->tableName = $tableName;
		$this->search 	 = $search;
		
		
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
		$this->mysqli = new mysqli (MYSQLSERVER,MYSQLLOGIN,MYSQLPASS,$dbName);
		if ($this->mysqli->connect_errno) 
			echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
}
//-------------------------------------------------------------------------

public function paintTable()
	{
	$this->paintHeader();

	// loop to add results
	while ($row = $this->moreRegisters())
		{
		$this->paintRow(); 
		}
	$this->paintFooter();
	} 
//-------------------------------------------------------------------------
	 
	public function paintHeader()
	{
		$this->color = 1;
		// pintamos cabecera tabla a mostrar con resultados
		


		echo "<table class='table table-striped'>
		<tr>";
		
		for ($i = 0; $i < $this->fieldNum;$i++) // adding fields to show
		{
		 echo "<td><b>" . $this->fieldList[$i] . "</b></td>";
		}
		// painting operations for rows: browse,modify, delete
		if ($this->fileBrowse != "")
		{
		echo "<td><b>Browse</b></td>";
		}
		if ($this->fileUpdate != "")
		{
		echo "<td><b>Modify</b></td>";
		}
		if ($this->fileDelete != "")
		{
		echo "<td><b>Delete</b></td>";
		}
		echo "</tr>";
		
		// to paint in different colors 
		$this->row = 0;
		
		// builing select string
		$sentenciaSQL = "select ";
		for ($i = 0; $i < $this->fieldNum - 1;$i++) // adding fields to show exc. last.
			{
			$sentenciaSQL .=  $this->fieldList[$i] . ", " ;
			}
        if($this->tableName === "copy, book"){
            $sentenciaSQL .= $this->fieldList[$this->fieldNum - 1] . " from " . $this->tableName . " where book.ISBN=copy.ISBN_FK";
        }else{
            $sentenciaSQL .= $this->fieldList[$this->fieldNum - 1] . " from " . $this->tableName;
        }
        if($this->search != "" ){
            $sentenciaSQL .= " where Title LIKE '%".$this->search."%'";
        }

		
		 //echo $sentenciaSQL;

		
		$this->registers = $this->mysqli->query ($sentenciaSQL);
		
		return $this->mysqli;
	} // paintHeader
	
//-------------------------------------------------------------------------
	public function paintRow()
	{
			echo "<tr>";

			for ($i = 0; $i < $this->fieldNum; $i++)
				{
				echo "<td>" . $this->row[$this->fieldList[$i]] . "</td>";
				}
		 
		$idToGiveInGet = $this->row[$this->fieldList[0]];
        $idToGiveInBrowse = $this->row[$this->fieldList[1]];
		if ($this->fileBrowse != "")
		{
		echo "<td><A HREF='$this->fileBrowse?isbn=" . $idToGiveInBrowse . "'> <IMG alt='search icon' SRC='img/browse.ico' width='25'></A></td>";
		}

		if ($this->fileUpdate != "")
		{
		echo "<td><a href='$this->fileUpdate?id=".$idToGiveInGet."'><img alt='modify icon' src='img/modify_icon.png' width='25'/></a></td>"; // alta.php cridat amb paràmetre c vol dir editar codi c
		}

		if ($this->fileDelete != "")
		{
		echo "<td><a href='$this->fileDelete?id=".$idToGiveInGet."'> <img alt='remove icon' src='img/remove_icon.png' width='25'/></a></td>";
		}
		
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
	 echo "</table>";
	} // paint Footer

	
	} // class Table
	

	
?>