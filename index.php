<?PHP
session_start();

if (!isset($_SESSION['google_loggedin'])) {
    header('Location: login.php');
    exit;
}

require_once 'db.php';
$google_loggedin = $_SESSION['google_loggedin'];
$google_email = $_SESSION['google_email'];

$todolist=$conn->query("SELECT * FROM tasks WHERE email='$google_email' ORDER BY id");


?>

<!DOCTYPE html>
<html>
 <?php 
      require_once 'bootstrap-init.php';  
 ?>   
<style >
        
    </style>
    <link href="mystyle.css" rel="stylesheet">
<body style="margin-left: 10%">
<header>
        <a href="logout.php">Wyloguj się</a> 
</header>
<h2>
    Lista zadań do zrobienia dla (<?php echo $google_email ?>)
</h2>
<a href="add.html">Dodaj zadanie</a>
    </br></br>
    <div class="conatiner ">
        <div class="row">
            <div class="col-8">
            <table class="table table-success table-striped">
    <thead><tr><th class="id" scope="col">Id</th><th classs="task-name" scope="col">Zadanie</th><th scope="col">Status</th><th scope="col">Akcja</th></tr></thead>
    <tbody>
    <?php
    foreach($todolist as $id => $todo){
        echo "<tr><th class='id' scope='row'>{$todo['id']}</th><td class='task-name'>{$todo['task']}</td><td>{$todo['status']}</td><td>
        <a href=\"delete.php?id={$todo['id']}\">Usuń</a>&nbsp
        <a href=\"edit.php?id={$todo['id']}\">Edycja</a>";
        if($todo['status']!='DONE'){ echo "<a href=\"done.php?id={$todo['id']}\">Zrobione</a> "; }
        echo "</td></tr>";
    }
    ?>
    </tbody>
</table>

            </div>
        </div>
    </div>

<?php 
      require_once 'bootstrap-js.php';  
 ?>   
</body>


<?php
$todolist->free_result();
$conn->close();