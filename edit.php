<?PHP 
session_start();

require_once 'google-logged.php';

require_once 'db.php';

if($_GET!=null && $_GET['id']!=null){
    $id=$conn->real_escape_string($_GET['id']);
} else {
    $id=$conn->real_escape_string($_POST['id']);
    $todo=$conn->real_escape_string($_POST['todo']);
    $conn->query("UPDATE tasks SET task='$todo'");
    header('Location: index.php', true,302);
}

$result = $conn->query("SELECT * FROM tasks WHERE id='{$id}' and email='{$_SESSION['google_email']}'");
$task = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<?php 
      require_once 'bootstrap-init.php';  
 ?>       
<body style="margin-left: 10%">
<header>
        <a href="logout.php">Wyloguj się</a> 
</header>
<h2>Edytuj zadanie</h2>
<form action="edit.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <span style="vertical-align: top;">Zadanie:</span>&nbsp;<textarea name="todo"><?= $task['task'] ?></textarea><br/>
    <span style="text-align: right;"><input type="button" value="Anuluj" onclick="location.href='/todolist'" />&nbsp;<input type="submit" /></span>
</form>
</div>
<?php 
      require_once 'bootstrap-js.php';  
 ?>   
</body>
</html>
<?php
$result->free_result();
$conn->close();