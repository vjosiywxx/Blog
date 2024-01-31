<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type = "text/css" href="update.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>YING'S Blog</title>
</head>
<body>
    
    <header class="header-menu-position">
            <a href ="#" class = "logo"><span>Y</span>ING's <span>B</span>log</a>
            
            <nav class="navbar"> 
                <a href="home.html">HOME</a>
                <a href="createanewpost.html">NEW A POST</a>
                <a href="posts.php">POSTS</a>
                <a href="contact.html">CONTACT</a>
                <a href="message.php">MESSAGE BOX</a>
            </nav>

        <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <i class="fas fa-search" id="search-icon"></i>
        </div>

    </header>

    <section class="updateClass">
        <h1>UPDATE POST</h1>
        <table>
            <?php
              $conn = new mysqli("localhost", "root", "", "blog");
        
              if($conn->connect_error){
                die("Connection failed:" .$conn->connect_error);
              }

              if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['postID'])){
                $postID = $_GET['postID'];

                $query = $conn->prepare("SELECT * FROM post WHERE postID = ?");
                $query->bind_param("i", $postID);
                $query->execute();
                $result = $query->get_result();


            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                
                    $postCategory = $row['postCategory'];
                    $weatherCategory = $row['weatherCategory'];
                    $title = $row['title'];
                    $date = $row['date'];
                    $content = $row['content'];
                ?>

                    <form action="updateProcess.php" class="updateForm" method="post">
                    <input type="hidden" name="postID" value="<?php echo $postID; ?>">

                        <label for="postCategoryLabel">Post Category:   </label>
                        <select name="postCategory" required class="select" id="postid">
                            <option value="1" <?php if ($postCategory == '1') echo 'selected'; ?>>Travel</option>
                            <option value="2" <?php if ($postCategory == '2') echo 'selected'; ?>>Celebration</option>
                            <option value="3" <?php if ($postCategory == '3') echo 'selected'; ?>>Daily Life</option>
                            <option value="4" <?php if ($postCategory == '4') echo 'selected'; ?>>Thoughts</option>
                        </select><br>

                        <label for="weatherCategoryLabel">Weather Category:   </label>
                        <select name="weatherCategory" required class="select" id="weatherid">
                            <option value="1" <?php if ($weatherCategory == '1') echo 'selected'; ?>>Sunny</option>
                            <option value="2" <?php if ($weatherCategory == '2') echo 'selected'; ?>>Cloudy</option>
                            <option value="3" <?php if ($weatherCategory == '3') echo 'selected'; ?>>Windy</option>
                            <option value="4" <?php if ($weatherCategory == '4') echo 'selected'; ?>>Rainy</option>
                            <option value="5" <?php if ($weatherCategory == '5') echo 'selected'; ?>>Default</option>
                            </select><br>

                        <label for="title">Title: </label>
                        <input type="text" name="title" value="<?php echo $title; ?>"><br>

                        <label for="date">Date: </label>
                        <input type="date" name="date" value="<?php echo $date; ?>"><br>

                        <label for="content">Content: </label>
                        <textarea name="content"><?php echo $content; ?></textarea><br>

                        <input type="submit" value="Update" class="updateButton"><br>
                </form>
                    
                <?php
            }
        }else{
            echo "No messages found";
            
        }
    }
            $conn->close();
        ?>
        
    </section>

    
    <footer>
        <div class="copyright-part">
            <p class="footertext">&copy;Josie Ying tries to create websites 2023</p>
        </div>
    </footer>

</body>
</html>
