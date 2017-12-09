<?php
require_once "./TableIndex.php";
$user = "";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
    session_destroy();
    session_unset();
} else {
    $user = 'You are logged as ' . $_SESSION['name'];
    $admin= $_SESSION['admin'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <?php include_once "partials/headData.html"; ?>
</head>
<!-- --------------------------- BODY ----------------------------------- -->
<body>
<!-- --------------------------- HEADER ----------------------------------- -->
    <?php include_once "partials/header.php"; ?>
<!-- --------------------------- TABLA ----------------------------------- -->
<div class="container">
    <?php
    echo "<p>".$user."</p>";
    ?>
    <h2>Books available</h2>

            <?php
            // preparing variables to create my Table
            $dbName = "library_db";
            $tableName = "book";

            // name of fields
            $fields []= "ISBN";
            $fields [] = "Title";
            $fields [] = "Cover";

            // files where to jump to Browse, Edit, Delete the selected row.
            // id given as GET in link is first given field.
            //$fileBrowse = "browse.php";
            $fileBrowse = "";
            $fileUpdate = "";
            $fileDelete = "asd";

            $t = new Table($dbName, $tableName, $fields, $fileBrowse, $fileUpdate, $fileDelete);
            $t->paintTable();

            // ------------------------------------------------------------------------------------
            ?>
            <br>
            <!-- --------------------------- FOOTER ----------------------------------- -->
            <hr/>
            <footer>
                <p>Made by: Daniel Muñoz</p>
                <p>Contact information: dawdani17@gmail.com .</p>
            </footer>

</div>
</body>
</html>