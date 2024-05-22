<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Utilizator neconectat");
}

include('conectare_bazadate.php');

$zi = $_POST['zi'];
$luna = $_POST['luna'];
$an = $_POST['an'];
$inceput = $_POST['inceput'];
$sfarsit = $_POST['sfarsit'];
$eveniment = $_POST['nume'];
$user_id = $_SESSION['user_id'];

if (empty($zi) || empty($luna) || empty($an) || empty($inceput) || empty($sfarsit) || empty($eveniment)) {
    die("Introduceti toate datele");
}

$query = "SELECT * FROM evenimente WHERE zi='$zi' AND luna='$luna' AND an='$an' AND inceput='$inceput' AND sfarsit='$sfarsit' AND nume='$eveniment'";

$result = mysqli_query($conect, $query);

if (mysqli_num_rows($result) > 0) {
    $event = mysqli_fetch_assoc($result);
    $eveniment_id = $event['id'];

    $query_assoc = "DELETE FROM user_event WHERE id_user='$user_id' AND id_event='$eveniment_id'";
    if (mysqli_query($conect, $query_assoc)) {
        $query_delete = "DELETE FROM evenimente WHERE id='$eveniment_id'";
        if (mysqli_query($conect, $query_delete)) {
            echo "Eveniment sters cu succes";
        } else {
            echo "Eroare la stergerea evenimentului: " . mysqli_error($conect);
        }
    } else {
        echo "Eroare la stergerea asocierii: " . mysqli_error($conect);
    }
} else {
    echo "Evenimentul nu a fost gasit";
}
?>
