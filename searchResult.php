<?php
require_once "./Table.php";
$user = "";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
    session_destroy();
    session_unset();
} else {
    $user = 'You are logged as ' . $_SESSION['name'];
    $admin = $_SESSION['admin'];
}
if (isset($_GET["search"])) {
    $searchTitle = $_GET["search"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    include_once "partials/headData.html";
    ?>
</head>
<body>
<?php
include_once "partials/headData.html";
?>
<h2>Search Result</h2>
<!-- --------------------------- TABLE ----------------------------------- -->
<br/>
<?php

// preparing variables to create my Table
$dbName = "library_db";
$tableName = "book";

// name of fields
$fields [] = "Title";
$fields [] = "ISBN";
$fields [] = "Editorial";
$fields [] = "Category";
$fields [] = "EditionYear";

// files where to jump to Browse, Edit, Delete the selected row.
// id given as GET in link is first given field.

$fileBrowse = "bookPage.php";
$fileUpdate = "";
$fileDelete = "";

$t = new Table($dbName, $tableName, $fields, $fileBrowse, $fileUpdate, $fileDelete, $searchTitle);
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
</body>
</html>