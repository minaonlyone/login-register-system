<?php
session_start();
// redirect if not logged in
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login System</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>E2ECounty</h1>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">			
            <?php
            
            switch ($_SESSION['user']['role_name']){
                case "Admin":
                    include("app/admin.php");
                break;

                case "User":
                    include("app/user.php");
                break;
            }
            ?>
		</div>
	</body>
</html>