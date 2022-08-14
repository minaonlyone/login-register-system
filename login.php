<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login System</title>        
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
    <body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>E2ECounty</h1>
				<a href="register.php"><i class="fas fa-sign-out-alt"></i>Register</a>
			</div>
		</nav>
		<div class="content">	
            <div class="login autoMargin">
                <h1>Login</h1>
                <form method="post">
                    <label for="username">
                        <i class="fas fa-user"></i>
                    </label>
                    <input type="text" name="username" placeholder="Username" id="username" required>
                    <label for="password">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" name="password" placeholder="Password" id="password" required>
                    <input type="submit" name="submit" value="Login">
                </form>
                <br>
                <?php
                require("app/login.php");
                ?>
            </div>
        </div>
	</body>
</html>