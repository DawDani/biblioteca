<?php
$user = "";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
    session_destroy();
    session_unset();
} else {
    $user = 'Hola ' . $_SESSION['name'];
    $admin = $_SESSION['admin'];
}

include("datos_conexion.inc");
//connecting to BD
$connexion = new mysqli ($mysql_server, DB_USER, DB_PASS, "library_db");
$connexion->set_charset('UTF8');
if ($connexion->connect_errno) {
    echo "Failed to connect to MySQL: " . $connexion->connect_error;
    die();
}

if (isset($_GET["isbn"])) {
    $isbn = $_GET["isbn"];
}
$sentenceSQL = "SELECT Title,Editorial,Description,Category,ISBN,Cover FROM `book` WHERE ISBN=" . $isbn;
$registers = $connexion->query($sentenceSQL);
if ($row = $registers->fetch_assoc()) {
    $titleBook = $row['Title'];
    $editorialBook = $row['Editorial'];
    $descriptionBook = $row['Description'];
    $categoryBook = $row['Category'];
    $isbnBook = $row['ISBN'];
    $coverBook = $row['Cover'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <?php include_once "partials/headData.html"; ?>

</head>
<body>
<?php include_once "partials/header.php" ?>
<div class="container" id="app">
    <br/>
    <h2><?php echo $titleBook ?></h2>
    <br/>
    <img alt="book" src="img/covers/<?php echo $coverBook ?>" width="300px"/>
    <br/>
    <br/>

    <p>Description: </p>
    <p><?php echo $descriptionBook ?></p>

    <p>Category: <?php echo $categoryBook ?></p>

    <!-- Button trigger modal -->

    <?php
    if ($user === "") {
        echo <<<CODE
                 <a class="btn btn-primary" href="logIn.php">
                  Log in to reserve a book
                </a>
CODE;

    } elseif ($admin == 1 | $admin == 2) {
        echo <<<CODE
                     <div>
                        <a href="editBook.php?isbn=$isbnBook"> <img alt="edit book icon" src="img/edit-icon.png" width="60"/></a>
                        <a href="addCopy.php?isbn=$isbnBook"><img alt="add new copy" src="img/add_blue.png" width="70" /></a>
                        <a href="deleteBook.php?isbn=$isbnBook"><img alt="delete icon" src="img/remove_icon.png" width="70"/></a>
                    </div>
CODE;
    }
    if (!empty($user)) {
        echo <<<CODE
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookingModal">
                    Reserve Book
                </button>

CODE;
    }
    ?>

    <!-- Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog">
        <booking-modal :lock-days="20"
                       :isbn="'<?php echo $isbn ?>'"
        >
        </booking-modal>
    </div>
    <br/>
    <br/>
    <a href="index.php">Home Page</a>

</div>
<br/>
<br/>
<hr/>
<footer>
    <p>Made by: Daniel Muñoz</p>
    <p>Contact information: dawdani17@gmail.com .</p>
</footer>
</body>
</html>