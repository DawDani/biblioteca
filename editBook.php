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
    $admin= $_SESSION['admin'];
}
if(isset($_GET["isbn"]) & !empty($_GET["isbn"])) {
    $isbn = $_GET["isbn"];
}else{
    header("Location: index.php");
}

include ("datos_conexion.inc");
//connecting to BD
$connexion = new mysqli ($mysql_server,DB_USER,DB_PASS,"library_db");
$connexion->set_charset('UTF8');
if ($connexion->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    die();
}

$sentenceSQL="SELECT ISBN, Title,Editorial,Description,Category,EditionYear,Cover,Author FROM `book` WHERE ISBN=".$isbn;
$registers = $connexion->query($sentenceSQL);
while ($row = $registers->fetch_assoc()){
    $isbnBook=$row['ISBN'];
    $titleBook= $row['Title'];
    $editorialBook=$row['Editorial'];
    $descriptionBook=$row['Description'];
    $categoryBook=$row['Category'];
    $editionYearBook=$row['EditionYear'];
    $coverBook=$row['Cover'];
    $authorBook=$row['Author'];

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
<div class="container">
    <h1>Edit book</h1>
    <form enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-control-label" for="formGroupExampleInput">Book's title</label>
                <input type="text" class="form-control" id="formTitle" name="formTitle" required="required" value="<?php echo $titleBook ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-control-label" for="formGroupExampleInput">ISBN</label>
                <input type="text" class="form-control" id="formISBN" name="formISBN" required="required"  value="<?php echo $isbnBook ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="form-control-label" for="formGroupExampleInput">Editorial</label>
            <input type="text" class="form-control" id="formEditorial" name="formEditorial" required="required"  value="<?php echo $editorialBook ?>">
        </div>
        <div class="form-group">
            <label class="form-control-label" for="formGroupExampleInput">Edition Year</label>
            <input type="number" class="form-control" id="formYear" name="formYear" required="required" min="0" max="9999"  value="<?php echo $editionYearBook ?>">
        </div>
        <div class="form-group">
            <label class="form-control-label" for="formGroupExampleInput">Author</label>
            <input type="text" class="form-control" id="formAuthor" name="formAuthor" required="required"  value="<?php echo $authorBook ?>">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Category</label>
            <select class="form-control" id="formCategory" name="formCategory" required="required">
                <option selected="selected"><?php echo $categoryBook ?></option>
                <option>Science fiction</option>
                <option>Drama</option>
                <option>Romance</option>
                <option>Mystery</option>
                <option>Horror</option>
                <option>Children's</option>
                <option>Science</option>
                <option>Poetry</option>
                <option>Comics</option>
                <option>Fantasy</option>
                <option>Art</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Book's description</label>
            <textarea class="form-control" id="formDesc" name="formDesc" rows="12" required="required" > <?php echo $descriptionBook ?></textarea>
        </div>

        <div class="form-group">
            <label for="exampleFormControlFile1">Choose the cover</label>
            <input type="file" class="form-control-file" id="formCover" name="formCover" >
        </div>
        <input type="submit" id="submit" name="submit" value="Edit book" class="btn btn-success"/>
    </form>

    <?php

    if(isset($_POST["submit"])){
        $title=$_POST['formTitle'];
        $isbnew=$_POST['formISBN'];
        $editorial=$_POST['formEditorial'];
        $editionYear=$_POST['formYear'];
        $author=$_POST['formAuthor'];
        $category=$_POST['formCategory'];
        $description=$_POST['formDesc'];
        $tmp=$_FILES["formCover"]['tmp_name'];
        $nameCover=$_FILES['formCover']['name'];
        $author=$_POST["formAuthor"];
        $destino="img/covers/".$nameCover;
        move_uploaded_file($tmp, $destino);
        if(empty($_FILES['formCover']['name'])){
            $sentenceSQL="UPDATE book SET ISBN='".$isbnew."', Title='".$title."', Editorial='".$editorial."', Description='".$description."', Category='".$category."', EditionYear=".$editionYear.", Author='".$author."' where ISBN=".$isbn;
        }else {
            $sentenceSQL = "UPDATE book SET ISBN='" . $isbnew . "', Title='" . $title . "', Editorial='" . $editorial . "', Description='" . $description . "', Category='" . $category . "', EditionYear=" . $editionYear . ",Cover='" . $nameCover . "',  Author='" . $author . "' where ISBN=" . $isbn;
        }
        $registers = $connexion->query($sentenceSQL);
        echo "<script> location.href='bookPage.php?isbn=$isbn'</script>";
    }
    ?>
    <br/>
    <a href="bookPage.php?isbn=<?php echo $isbn?>">Go back</a>
    <br/>
    <br/>

    <!-- FOOOOOOOOOOOOOOOOTER -->
    <hr/>
    <footer>
        <p>Made by: Daniel Muñoz</p>
        <p>Contact information: dawdani17@gmail.com .</p>
    </footer>
</div>
</body>
</html>