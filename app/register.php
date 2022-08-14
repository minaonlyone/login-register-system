<?php
require_once("databaseClass.php");
if(isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password'])){
    if(empty($_POST['username']) || empty($_POST['password'])){
        echo "<div class='danger'>Please enter username / password.</div>";
    }else{
        $user = $DB->fetch(
            "SELECT * FROM `users` JOIN `roles` USING (`role_id`) WHERE `user_name`=?",
            [$_POST["username"]]
          );
          $pass = is_array($user);
          if ($pass) {
            echo "<div class='danger'>User Is Registered.</div>";
          }
          if (!$pass) {
            $hashed_password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            if($DB->exec("INSERT INTO `users` (user_name,user_password) VALUES (? ,?) ",[
                $_POST['username'],
                $_POST['password'],
            ])){
                session_regenerate_id(); // PREVENT Hacking
                $_SESSION['loggedin'] = TRUE;
                $_SESSION["user"] = $DB->fetch(
                    "SELECT * FROM `users` JOIN `roles` USING (`role_id`) WHERE `user_name`=?",
                    [$_POST["username"]]
                );
                $_SESSION["user"]["permissions"] = [];
                unset($_SESSION["user"]["user_password"]);
                header("Location: index.php");
            }
        
           }      
    }
}
?>