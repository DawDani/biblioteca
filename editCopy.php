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
    <?php include_once "partials/headData.html"; ?>
</head>
<body>
<div class="container" style="text-align: center">
    <h1 >Modify a copy</h1>
    <br/>
    <form method="post">
        <input type="number" id="condition" name="condition" placeholder="Condition" />
        <input type="submit" class="btn btn-success" id="apply" name="apply" value="Apply"/>
        <br/>
        <a role="button" class="btn btn-danger" href="manageBooks.php">Cancel</a>
    </form>
    <?php
    $id_copy;
    if(isset($_GET["id"])) {
        $id_copy = $_GET["id"];
    }
    if(isset($_POST["apply"])){
        include ("datos_conexion.inc");
        //connecting to BD
        $connexion = new mysqli (DB_HOST,DB_USER,DB_PASS,"library_db");
        if ($connexion->connect_errno) {
            echo "Failed to connect to MySQL: " . $connexion->connect_error;
            die();
        }
        $sentenceSQL="UPDATE copy SET BookCondition=".$_POST["condition"]." where id=".$id_copy;
        $registers = $connexion->query($sentenceSQL);
        header("Location: ManageBooks.php");
    }
    ?>
</div>
</body>
</html>
