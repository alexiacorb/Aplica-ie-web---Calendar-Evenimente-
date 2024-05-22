<?php
    session_start();

    include('conectare_bazadate.php');


    $username=$_POST['username'];
    $password=$_POST['password'];

    if(empty($username) || empty($password)){
        echo "Introduceti datele";
    }
    else{
        $query="SELECT * FROM conectati WHERE user='$username' and password='$password'";
        $query_test=mysqli_query($conect,$query);

        if(mysqli_num_rows($query_test)>0){
            $user = mysqli_fetch_assoc($query_test);
            $_SESSION['user_id'] = $user['id'];
            echo "Conecatare reusita";
            header("location: Home.html");
        }
        else{
            echo "Parola sau utilizator incorect";
        }
    }
    
?>