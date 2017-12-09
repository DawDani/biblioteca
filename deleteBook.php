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
        <?php include_once "/partials/headData.html"; ?>
    </head>
    <body>
    <div class="container" style="text-align: center">
    <h1 >Delete a book</h1>
        <br>
        <p>Are you sure to delete this book and its copies?</p>
        <form method="post">
            <input type="submit" class="btn btn-success" id="yes" name="yes" value="Yes"/>
            <a role="button" class="btn btn-danger" href="bookPage.php?isbn=<?= $_GET['isbn'] ?>">No</a>
        </form>
        <?php
            if(isset($_GET["isbn"])) {
                $isbnBook = $_GET["isbn"];
            }
            if(isset($_POST["yes"])){
                include ("datos_conexion.inc");
                //connecting to BD
                $connexion = new mysqli (DB_HOST,DB_USER,DB_PASS,"library_db");
                if ($connexion->connect_errno) {
                    echo "Failed to connect to MySQL: " . $connexion->connect_error;
                    die();
                }
                $sentenceSQL="DELETE from copy where ISBN_FK=".$isbnBook;
                $registers = $connexion->query($sentenceSQL);
                $sentenceSQL="DELETE from book where ISBN=".$isbnBook;
                $registers = $connexion->query($sentenceSQL);

                header("Location: /index.php");
            }
        ?>
    </div>
    </body>
</html>
