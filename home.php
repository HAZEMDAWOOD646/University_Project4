<?php
session_start();
include('inc/connections.php');

if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    $id = $_SESSION['id'];
    $user = $_SESSION['username'];
} else {
    header("Location: login.php"); // Redirect to login if session not set
    exit();
}

$info = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
$data = mysqli_fetch_array($info);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <header>
            <a href="logout.php" class="logout-button">Log out</a>
        </header>
        <div class="profile">
            <div class="photo">
                <img src='images/<?php echo $data["profile_picture"]; ?>' alt='Profile picture not found'>
            </div>
            <div class="info">
                <h2>Welcome, <?php echo $data["username"]; ?>!</h2>
                <p>Type: <?php echo $data["type"]; ?></p>
                <p>Birth Date: <?php echo $data["birthday"]; ?></p>
                <p>Gender: <?php echo $data["gender"]; ?></p>
            </div>
        </div>
        <div class="upload-section">
            <form action="upload_image.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file" id="file">
                <input type="submit" name="submit" value="UPLOAD">
            </form>
        </div>
    </div>
</body>
</html>
