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
    <h1>Add a new Book to the library</h1>
    <form enctype="multipart/form-data" action="newBook.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-control-label" for="formGroupExampleInput">Book's title</label>
                <input type="text" class="form-control" id="formTitle" name="formTitle" required="required">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-control-label" for="formGroupExampleInput">ISBN</label>
                <input type="text" class="form-control" id="formISBN" name="formISBN" required="required">
            </div>
        </div>
        <div class="form-group">
            <label class="form-control-label" for="formGroupExampleInput">Editorial</label>
            <input type="text" class="form-control" id="formEditorial" name="formEditorial" required="required">
        </div>
        <div class="form-group">
            <label class="form-control-label" for="formGroupExampleInput">Edition Year</label>
            <input type="number" class="form-control" id="formYear" name="formYear" required="required" min="0" max="9999">
        </div>
        <div class="form-group">
            <label class="form-control-label" for="formGroupExampleInput">Author</label>
            <input type="text" class="form-control" id="formAuthor" name="formAuthor" required="required">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Category</label>
            <select class="form-control" id="formCategory" name="formCategory" required="required">
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
            <textarea class="form-control" id="formDesc" name="formDesc" rows="3" required="required"></textarea>
        </div>

        <div class="form-group">
            <input type="file" id="formCover" name="formCover" >
        </div>
        <input type="submit" id="submit" name="submit" value="Add book" class="btn btn-success"/>
    </form>



    <br/>
    <a href="manageBooks.php">Go back</a>
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