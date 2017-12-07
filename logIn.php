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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <?php include_once "partials/headData.html"; ?>
</head>
<body>
<div class="container">
    <h1>Log into your account</h1>
    <br/>
    <form action="processLogIn.php" method="post">
        <div class="form-group">
            <label for="InputEmail1">Email address</label>
            <input type="email" class="form-control" id="InputEmail1" name="InputEmail1" aria-describedby="emailHelp" placeholder="Enter email"
                   required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="InputPassword1">Password</label>
            <input type="password" class="form-control" id="InputPassword1" name="InputPassword1" placeholder="Password" required>
        </div>
        <div id="error"></div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br/>
    <a href="index.php">Home Page</a>
    <br/>
    <br/>
    <a href="register.php">Create new account</a>
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