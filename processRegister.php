<!-- PHP -->
<?php
    include ("datos_conexion.inc");
    //connecting to BD
    $connexion = new mysqli ($mysql_server,DB_USER,DB_PASS,"library_db");
    if ($connexion->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        die();
    }
    $name=$_POST['inputName'];
    $username=$_POST['inputUsername'];
    $password=$_POST['inputPassword'];
    $password2=$_POST['inputPassword2'];
    $adress=$_POST['inputAdress'];
    $city=$_POST['inputCity'];
    $zip=$_POST['inputZip'];
    $phone=$_POST['inputPhone'];
//  $admin=0;
    $email=$_POST['inputEmail'];

    $SentenceSQL= "INSERT INTO user (`Id`,`Name`,`Username`,`Password`,`Adress`,`City`,`Zip`,`Phone`,`Admin`,`Email`) VALUES (NULL, '".$name."','".$username."','".$password."','".$adress."','".$city."','".$zip."',".$phone.",0,'".$email."')";
    if($password===$password2){
        $registers = $connexion->query($SentenceSQL);
        //Makes the register
        header("Location: index.php");
    }else{
        echo "WRONG";
    }

?>