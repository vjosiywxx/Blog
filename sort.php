<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type = "text/css" href="posts.css">
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

    <div class="posts">
        <h1>POSTS</h1>
        <form action="sort.php" method="get">
            <label for="sortOrder">Sort By:</label>
            <select name="sortOrder" id="sortOrder">
                <option value="newest">Newest to Oldest</option>
                <option value="oldest">Oldest to Newest</option>
            </select>
            <input type="submit" value="Sort">
        </form>
        <table class = "posttable">

        <?php
        $conn = new mysqli("localhost", "root", "", "blog");

        if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["sortOrder"])) {

                $sortOrder = $_GET["sortOrder"];
                $query="SELECT * FROM post";
                
                if ($sortOrder === "newest") {
                    $query .= " ORDER BY date DESC";
                } else if ($sortOrder === "oldest") {
                    $query .= " ORDER BY date ASC"; 
                }
            
                $result = $conn->query($query);
            }
        }
                
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                    
                    $postCategoryLabel = getCategoryLabel($row['postCategory']);
                    $weatherCategoryLabel = getWeatherCategoryLabel($row['weatherCategory']);
                    ?>

                    <tr><td>♡<?php echo $postCategoryLabel?>♡</td></tr>
                    <tr><td>☼☁<?php echo $weatherCategoryLabel?>☂☄</td></tr>
                    <tr><td>《<?php echo $row['title']?>》</td></tr>
                    <tr><td>⟢<?php echo $row['date']?>⟣</td></tr>
                    <tr><td><?php echo $row['content']?></td></tr>

                    <tr>
                        <td>
                            <form action="posts.php" method="post">
                        <input type="hidden" name="postID" value="<?php echo $row['postID'];?>">
                        <button type="submit" name="deletePost">Delete</button>
                            </form>
                        
                        <form action="update.php" method="get">
                        <input type="hidden" name="postID" value="<?php echo $row['postID'];?>">
                        <button type="submit" name="updatePost" >Update</button>
                            </form>
                        </td>
                    </tr>
                    <tr><td>                         </td></tr>
                    <?php
                }
            }else{
                echo "No messages found";  
            }
                $conn->close();
            
                function getCategoryLabel($categoryValue)
                {
                    $categoryMap = array(
                        "1" => "Travel",
                        "2" => "Celebration",
                        "3" => "Daily Life",
                        "4" => "Thoughts"
                    );

                    return isset($categoryMap[$categoryValue]) ? $categoryMap[$categoryValue] : "";
                }

                function getWeatherCategoryLabel($weatherCategoryValue)
                {
                    $weatherCategoryMap = array(
                        "1" => "Sunny",
                        "2" => "Cloudy",
                        "3" => "Windy",
                        "4" => "Rainy",
                        "5" => "Default"
                    );

                    return isset($weatherCategoryMap[$weatherCategoryValue]) ? $weatherCategoryMap[$weatherCategoryValue] : "";
                }
                    ?>
                </table>
    </div>

    
    <footer>
        <div class="copyright-part">
            <p class="footertext">&copy;Josie Ying tries to create websites 2023</p>
        </div>
    </footer>

</body>
</html>