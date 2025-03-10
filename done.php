<?PHP
session_start();
require_once 'google-logged.php';
require_once 'db.php';

$id=$conn->real_escape_string($_GET['id']);
$conn->query("UPDATE tasks SET status='DONE' where id=$id  and email='{$_SESSION['google_email']}'");

header('Location: index.php', true,302);
exit;