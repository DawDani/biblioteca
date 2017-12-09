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

if ($_SESSION['admin'] === "0" || $_SESSION['admin'] === "1") {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once "partials/headData.html"; ?>
</head>
<body>
<?php
include_once "partials/header.php";
?>
<br/>
<br/>
<div>
    <h2 style="text-align: center;">Manage Users</h2>
    <br/>
    <?php
    // preparing variables to create my Table
    $dbName = "library_db";
    $tableName = "user";

    // name of fields
    $fields [] = "Id";
    $fields [] = "Username";
    $fields [] = "Email";
    $fields [] = "Admin";

    // files where to jump to Browse, Edit, Delete the selected row.
    // id given as GET in link is first given field.
    //$fileBrowse = "browse.php";
    $fileBrowse = "";
    $fileUpdate = "editUser.php";
    $fileDelete = "deleteUser.php";

    $t = new Table($dbName, $tableName, $fields, $fileBrowse, $fileUpdate, $fileDelete);
    $t->paintTable();

    // ------------------------------------------------------------------------------------
    ?>
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