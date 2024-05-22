<?php
    include('conectare_bazadate.php');
    $username= $_POST["username"];
    $password = $_POST["password"];
    $repetapassword = $_POST["repetapassword"];
    if(empty($username) || empty($password) || empty($repetapassword)){
        echo "Va rugam sa completati campurile goale";
    }
    else{
        $exista = "SELECT * FROM conectati WHERE user='$username'";
        $exista_test=mysqli_query($conect,$exista);
        if(mysqli_num_rows($exista_test)>0){
            echo "User ul exista deja";
        }
        else{
            if($password==$repetapassword){

                $query="INSERT INTO conectati (user,password) VALUES('$username','$password')";
                $query_test=mysqli_query($conect, $query);
                if($query_test){
                    echo "Utilizatorul a fost adaugat";
                    header("location: login.html");
                }
                else{
                    echo "Utilizatorul nu poate fi adaugat";
                }
            }
            else{
                echo "Parolele difera";
            }
        }
        
       
    }
   
?>