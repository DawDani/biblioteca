<?php
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
$id_user;
if(isset($_GET["id"])) {
    $id_user = $_GET["id"];
}
include ("datos_conexion.inc");
//connecting to BD
$connexion = new mysqli ($mysql_server,DB_USER,DB_PASS,"library_db");
if ($connexion->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    die();
}

$sentenceSQL="SELECT Name, Username, Email, Phone, Adress, City, Zip FROM `user` WHERE Id=".$id_user;
$registers = $connexion->query($sentenceSQL);
while ($row = $registers->fetch_assoc()){
    $nameUser= $row['Name'];
    $userNameUser=$row['Username'];
    $emailUser=$row['Email'];
    $phoneUser=$row['Phone'];
    $adressUser=$row['Adress'];
    $cityUser=$row['City'];
    $zipUser=$row['Zip'];
}


?>
<html>
<head>
    <?php include_once "partials/headData.html"; ?>
</head>
<body>
<div class="container" style="text-align: center;">
    <h1 >Modify a User</h1>
    <br/>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName" class="col-form-label">Name</label>
                <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name" required value="<?php echo $nameUser?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputUsername" class="col-form-label">Username</label>
                <input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="Username" required value="<?php echo $userNameUser?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required value="<?php echo $emailUser?>">
        </div>
        <div class="form-group">
            <label for="inputPhone" class="col-form-label">Phone number</label>
            <input type="number" class="form-control" id="inputPhone" name="inputPhone" required value="<?php echo $phoneUser?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAdress" class="col-form-label">Adress</label>
                <input type="text" class="form-control" id="inputAdress" name="inputAdress" required value="<?php echo $adressUser?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputCity" class="col-form-label">City</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity" required value="<?php echo $cityUser?>">
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip" class="col-form-label">Zip</label>
                <input type="text" class="form-control" id="inputZip" name="inputZip" required value="<?php echo $zipUser?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Admin level</label>
                <select class="form-control" id="inputAdmin" name="inputAdmin">
                    <option>0</option>
                    <option>1</option>
                    <option>2</option>
                </select>
                <p>0- Normal user  1- Librarian 2- Admin</p>
            </div>
        </div>
        <br/>
        <input type="submit" class="btn btn-success" id="apply" name="apply" value="Apply"/>

        <a role="button" class="btn btn-danger" href="manageUsers.php">Cancel</a>
    </form>

    <?php

        if(isset($_POST["apply"])){
            $name=$_POST['inputName'];
            $username=$_POST['inputUsername'];
            $adress=$_POST['inputAdress'];
            $city=$_POST['inputCity'];
            $zip=$_POST['inputZip'];
            $phone=$_POST['inputPhone'];
            $admin=$_POST['inputAdmin'];
            $email=$_POST['inputEmail'];
            $sentenceSQL="UPDATE user SET Name='".$name."',Username='".$username."',Adress='".$adress."',City='".$city."',Zip='".$zip."',Phone=".$phone.",Email='".$email."',Admin='".$admin."' where id=".$id_user;
            $registers = $connexion->query($sentenceSQL);
            header("Location: ManageUsers.php");
        }
    ?>
</div>
</body>
</html>
