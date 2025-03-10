<?PHP
session_start();

if (!isset($_SESSION['google_loggedin'])) {
    header('Location: login.php');
    exit;
}

require_once 'db.php';

$id=$_GET['id'];

$conn->query("DELETE FROM tasks WHERE id='{$id}' and email='{$_SESSION['google_email']}'");

header('Location: index.php', true,302);
exit;