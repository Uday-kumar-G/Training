<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="content">
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
if (!isset($_GET["id"])){
    die("User ID not specified.");
}
$id = $_GET["id"];


$sql = "SELECT USER_ID, NAME, EMAIL, ADDRESS, PHONE
        FROM USER
        WHERE USER_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$profile_result = $stmt->get_result();
$user = $profile_result->fetch_assoc();

if(!$user){
    die("User not found.");
}
?>
<h1>WELCOME :- <a href="profile.php"><?php echo $user["NAME"]; ?></a></h1>
<p>email:<?php echo $user["EMAIL"];?></p>
<p>address:<?php echo $user["ADDRESS"];?></p>
<p>phone:<?php echo $user["PHONE"];?></p>

<h4>This is your profile</h4>
<h3><a href="friends.php">FRIENDS</a></h3>
<h3><a href="update.php">Update</a></h3>
<h3><a href="home.php">HOME</a></h3>

<h3>Post's</h3>

<table>
    <tr>
        <td>date</td>
        <td>Post</td>
    </tr>
<?php
$sql_post="SELECT POST,POSTING_DATE FROM WALL WHERE USER_ID=? ORDER BY POSTING_DATE DESC";
$post_stmt = $conn->prepare($sql_post);
$post_stmt->behind_param("i",$id);
$post_stmt->execute();
$post_result = $post_stmt->get_result();

        while($post=$post_result->fetch_assoc()){
        $d=date("y.m.d",strtotime($post["POSTING_DATE"]));
        echo "<tr>";
        echo "<td>" .$d. "</td>";
        echo "<td>" . $post["POST"] . "</td>";
        echo "</tr>";
        }
 
$conn->close();
?>
</table>
</div>
    
</body>
</html>





