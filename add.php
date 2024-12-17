<?PHP
session_start();
$_SESSION['todolist'][]=['name'=> $_POST['todo'],'status'=> 'TODO'];
header('Location: index.php', true,302);
exit;
