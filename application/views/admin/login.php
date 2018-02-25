<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("public/Admin/")?>css/login.css">
</head>
<body>
	<div class="login">
		<div class="user"><img src="<?php echo base_url("public/Admin/")?>jmg/user.png" height="100%" ><h2>Đăng nhập</h2></div>
		<div style="clear: both;"></div>
		<form action="" method="post">
			<table>
				<tr><td><input type="text" name="username" placeholder="Username"></td></tr>
				<tr><td><input type="password" name="password" placeholder="Password"></td></tr>
				<tr>
				<td><input type="submit" name="" value="Login"></td></tr>
			</table>
		</form>
			
			<p></p>
	</div>
</body>
</html>