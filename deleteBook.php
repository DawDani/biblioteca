<?php
$user = "";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
    session_destroy();
    session_unset();
    header("Location: Index.php");
} else {
    $user = 'Hola ' . $_SESSION['name'];
    $admin= $_SESSION['admin'];
}
?>
<html>
    <head>
        <title>Delete Book</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="container" style="text-align: center">
    <h1 >Delete a book</h1>
        </br>
        <p>Are you sure to delete this book and its copies?</p>
        <form method="post">
            <input type="submit" class="btn btn-success" id="yes" name="yes" value="Yes"/>
            <a role="button" class="btn btn-danger" href="BookPage.php?isbn=<?php echo $_GET["isbn"]?>">No</a>
        </form>
        <?php

            if(isset($_GET["isbn"])) {
                $isbnBook = $_GET["isbn"];
            }
            if(isset($_POST["yes"])){
                include ("datos_conexion.inc");
                //connecting to BD
                $connexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,"library_db");
                if ($connexion->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                    die();
                }
                $sentenceSQL="DELETE from copy where ISBN_FK=".$isbnBook;
                $registers = $connexion->query($sentenceSQL);
                $sentenceSQL="DELETE from book where ISBN=".$isbnBook;
                $registers = $connexion->query($sentenceSQL);

                header("Location: Index.php");
            }
        ?>
    </div>
    </body>
</html>