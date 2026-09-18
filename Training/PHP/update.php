<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h3><a href="home.php">HOME</a></h3><br><br>
    <form action="" method="post">
        name:- <input type="text" name="name" id=""><br><br>
        email:- <input type="email" name="email" id=""><br><br>
        password:- <input type="password" name="password" id=""><br><br>
        address:- <input type="text" name="address" id=""><br><br>
        phone:- <input type="text" name="phone" id=""><br><br>
        <button type="submit">Update</button>
    </form>

<?php

$conn = new mysqli("localhost", "uday", "Root@1234", "FACEBOOK");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    $sql = "UPDATE USER 
    SET 
    NAME=?,
    EMAIL=?,
    PASSWORD=?,
    ADDRESS=?,
    PHONE=? 
    WHERE NAME='Uday kumar'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $password, $address, $phone);

    if ($stmt->execute()) {
        echo "PROFILE UPDATED successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>

</body>
</html>

<!-- NAME VARCHAR(40) NOT NULL, 
EMAIL VARCHAR(40) NOT NULL, 
PASSWORD VARCHAR(40) NOT NULL,
ADDRESS VARCHAR(100),
PHONE VARCHAR(10)); -->