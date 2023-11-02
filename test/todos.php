<?php
    require 'mysql.php';
    session_start();

    if(!$_SESSION["logged_in"]) {
        header("Location: http://localhost:8080/test");
    }

    $tmp = $_SESSION['user_data']['user_id'];

    $sql = "SELECT * FROM `todos` WHERE user_id = '$tmp';";
    try {
        $todos = mysqli_query($connect, $sql);
    } catch (\Throwable $th) {
        echo "Coundn't fetch <br>";
        echo $th;
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
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" >
                <label for="">
                    <span>Deadline</span>
                    <input type="date" name="todo_date">
                </label>
                <label for="">
                    <span>Text</span>
                    <input type="text" name="todo_text">
                </label>
                <button type="submit">Add</button>
            </form>
            <ul>
                <?php
                    if(mysqli_num_rows($todos) > 0) {
                        while($row = mysqli_fetch_assoc($todos)) {
                            echo "<li>"
                            . $row['todo_text'] 
                            . " " 
                            . $row['todo_date'] 
                            . "<button type='button'>Delete</button>
                            </li>";
                            
                        }
                    }
                    else {
                        echo "<p>Your task list is empty.</p>";
                    }
                ?>
            </ul>
        </div>
    </main>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $tododate = filter_input(INPUT_POST, "todo_date", FILTER_SANITIZE_SPECIAL_CHARS);
        $todotext = filter_input(INPUT_POST, "todo_text", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "INSERT INTO todos VALUES ('$tmp', '$tododate', '$todotext', 0);";
        try {
            mysqli_query($connect, $sql);
            echo "You have successfuly added a task !";
        } catch (\Throwable $th) {
            echo "Coundn't fetch <br>";
            echo $th;
        }
    }
?>