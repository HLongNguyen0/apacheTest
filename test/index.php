<?php
    require 'mysql.php';
    session_start();    

    //state
    $_SESSION["logged_in"] = false;
    $_SESSION["user_data"] = array();


    if ($_SESSION["logged_in"]) {
        header("Location: http://localhost:8080/test/profile.php");
    }
          
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDos</title>

    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <div class="container">
            <a href="register.php">Register</a>
        </div>
    </header>
    <main>
        <div class="container login">
            <div class="login__box">
                <h1 class="login__title">Welcome !</h1>
                <form class="login__form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" >
                    <label class="login__lable">
                        <span>Username</span>
                        <input class="login__input" type="text" name="user_username">
                    </label>
                    <label class="login__lable">
                        <span>Password</span>
                        <input class="login__input" type="password" name="user_password">
                    </label>
                    <button class="login__button" type="submit">Log in</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST , "user_username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "user_password", FILTER_SANITIZE_SPECIAL_CHARS);
    
        if(empty($username)) {
            echo "Please enter a username";
        } else if(empty($password)) {
            echo "Please enter a password";
        } else {
            $sql = "SELECT * FROM users WHERE user_username = '$username' AND user_password = '$password'";
            try {
                $user = mysqli_query($connect, $sql);
                if(mysqli_num_rows($user) > 0) {
                    $_SESSION["user_data"] = mysqli_fetch_assoc($user);
                    $_SESSION["logged_in"] = true;
                    header("Location: http://localhost:8080/test/profile.php");
                }
                else {
                    echo "Wrong username or password. Please try again.";
                }
            } catch (\Throwable $th) {
                echo "Coundn't fetch <br>";
                echo $th;
            }
        };
    }
    

    mysqli_close($connect);
?>