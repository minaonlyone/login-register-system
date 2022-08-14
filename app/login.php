<?php
session_start();
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
          if ($pass) { $pass = password_verify($_POST["password"], $user["user_password"]); }
          if (!$pass) { exit("<div class='danger'>Invalid user/password.</div>"); }
          
          session_regenerate_id(); // PREVENT Hacking
          $_SESSION['loggedin'] = TRUE;
          $_SESSION["user"] = $user;
          $_SESSION["user"]["permissions"] = [];
          unset($_SESSION["user"]["user_password"]);
           
          
          $perm = $DB->fetchAll(
            "SELECT * FROM `permissions` WHERE `role_id`=?",
            [$user["role_id"]]
          );
          foreach ($perm as $p) { $_SESSION["user"]["permissions"][] = $p["permission_id"]; }
           
          header("Location: index.php");
    }
}  
?>