<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Utilizator neconectat");
}

include('conectare_bazadate.php');

$zi = $_POST['zi'];
$luna = $_POST['luna'];
$an = $_POST['an'];
$inceput = $_POST['inceput'] ;
$sfarsit = $_POST['sfarsit'] ;
$eveniment = $_POST['nume'] ;
$user_id = $_SESSION['user_id'];

if (empty($zi) || empty($luna) || empty($an) || empty($inceput) || empty($sfarsit) || empty($eveniment)) {
    die("Introduceti toate datele");
}

$query = "INSERT INTO evenimente (zi, luna, an, inceput, sfarsit, nume) VALUES ('$zi', '$luna', '$an', '$inceput', '$sfarsit', '$eveniment')";

if (mysqli_query($conect, $query)) {
    $eveniment_id = mysqli_insert_id($conect);

    $query_assoc = "INSERT INTO user_event (id_user, id_event) VALUES ('$user_id', '$eveniment_id')";
    if (mysqli_query($conect, $query_assoc)) {
        echo "Eveniment adaugat si asociat cu succes";
    } else {
        echo "Eroare la asocierea evenimentului: " . mysqli_error($conect);
    }

    
} else {
    echo "Eroare la adaugarea evenimentului: " . mysqli_error($conect);
}
?>
