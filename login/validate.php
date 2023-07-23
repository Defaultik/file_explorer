<?php
    session_start();

    include_once("connection.php");
    
    function remove_shit($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = remove_shit($_POST["username"]);
        $password = remove_shit($_POST["password"]);

        $stmt = $conn -> prepare("SELECT * FROM admin_login");
        $stmt -> execute();

        $users = $stmt -> fetchAll();
        
        foreach($users as $user) {
            if (($username == $user["username"]) && ($password == $user["password"])) {
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                
                header("location: ../index.php");
            } else {
                header("location: ../login_panel.php");
            }
        }
    }
?>