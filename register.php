<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
    session_destroy();
    session_unset();

} else {
    header("Location: index.php");
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
            <h1>Create your new account</h1>
            <form method="post" action="processRegister.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputName" class="col-form-label">Name</label>
                  <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputUsername" class="col-form-label">Username</label>
                  <input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="Username" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputPassword" class="col-form-label">Password</label>
                  <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword2" class="col-form-label">Password again</label>
                  <input type="password" class="form-control" id="inputPassword2" name="inputPassword2" placeholder="Password again" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required>
              </div>
              <div class="form-group">
                <label for="inputPhone" class="col-form-label">Phone number</label>
                <input type="number" class="form-control" id="inputPhone" name="inputPhone" required>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputAdress" class="col-form-label">Adress</label>
                  <input type="text" class="form-control" id="inputAdress" name="inputAdress" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputCity" class="col-form-label">City</label>
                    <input type="text" class="form-control" id="inputCity" name="inputCity" required>
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip" class="col-form-label">Zip</label>
                  <input type="text" class="form-control" id="inputZip" name="inputZip">
                </div>
              </div>
              <br/>
              <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
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