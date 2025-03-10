<?php
if (!isset($_SESSION['google_loggedin'])) {
    header('Location: login.php');
    exit;
}