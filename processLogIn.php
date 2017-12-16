<!-- PHP -->
<?php
    include ("datos_conexion.inc");
    //connecting to BD
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, "library_db");
    if ($connection->connect_errno) {
        echo "Failed to connect to MySQL: " . $connection->connect_error;
        die();
    }

    $FormEmail = $_POST['InputEmail1'];
    $FormPass = $_POST['InputPassword1'];
    $SentenceSQL= "SELECT Password,Id,Name,Admin FROM user WHERE Email = '" . $FormEmail . "' ;";
    $registers = $connection->query($SentenceSQL);
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
            $_SESSION['id']=$UserId;
            header("Location: index.php");
        }else{
            header("Location: logIn.php");
        }
    }else{
        header("Location: logIn.php");
    }


?>