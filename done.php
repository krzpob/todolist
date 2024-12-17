<?PHP
session_start();
$_SESSION['todolist'][$_GET['id']]['status']='DONE';
header('Location: index.php', true,302);
exit;