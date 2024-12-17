<?PHP
session_start();

if($_SESSION!=null && $_SESSION['todolist']==null) {
    $_SESSION['todolist'] = [];
}


?>

<!DOCTYPE html>
<html>
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

        .id {
            width: 3em;
            margin: 10px 10px;
        }

        .task-name {
            width: 10em;
            margin: 10px 10px;
        }
    </style>
<body style="margin-left: 10%">
    
<h2>
    Lista zadań do zrobienia
</h2>
<a href="add.html">Dodaj zadanie</a>
    </br></br>
<table>
    <thead><tr><td class="id">Id</td><td classs="task-name">Zadanie</td><td>Status</td><td>Akcja</td></tr></thead>
    <tbody>
    <?php
    foreach($_SESSION['todolist'] as $id => $todo){
        echo "<tr><td class='id'>$id</td><td class='task-name'>{$todo['name']}</td><td>{$todo['status']}</td><td>
        <a href=\"delete.php?id=$id\">Usuń</a>&nbsp
        <a href=\"edit.php?id=$id\">Edycja</a>";
        if($todo['status']!='DONE'){ echo "<a href=\"done.php?id=$id\">Zrobione</a> "; }
        echo "</td></tr>";
    }
    ?>
    </tbody>
</table>

</body>
