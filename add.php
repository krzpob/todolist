<?PHP
session_start();
$_SESSION['todolist'][]=$_POST['todo'];
header('Location: index.php', true,302);
exit;
