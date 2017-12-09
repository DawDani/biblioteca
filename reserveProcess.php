<?php
require_once "datos_conexion.inc";
$resDay = $_POST['reservationDay'];
//connecting to BD
$connexion = new mysqli (DB_HOST, DB_USER, DB_PASS, "library_db");
$connexion->set_charset('UTF8');
if ($connexion->connect_errno) {
    echo "Failed to connect to MySQL: " . $connexion->connect_error;
    die();
}

if (isset($_POST["isbn"])) {
    $isbn = $_POST["isbn"];
}


$sentenceSQL =<<<CODE
    SELECT
      !(count( id ) <> ( select count( copy.id ) FROM `copy`where`copy`.`ISBN_FK` = '$isbn' )) AS needsBlock
    FROM `reserved_copy`
    WHERE `reserved_copy`.`CopyId`IN
    (
        SELECT
          id
        FROM `copy`
        WHERE `copy`.`ISBN_FK` = '$isbn'
    )
    AND active = 1
CODE;

$registers = $connexion->query($sentenceSQL);
if ($row = $registers->fetch_assoc()) {

    $needsBlock = $row['needsBlock'];
}

if($needsBlock){
    echo "block";
}else{
    echo "free";
}