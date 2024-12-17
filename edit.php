<?PHP 
session_start();

if($_GET!=null && $_GET['id']!=null){
    $id=$_GET['id'];
} else {
    $id=$_POST['id'];
    $_SESSION['todolist'][$id]['name']=$_POST['todo'];
    header('Location: index.php', true,302);
}

$task= $_SESSION['todolist'][$id]

?>
<!DOCTYPE html>
<html>
    
<body style="margin-left: 10%">
<h2>Edytuj zadanie</h2>
<form action="edit.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <span style="vertical-align: top;">Zadanie:</span>&nbsp;<textarea name="todo"><?= $task['name'] ?></textarea><br/>
    <span style="text-align: right;"><input type="button" value="Anuluj" onclick="location.href='/todolist'" />&nbsp;<input type="submit" /></span>
</form>
</div>
</body>