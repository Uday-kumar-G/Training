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
   // SQL query
$sql = "SELECT * FROM USER";
$sql1 = "SELECT * FROM FRIEND";
$sql2="SELECT * FROM WALL";
$my_post="SELECT *FROM WALL WHERE USER_ID=(SELECT USER_ID FROM USER WHERE NAME='Uday Kumar')";
$My_frnds_sql="SELECT U.USER_ID, U.NAME
        FROM FRIEND F
        JOIN USER U
        ON F.FRIEND_ID = U.USER_ID
        WHERE F.USER_ID = ?";

// Execute query
$result = $conn->query($sql);
$result_FRND_ = $conn->query($sql1);
$sql_post = $conn->query($my_post);
$my_frnds=$conn->query($My_frnds_sql);

?>
<?php
    $row11 = $result->fetch_assoc();
    echo '<h1>WELCOME :- <a href="profile.php?id=1">' . $row11["NAME"] . '</a></h1>';

?>


<h3><a href="friends.php">FRIENDS</a></h3>

<h3><a href="home.php">HOME</a></h3>
<?php
    if($my_frnds->num_rows>0){
        while( $frnds = $my_frnds->fetch_assoc()){
        echo '<a href="profile.php?id=' . $frnds["USER_ID"] . '">'
         . $frnds["NAME"] .
         '</a><br>';
        }}
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
</div>
    
</body>
</html>





