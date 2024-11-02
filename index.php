<?php
//start the session
session_start(); 
//file containing the database connection
    include("database.php");
?>

// the html form
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form action = "<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post" >
    <div class="login-box">
        <div class="login-header">
            <header>Welcome</header>
            <p>We are happy to have you back!</p>
        </div>
// registration feedback
        <?php
            if (isset($_SESSION['message'])) {
            echo "<p>{$_SESSION['message']}</p>";
            unset($_SESSION['message']);
        }
        ?>

        <div class="input-box">
            <input type="text" class="input-field" id="username" name = "username"  required>
            <label for="username">Email or phone</label>
        </div>
        <div class="input-box">
            <input type="password" class="input-field" id="password" name = password  required>
            <label for="password">Password</label>
        </div>
        <div class="forgot">
            <section>
                <input type="checkbox" id="check">
                <label for="check">Remember me</label>
            </section>
            <section>
                <a href="#" class="forgot-link">Forgot password?</a>
            </section>
        </div>
        <div class="input-box">
            <input type="submit" class="input-submit" value="Sign In">
        </div>
        <div class="middle-text">
            <hr>
            <p class="or-text">Or</p>
        </div>
        <div class="social-sign-in">
            <button class="input-google">
                 <img src="/images/google.jpg" alt="">
                 <p>Sign In with Google</p>
            </button>
            <button class="input-twitter">
                <img src="/images/x.jpg" alt="">
            </button>
        </div>
        <div class="sign-up">
            <p>Don't have account? <a href="#">Sign-up</a></p>
        </div>
    </div>
</form>
</body>
</html>

<?php 

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS); 
    }

    if(empty($username)){
        echo"Please enter a username";
    }
    elseif(empty($password)){
        echo"Please enter a password";
    }
    else{
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $register = "INSERT INTO users (user, password)
                     VALUES (?, ?)";
//prepared statement
    $stmt = mysqli_prepare($conn, "INSERT INTO users (user, password) VALUES (?, ?)");

//binding the data
    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedpassword);

//execute the statemnt
    mysqli_stmt_execute($stmt);
    echo "You have been registered";
    mysqli_stmt_close($stmt);

// give the feedback to the user
    $_SESSION['message'] = "You have been registered successfully!";

//prevents form resubmission.
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
?>