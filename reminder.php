<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Utilizator neconectat");
}
include('conectare_bazadate.php');

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM evenimente WHERE id IN (SELECT id_event FROM `user_event` WHERE id_user = '$user_id')";

$result = mysqli_query($conect, $query);

if (!$result) {
    die("Eroare la executarea interogării: " . mysqli_error($conect));
}
if (mysqli_num_rows($result) > 0) {
    echo "<table id='tabel' border='1'>
            <tr>
                <th>Zi</th>
                <th>Luna</th>
                <th>An</th>
                <th>Inceput</th>
                <th>Sfarsit</th>
                <th>Nume</th>
            </tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . htmlspecialchars($row['zi']) . "</td>
                <td>" . htmlspecialchars($row['luna']) . "</td>
                <td>" . htmlspecialchars($row['an']) . "</td>
                <td>" . htmlspecialchars($row['inceput']) . "</td>
                <td>" . htmlspecialchars($row['sfarsit']) . "</td>
                <td>" . htmlspecialchars($row['nume']) . "</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "Nu există evenimente.";
}

mysqli_close($conect);
?>
