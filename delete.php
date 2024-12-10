<?PHP
session_start();
$id=$_GET['id'];
unset($_SESSION['todolist'][$id]) ;
header('Location: index.php', true,302);
exit;