<?php
$user = "";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
    session_destroy();
    session_unset();
    header("Location: index.php");
} else {
    $user = 'Hola ' . $_SESSION['name'];
    $admin= $_SESSION['admin'];
}
?>
<html>
<head>
    <title>Add copy</title>
    <?php include_once "partials/headData.html" ?>
</head>
<body>
<div class="container" style="text-align: center">
    <h1 >Add a copy</h1>
    </br>
    <form method="post">
        <input type="number" id="condition" name="condition" placeholder="Condition" />
        <input type="submit" class="btn btn-success" id="apply" name="apply" value="Create"/>
        </br>
        <a role="button" class="btn btn-danger" href="manageBooks.php">Cancel</a>
    </form>
    <?php
    $isbnBook;
    if(isset($_GET["isbn"])) {
        $isbnBook = $_GET["isbn"];
    }
    if(isset($_POST["apply"])){
        include ("datos_conexion.inc");
        //connecting to BD
        $connexion = new mysqli ($mysql_server,DB_USER,DB_PASS,"library_db");
        if ($connexion->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            die();
        }
        $sentenceSQL="INSERT INTO `copy` (`id`,`ISBN_FK`,`BookCondition`) VALUES (NULL,'".$isbnBook."',".$_POST["condition"].")";
        $registers = $connexion->query($sentenceSQL);
        header("Location: BookPage.php?isbn=".$isbnBook);
    }
    ?>
</div>
</body>
</html>
