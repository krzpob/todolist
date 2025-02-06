<?PHP
session_start();
require_once 'db.php';

$id=$_GET['id'];

$conn->query("DELETE FROM tasks WHERE id='{$id}'");

header('Location: index.php', true,302);
exit;