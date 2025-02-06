<?php
$username='root';
$servername='127.0.0.1';
$password= '';
$dbname='test';
$port='3307';
$conn = new mysqli($servername,$username,$password,$dbname, $port);

if($conn->connect_errno){
    echo "Nie udało połączyć się z bazą danych MYSQL: ".$conn->connect_error;
    exit();
}

// echo "Połączony z bazą danych";