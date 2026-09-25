<!DOCTYPE html>
<html>
<head>
    <title>Home page</title>
    <link rel="stylesheet" href="home.css">
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
            die("User ID not provided, so plz rpovide user id in url like this \"home.php?id=1\" for 1st user");
        }
        // from url fetching the id value and converting it into the int
        $id = (int) $_GET["id"];
        // SQL query's to fetch all details
        $sql = "SELECT * 
                FROM USER";
        $sql1 = "SELECT * 
                FROM FRIEND"; 
        $sql2="SELECT * 
               FROM WALL 
               order by POSTING_DATE desc";
        
        $result = $conn->query($sql);
        $result_FRND_ = $conn->query($sql1);
        // for fetching the post details
        $my_post = "SELECT *
                    FROM WALL
                    WHERE USER_ID = ?
                    ORDER BY POSTING_DATE DESC";

        $post_statement = $conn->prepare($my_post);
        $post_statement->bind_param("i", $id);
        $post_statement->execute();
        $sql_post = $post_statement->get_result();
    ?>
    <?php
        $user_sql = "SELECT USER_ID, NAME, EMAIL, ADDRESS, PHONE
                     FROM USER
                     WHERE USER_ID = ?";
        $user_statement = $conn->prepare($user_sql);
        $user_statement->bind_param("i", $id);
        $user_statement->execute();
        $user_result = $user_statement->get_result();
        $user = $user_result->fetch_assoc();
        echo '<h1 class="my-title">WELCOME  <a href="profile.php?id=' . $user["USER_ID"] . '">' . $user["NAME"] . '</a></h1>';
    ?>
    <!-- //FOR THE CREATE POST -->
    <h2 id="create-post" class="form-title">Create Post</h2>
        <form method="POST" >
            <textarea type="text-area" id="post" class="form-input" name="post" placeholder="Write your content to post here..." required></textarea>
            <br>
            <button id="save" class="form-button" type="submit">
                Post
            </button>
            <p id="message" class="form-message"></p>
        </form>
        <?php
            $conn = new mysqli(
            "localhost",
            "uday",
            "Root@1234",
            "FACEBOOK");
            $post = trim($_POST["post"]);
            if ($post!=""){
                $sql = "INSERT INTO WALL (USER_ID, POST)
                            VALUES 
                                (1, ?)";
                $statement = $conn->prepare($sql);
                $statement->bind_param("s", $post);
                if ($statement->execute() and strlen($post) > 0) {
                    echo "Post created successfully";
                }
                else
                {
                    echo "Failed to create post";
                }
                $conn->close();
            }
        ?>
    <h3 id="post-title">Post's</h3>
        <table class="post-table" id="my-table">
            <tr>
                <th>Date</th>
                <th>Post</th>
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
            echo "<tr><td colspan='3'>No users post found</td></tr>";
        }
        $conn->close();
    ?>
    </table>
</body>
</html>


        