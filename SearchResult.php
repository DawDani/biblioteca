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
    $admin= $_SESSION['admin'];
}
if(isset($_GET["search"])) {
    $searchTitle = $_GET["search"];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Biblioteca Index</title>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </head>
    <body>
         <!-- --------------------------- BODY ----------------------------------- --> 
        <div>
            <h1><a href="Index.php" style="text-decoration: none;"><img alt="logo" src="img/logo.jpg" width=135/>Library</a></h1>
        </div>

        
 <!-- --------------------------- MENU ----------------------------------- -->
         <ul class="nav justify-content-end">

             <?php
    if ($user == '') { //Si no esta loggeado, le permite hacer log in o registrarse
        echo <<<CODE
                <li class="nav-item">
             <a class="nav-link active" href="LogIn.php">Log In</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="Register.php">Register</a>
             </li>
CODE;
             }elseif($admin==1) { //Si es admin lvl 1 (bibliotecario/a) solo puede gestionar libros
             echo <<<CODE
             <li class="nav-item">
                 <a class="nav-link active" href="LogOut.php">Log Out</a>
             </li>

             <li class="nav-item">
                 <a class="nav-link" href="./ManageBooks.php">Manage Books</a>
             </li>

CODE;

             }elseif($admin==2) { //si es admin lvl 2 (admin) puede gestionar también a los usuarios
             echo <<<CODE

             <li class="nav-item">
                 <a class="nav-link active" href="LogOut.php">Log Out</a>
             </li>

             <li class="nav-item">
                 <a class="nav-link" href="./ManageBooks.php">Manage Books</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="./ManageUsers.php">Manage Users</a>
             </li>

CODE;

             }else{
             echo <<<CODE
             <li class="nav-item">
                 <a class="nav-link active" href="LogOut.php">Log Out</a>
             </li>
CODE;
             }

             ?>


             <li class="nav-item">
                 <form class="form-inline" action="./SearchResult.php">
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
                         <a class="dropdown-item" href="./SearchResult.html">Action</a>
                         <a class="dropdown-item" href="#">Another action</a>
                         <a class="dropdown-item" href="#">Something else here</a>
                     </div>
                 </div>
             </li>
         </ul>
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

         $fileBrowse = "BookPage.php";
         $fileUpdate = "";
         $fileDelete = "";

         $t = new Table($dbName, $tableName, $fields, $fileBrowse, $fileUpdate, $fileDelete,$searchTitle);
         $t->paintTable();

         // ------------------------------------------------------------------------------------
         ?>
            

            <br/>
            <br/>
            <a href="Index.php">Home Page</a>
        
        
        <br/>
        <br/>
        <hr/>
        <footer>
            <p>Made by: Daniel Muñoz</p>
            <p>Contact information: dawdani17@gmail.com .</p>
        </footer>
    </body>
</html>