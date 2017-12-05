<?php

    $isbn=$_POST["formISBN"];
    $title=$_POST["formTitle"];
    $editorial=$_POST["formEditorial"];
    $description=$_POST["formDesc"];
    $category=$_POST["formCategory"];
    $editionYear=$_POST["formYear"];
    $tmp=$_FILES["formCover"]['tmp_name'];
    $nameCover=$_FILES['formCover']['name'];
    $author=$_POST["formAuthor"];
    $destino="img/covers/".$nameCover;
    move_uploaded_file($tmp, $destino);
    include ("datos_conexion.inc");
    $connexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,"library_db");
    $connexion->set_charset('UTF8');
    if ($connexion->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        die();
    }
    $sentenceSQL="INSERT INTO book VALUES ($isbn,'$title','$editorial','$description','$category',$editionYear,'$nameCover','$author')";
    $registers = $connexion->query($sentenceSQL);
    $sentenceSQL="INSERT INTO copy (ISBN_FK,BookCondition) VALUES ($isbn,5)";
    $registers = $connexion->query($sentenceSQL);
    header("Location: ManageBooks.php");

?>