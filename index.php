<?PHP
session_start();

?>

<!DOCTYPE html>
<html>
<body>
    <style >
        thead {
            font-weight: bold;
        }
        table, th, td {
            border: 1px solid;
        }

        table {
            border-collapse: collapse;
        }
    </style>
<h2>
    Lista zadań do zrobienia
</h2>
<a href="add.html">Dodaj zadanie</a>

<table>
    <thead><tr><td>Id</td><td>Zadanie</td><td>Akcja</td></tr></thead>
    <tbody>
    <?php
    foreach($_SESSION['todolist'] as $id => $todo){
        echo "<tr><td>$id</td><td>$todo</td><td><a href=\"delete.php?id=$id\">Usuń</a></td></tr>";
    }
    ?>
    </tbody>
</table>

</body>
