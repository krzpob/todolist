<?PHP
session_start();
require_once 'db.php';

$id=$conn->real_escape_string($_GET['id']);
$conn->query("UPDATE tasks SET status='DONE' where id=$id");
$_SESSION['todolist'][$_GET['id']]['status']='DONE';
header('Location: index.php', true,302);
exit;