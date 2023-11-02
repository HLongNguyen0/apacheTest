<?php
    require 'mysql.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <div class="container">
            <a href="/test/">Log in</a>
        </div>
    </header>
    <main>
        <div class="container">
            <h1>Registration</h1>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" >
                <label for="">
                    <span>Username</span>
                    <input type="text" name="user_username">
                </label>
                <label for="">
                    <span>Password</span>
                    <input type="password" name="user_password">
                </label>
                <label for="">
                    <span>First Name</span>
                    <input type="text" name="user_firstname">
                </label>
                <label for="">
                    <span>Last Name</span>
                    <input type="text" name="user_lastname">
                </label>
                <button type="submit">Register</button>
            </form>
        </div>
    </main>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, "user_username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "user_password", FILTER_SANITIZE_SPECIAL_CHARS);
        $firstname = filter_input(INPUT_POST, "user_firstname", FILTER_SANITIZE_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST, "user_lastname", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($username)) {
            echo "Please enter a username";
        } else if(empty($password)) {
            echo "Please enter a password";
        } else {
            $sql = "INSERT INTO users (user_username, user_password, user_firstname, user_lastname)
                    VALUES ('$username', '$password', '$firstname', '$lastname');";
            header("Location: http://localhost:8080/test");
            try {
                mysqli_query($connect, $sql);
                echo "You have successfuly registered !";
            } catch (\Throwable $th) {
                echo "Coundn't fetch <br>";
                echo $th;
            }
        };
    }
?>