<?php
$LIMITE="20"; // numero días permitido que dure la reserva
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


$sentenceSQL = <<<CODE
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

$dateReserved=$_POST['reservationDay'];
$dateReservedEnd=(new \DateTime($dateReserved))->add(new DateInterval('P'.$LIMITE.'D'))->format('Y-m-d');
$userThatReserved=$_SESSION['id'];

$sentenceSQL = <<<CODE
INSERT INTO reserved_copy VALUES
(NULL,
(SELECT c.id
        FROM copy c
        WHERE ISBN_FK = $isbn
        AND id NOT IN ( SELECT r.CopyId
                        FROM reserved_copy r
                        WHERE active = 1)
        ORDER BY c.BookCondition DESC LIMIT 1
)
, '$dateReserved'
, NULL
, '$dateReservedEnd'
, $userThatReserved
, 1
)
CODE;
echo $sentenceSQL;
