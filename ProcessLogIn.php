<!-- PHP -->
<?php
    include ("datos_conexion.inc");
    //connecting to BD
    $connexion = new mysqli ($mysql_server,$mysql_login,$mysql_pass,"library_db");
    if ($connexion->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        die();
    }

    $FormEmail = $_POST['InputEmail1'];
    $FormPass = $_POST['InputPassword1'];
    $SentenceSQL= "SELECT Password,Id,Name,Admin FROM user WHERE Email = '" . $FormEmail . "' ;";
    $registers = $connexion->query($SentenceSQL);
    // painting header and showing results

    //Makes the login 
    if ($row = $registers->fetch_assoc()){
        $UserPass=$row['Password'];
        $UserName=$row['Name'];
        $UserId= $row ['Id'] ;
        $UserAdmin=$row['Admin'];
        if(strcmp($FormPass,$UserPass)== 0){
            session_start();
            $_SESSION['name']=$UserName;
            $_SESSION['admin']=$UserAdmin;
            header("Location: Index.php");
        }else{
            header("Location: LogIn.php");
        }
    }else{
        header("Location: LogIn.php");
    }


?>