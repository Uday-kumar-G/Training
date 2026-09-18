<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
</head>
<body>

<h1>User Details</h1>

<?php

$servername = "localhost";
$username = "uday";
$password = "Root@1234";
$dbname = "FACEBOOK";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT * FROM USER";
$sql1 = "SELECT * FROM FRIEND";
$sql2="SELECT * FROM WALL order by POSTING_DATE desc";
$my_post="SELECT *FROM WALL WHERE USER_ID=(SELECT USER_ID FROM USER WHERE NAME='Uday Kumar') order by POSTING_DATE  desc";

// Execute query
$result = $conn->query($sql);
$result1 = $conn->query($sql);
$result_FRND_ = $conn->query($sql1);
$sql_post = $conn->query($my_post);

?>

<?php
    $row11 = $result1->fetch_assoc();
    echo '<h1>WELCOME :- <a href="profile.php?id=' . $row11["USER_ID"] . '">' . $row11["NAME"] . '</a></h1>';

?>
<?php

$conn = new mysqli("localhost", "uday", "Root@1234", "FACEBOOK");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "SELECT USER_ID, NAME, EMAIL, ADDRESS, PHONE
            FROM USER
            WHERE USER_ID = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

   $stmt->execute();

$profile_result = $stmt->get_result();
$user = $profile_result->fetch_assoc();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if ($user) {

        echo "<h1>" . $user["NAME"] . "</h1>";

        echo "<p>Email: " . $user["EMAIL"] . "</p>";

        echo "<p>Address: " . $user["ADDRESS"] . "</p>";

        echo "<p>Phone: " . $user["PHONE"] . "</p>";

    } else {

        echo "User not found";
    }

}

?>

<h3>Post's</h3>

<table>
    <tr>
        <td>date</td>
        <td>Post</td>
    </tr>
<?php
if($sql_post->num_rows>0){
        while($post=$sql_post->fetch_assoc()){
        $d=date("y.m.d",strtotime($post["POSTING_DATE"]));
        echo "<tr>";
        echo "<td>" .$d. "</td>";
        echo "<td>" . $post["POST"] . "</td>";
        echo "</tr>";
        }
} 
   else {
    echo "<tr><td colspan='3'>No users found</td></tr>";
}
$conn->close();

?>

</table>


<h2>Create Post</h2>

<form method="POST">
    <input type="text" name="post" placeholder="Enter your post">
    <button type="submit">Post</button>
</form>

<?php

$conn = new mysqli("localhost", "uday", "Root@1234", "FACEBOOK");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $post = $_POST["post"];

    $sql = "INSERT INTO WALL (USER_ID, POST)
            SELECT USER_ID, ?
            FROM USER
            WHERE NAME = 'Uday Kumar'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $post);

    if ($stmt->execute()) {
        echo "Post added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>

<table border="1">

    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>

<?php

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row["USER_ID"] . "</td>";
        echo "<td>" . $row["NAME"] . "</td>";
        echo "<td>" . $row["EMAIL"] . "</td>";

        echo "</tr>";
    }

}
else {
    echo "<tr><td colspan='3'>No users found</td></tr>";
}
?>

</table>


<table border="1">

    <tr>
        <th>User ID</th>
        <th>frend_id</th>
    </tr>

<?php
ECHO "<br>";
if ($result_FRND_->num_rows > 0) {

    while ($row = $result_FRND_->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row["USER_ID"] . "</td>";
        echo "<td>" . $row["FRIEND_ID"] . "</td>";
        

        echo "</tr>";
    }

}
else {
    echo "<tr><td colspan='3'>No users found</td></tr>";
}
?>
</table>

</body>
</html>