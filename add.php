<?PHP
session_start();
require_once 'db.php';

$conn->query("INSERT INTO tasks (task) VALUES ('".$_POST['todo']."')");
$conn->close();
$_SESSION['todolist'][]=['name'=> $_POST['todo'],'status'=> 'TODO'];
header('Location: index.php', true,302);
exit;
