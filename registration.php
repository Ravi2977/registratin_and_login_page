<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php 
        if(isset($_POST["submit"])){
            $full_name = $_POST["FullName"];
            $email = $_POST["email"];
            $password = $_POST["Password"];
            $repeat_password = $_POST["Repeat_password"];
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $errors = array();
            if(empty($full_name) || empty($email) || empty($password) || empty($repeat_password)){
                array_push($errors, "All fields are required");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
            }
            if(strlen($password) < 8){
                array_push($errors, "Password must be at least 8 characters or more");
            }
            if($password !== $repeat_password){
                array_push($errors, "Passwords do not match");
            }
            require_once "database.php";
            $sql="SELECT * FROM users WHERE email='$email'";
            $result=mysqli_query($con, $sql);
            $rowCount=mysqli_num_rows($result);
            if($rowCount>0){
                array_push($errors, "Your email allready exists");
            }
            if(count($errors) > 0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            else {
                require_once "database.php";
                $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($con);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $full_name, $email, $password_hash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                } else {
                    die("Something went wrong");
                }
            }
        }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="FullName" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Enter a valid email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="Password" placeholder="Enter new password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="Repeat_password" placeholder="Repeat Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div><p>allready registerd <a href="login.php">Login Now</a></p></div>
    </div>
</body>
</html>
