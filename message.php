<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type = "text/css" href="contactMessage.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>YING'S Blog</title>
</head>
<body>
    
    <header class="header-menu-position">   
            <a href ="logolink" class = "logo"><span>Y</span>ING's <span>B</span>log</a>
            
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
    <div class="messages">
        <h1>MESSAGE</h1>
        <table class = "messagetable">
            <?php
              $conn = new mysqli("localhost", "root", "", "blog");
        
              if($conn->connect_error){
                die("Connection failed:" .$conn->connect_error);
              }

              $name = $email = $number = $subject = $message = "";

              if ($_SERVER["REQUEST_METHOD"] == "POST"){

            $name = isset($_POST["name"]) ? $_POST["name"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $number = isset($_POST["number"]) ? $_POST["number"] : "";
            $subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
            $message = isset($_POST["message"]) ? $_POST["message"] : "";
            
            if (!empty($name) || !empty($email) || !empty($number) || !empty($subject) || !empty($message)) {
            $query = $conn->prepare("INSERT INTO message(name,email,number,subject,message)VALUES(?,?,?,?,?)");
			$query->bind_param("ssiss", $name, $email, $number, $subject, $message);
			$query->execute();
            
            header("Location:".$_SERVER['REQUEST_URI']);
            exit();
            }
        }
            $result = $conn->query("SELECT * FROM message");
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                ?>
                <tr><td>Name:<?php echo $row['name']?></td></tr>
                <tr><td>Email:<?php echo $row['email']?></td></tr>
                <tr><td>Number:<?php echo $row['number']?></td></tr>
                <tr><td>Subject:<?php echo $row['subject']?></td></tr>
                <tr><td>Message:<?php echo $row['message']?></td></tr>
                <tr><td>             </td></tr>
                <?php
            }
        }else{
            echo "No messages found";
        }
            $conn->close();
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