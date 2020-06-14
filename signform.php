<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1"/>
		<link rel="stylesheet" href="styles/styleform.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<title>Sign In</title>
		</head>
<body>
	<div class="bg">
		<div class="box">
			<h2>Sign In</h2>
			<form action="signin.php" method="post">
				<div class="inputBox">
					<input type="text" name="login" required="">
					<label><i class="fas fa-user"></i> Login</label>		
                </div>
                <div class="inputBox">
					<input type="text" name="email" required="">
					<label><i class="fas fa-user"></i> E-Mail</label>		
				</div>
				<div class="inputBox">
					<input type="password" name="pass" required="">
					<label><i class="fas fa-lock"></i> Password</label>					
				</div>
				<input type="submit" name="" value="Submit">
			</form>
		</div>
	</div>


</body>
</html>