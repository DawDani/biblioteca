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
    <h1 >Modify a reservation</h1>
        <br/>
        <p>Are you sure activate / deactivate this reservation?</p>
        <form method="post">
            <input type="submit" class="btn btn-success" id="yes" name="yes" value="Yes"/>
            <a role="button" class="btn btn-danger" href="manageReservations.php">No</a>
        </form>
        <?php
            if(isset($_GET["id"])) {
                $id_copy = $_GET["id"];
            }
            if(isset($_POST["yes"])){
                include ("datos_conexion.inc");
                //connecting to BD
                $connexion = new mysqli (DB_HOST,DB_USER,DB_PASS,"library_db");
                if ($connexion->connect_errno) {
                    echo "Failed to connect to MySQL: " . $connexion->connect_error;
                    die();
                }
                $sentenceSQL="Update reserved_copy set active = not active where Id=".$id_copy;
                $registers = $connexion->query($sentenceSQL);
                header("Location: manageReservations.php");
            }
        ?>
    </div>
    </body>
</html>
