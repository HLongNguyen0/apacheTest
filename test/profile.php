<?php
    session_start();

    if(!$_SESSION["logged_in"]) {
        header("Location: http://localhost:8080/test");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul class="navigation">
                    <li class="navigation__elem"><a href="./profile.php">Profile</a></li>
                    <li class="navigation__elem"><a href="./todos.php">Todos</a></li>
                </ul>
            </nav>
            <a href="/test">Log out</a>
        </div>
    </header>
    <main>
        <div class="container">
            <h1>Hello , 
                <?php 
                echo $_SESSION["user_data"]["user_firstname"] . " " . $_SESSION["user_data"]["user_lastname"] 
                ?>
            !</h1>
        </div>
    </main>
</body>
</html>

<?php

?>