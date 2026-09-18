




















<?php

$servername = "localhost";
$username = "uday";
$password = "Root@1234";
$dbname = "FACEBOOK";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
$sql = "SELECT * FROM USER";
$result = $conn->query($sql);


?>