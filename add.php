<?PHP
session_start();
require_once 'google-logged.php';

require_once 'db.php';

$google_email = $_SESSION['google_email'];

$conn->query("INSERT INTO tasks (task, email) VALUES ('".$_POST['todo']."','".$google_email."')");
$conn->close();

header('Location: index.php', true,302);
exit;
