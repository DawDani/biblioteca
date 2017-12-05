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
    $admin= $_SESSION['admin'];
}

include ("datos_conexion.inc");
//connecting to BD
$connexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,"library_db");
$connexion->set_charset('UTF8');
if ($connexion->connect_errno) {
    echo "Failed to connect to MySQL: " . $connexion->connect_error;
    die();
}

if(isset($_GET["isbn"])) {
    $isbn = $_GET["isbn"];
}
$sentenceSQL="SELECT Title,Editorial,Description,Category,ISBN,Cover FROM `book` WHERE ISBN=".$isbn;
$registers = $connexion->query($sentenceSQL);
while ($row = $registers->fetch_assoc()){
    $titleBook= $row['Title'];
    $editorialBook=$row['Editorial'];
    $descriptionBook=$row['Description'];
    $categoryBook=$row['Category'];
    $isbnBook=$row['ISBN'];
    $coverBook=$row['Cover'];
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
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    </head>
    <body>
         <!-- --------------------------- BODY ----------------------------------- --> 
        <div >
            <h1><a href="Index.php" style="text-decoration: none;"><img alt="logo" src="img/logo.jpg" width=135/>Library</a></h1>
        </div>
        
 <!-- --------------------------- MENU ----------------------------------- -->       
        <ul class="nav justify-content-end">
            <?php
            if ($user == '') {
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
            }elseif($admin==2){
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
                <form class="form-inline" action="SearchResult.php">
                    <input type="text" class="form-control" name="search" placeholder="Search by title">
                    <input type="submit" class= "btn btn-primary" value="Search">
                </form>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="SearchResult.php">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>             
              </li>
        </ul>  
 <!-- --------------------------- BOOK PAGE ----------------------------------- -->     
        
        <div class ="container">
            <br/>
            <h2><?php echo $titleBook ?></h2>
            <br/>
            <img alt="book" src="img/covers/<?php echo $coverBook ?>" width="300px" />
            <br/>
            <br/>

            <p>Description:  </p>
                <p><?php echo $descriptionBook ?></p>
          
            <p>Category: <?php echo $categoryBook ?></p>

            <!-- Button trigger modal -->

        <?php
            if($user===""){
                echo <<<CODE
                 <a class="btn btn-primary" href="LogIn.php">
                  Log in to reserve a book
                </a>
CODE;

            }elseif($admin==1 | $admin==2){
                echo <<<CODE
                     <div>
                        <a href="editBook.php?isbn=$isbnBook"> <img alt="edit book icon" src="img/edit-icon.png" width="60"/></a>
                        <a href="addCopy.php?isbn=$isbnBook"><img alt="add new copy" src="img/add_blue.png" width="70" /></a>
                        <a href="deleteBook.php?isbn=$isbnBook"><img alt="delete icon" src="img/remove_icon.png" width="70"/></a>
                    </div>
CODE;
            }
            if(!empty($user)){
                echo <<<CODE
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Reserve Book
                </button>
CODE;
            }
        ?>

            <br/>
            <br/>
            <a href="Index.php">Home Page</a>

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