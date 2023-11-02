<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "todos";
    $connect = "";

    try {
        $connect = mysqli_connect($db_server, $db_user, $db_password, $db_name);
    } catch (\Throwable $th) {
        echo "Everything went wrong ...<br>";
        echo $th;
    };
?>