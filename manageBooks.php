<?php
require_once "./Table.php";
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
    $admin = $_SESSION['admin'];
}
if ($_SESSION['admin'] === "0") {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once "partials/headData.html"; ?>
</head>
<body>
<?php include_once "partials/header.php"; ?>
<br/>
<br/>
<div>
    <h2 style="text-align: center;">Manage Books</h2>
    <br/>
    <?php
    // preparing variables to create my Table
    $dbName = "library_db";
    $tableName = "copy, book";

    // name of fields
    $fields [] = "id";
    $fields [] = "ISBN";
    $fields [] = "Title";
    $fields [] = "BookCondition";

    // files where to jump to Browse, Edit, Delete the selected row.
    // id given as GET in link is first given field.

    $fileBrowse = "bookPage.php";
    $fileUpdate = "editCopy.php";
    $fileDelete = "deleteCopy.php";

    $t = new Table($dbName, $tableName, $fields, $fileBrowse, $fileUpdate, $fileDelete);
    $t->paintTable();

    // ------------------------------------------------------------------------------------
    ?>
    <div>
        <a href="newBookForm.php"> <img alt="new_book_icon" src="img/new_book_icon.png" width="60px"/></a>
    </div>
    <br/>
    <br/>
    <a href="index.php">Home Page</a>
    <br/>
    <br/>
    <hr/>
    <footer>
        <p>Made by: Daniel Muñoz</p>
        <p>Contact information: dawdani17@gmail.com .</p>
    </footer>
</div>

</body>
</html>