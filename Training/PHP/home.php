<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
</head>
<body>
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
        if (!isset($_GET["id"])) {
            die("User ID not provided");
        }
        $id = (int) $_GET["id"];

        // SQL query
        $sql = "SELECT * FROM USER";
        $sql1 = "SELECT * FROM FRIEND"; 
        $sql2="SELECT * FROM WALL order by POSTING_DATE desc";
        
        $result = $conn->query($sql);
        // $result1 = $conn->query($sql);
        $result_FRND_ = $conn->query($sql1);
        
        $my_post = "SELECT *
            FROM WALL
            WHERE USER_ID = ?
            ORDER BY POSTING_DATE DESC";

        $post_stmt = $conn->prepare($my_post);
        $post_stmt->bind_param("i", $id);
        $post_stmt->execute();

        $sql_post = $post_stmt->get_result();
    ?>
    <?php
        $user_sql = "SELECT USER_ID, NAME, EMAIL, ADDRESS, PHONE
             FROM USER
             WHERE USER_ID = ?";
        $user_stmt = $conn->prepare($user_sql);
        $user_stmt->bind_param("i", $id);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();
        $user = $user_result->fetch_assoc();
        echo '<h1>WELCOME :- <a href="profile.php?id=' . $user["USER_ID"] . '">' . $user["NAME"] . '</a></h1>';
    ?>
  
    <h3>Post's</h3>
        <table>
            <tr>
                <td>date</td>
                <td>Post</td>
            </tr>
    <?php
        if($sql_post->num_rows>0)
        {
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
            <input type="text" name="post" placeholder="Enter your post" required>
            <button type="submit">Post</button>
        </form>
        <?php

        $conn = new mysqli("localhost", "uday", "Root@1234", "FACEBOOK");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (!isset($_GET["id"])) {
            die("User ID not provided");
        }

        $id = (int) $_GET["id"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $post = $_POST["post"];

            $sql = "INSERT INTO WALL (USER_ID, POST)
                    VALUES (?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $id, $post);

            if ($stmt->execute()) {
                header("Location: home.php?id=" . $id);
                exit();
            }
        }

        ?>
</body>
</html>