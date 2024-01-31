<?php
    $conn = new mysqli("localhost", "root", "", "blog");

if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['postID'])) {
    $postID = $_POST['postID'];
    $postCategory = $_POST['postCategory'];
    $weatherCategory = $_POST['weatherCategory'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];


    $updateQuery = $conn->prepare("UPDATE post SET postCategory=?, weatherCategory=?, title=?, date=?, content=? WHERE postID=?");
    $updateQuery->bind_param("iisssi", $postCategory, $weatherCategory, $title, $date, $content, $postID);
    $updateQuery->execute();

    if ($updateQuery) {
        header("Location: posts.php");
        exit();

    } else {
        echo "Update failed: " . $conn->error;
    }
    
} else {
    echo "Invalid request";
}

$conn->close();
?>