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
<div class="float">
    <h1><a href="index.php" style="text-decoration: none;"><img alt="logo" src="img/logo.jpg" width=135/>Library</a></h1>
</div>

<!-- ---------------------------MENU ----------------------------------- -->
<ul class="nav justify-content-end">

    <?php
    if ($user == '') { //Si no esta loggeado, le permite hacer log in o registrarse
        echo <<<CODE
                <li class="nav-item">
                     <a class="nav-link active" href="logIn.php">Log In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
CODE;
    }elseif($admin==1) { //Si es admin lvl 1 (bibliotecario/a) solo puede gestionar libros
        echo <<<CODE
               <li class="nav-item">
                     <a class="nav-link active" href="logOut.php">Log Out</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="manageBooks.php">Manage Books</a>
                </li>
        
CODE;

    }elseif($admin==2) { //si es admin lvl 2 (admin) puede gestionar también a los usuarios
        echo <<<CODE
                
               <li class="nav-item">
                     <a class="nav-link active" href="logOut.php">Log Out</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="manageBooks.php">Manage Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manageUsers.php">Manage Users</a>
                </li>
                
CODE;

    }else{
        echo <<<CODE
            <li class="nav-item">
                <a class="nav-link active" href="logOut.php">Log Out</a>
            </li>
CODE;
    }

    ?>


    <li class="nav-item">
        <form class="form-inline" action="searchResult.php">
            <input type="text" class="form-control" name="search" placeholder="Search by title">
            <input type="submit" class="btn btn-primary" value="Search">
        </form>
    </li>
    <li class="nav-item">
        <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Categories
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="searchResult.php">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
    </li>
</ul>
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