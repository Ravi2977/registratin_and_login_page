<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <p><h1>Welcome to your Dashboard you are successfully logged in</h1></p>
        <a href="logout.php" class="btn btn-warning">Log out</a>
    </div>
</body>
</html>