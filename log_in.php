<?php
	include './component/database.php';
	session_save_path("C:/xampp/tmp");
	session_start();
	
	$error = "";
	if ( isset( $_POST['sign_in']) ) {
		
		$phone = htmlspecialchars($_POST['phone'] ?? ''); 
        $password = htmlspecialchars($_POST['password'] ?? '');  
		
		if(empty($phone) || empty($password)) {
            $error = "You must enter your phone, email or password";            
        } else {
			if( $connection) {
            	$sql = "SELECT * FROM Users; "; 
                $statement = $connection->prepare($sql); 
                $statement->execute();
				//Chế độ lấy dữ liệu ra
                $statement->setFetchMode(PDO::FETCH_ASSOC); 
                $user = $statement->fetchAll();                
				foreach ( $user as $user) {
					if ( $user['phoneNumber'] == $phone && $user['password'] == $password) {
						$_SESSION['userId'] = $user['userId'];
						if ( $user['role'] == 'user') {
							header('Location: ./home_page.php');
						} else if ( $user['role'] == 'admin') {
							header('Location: ./upload_san_pham.php');
						}
						
					} else {
						$error = "Wrong phone number or password";
					}   
				} 
			}           
        }
	}
	else if ( isset( $_POST['register']) ) {
		header('Location: ./register.php');
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login_page</title>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
	
	<link rel="stylesheet" href="./css/log_in.css">
</head>
<body style="background:#cbced3; " >
	<div class="divtitle">
	<div class="title">BRONX LUGGAGE</div>
	<div class="subtitle"><caption>Start your journey</caption></div>
	</div>
	<form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
	<div class="login">
		<div class="type">
			<input type="number" placeholder="Phone number" class="textbox"  name="phone">
		</div>
		<div class="type">
			<input type="password" placeholder="Password" class="textbox" name="password">
		</div>
		<div>
			<p style="color: red;text-align: right;"><?php echo $error; ?></p>
		</div>
		<div class="type">
			<input type="submit" value="Log In" class="logIn" name="sign_in">
		</div>
		<div class="type">
			<a href="./forgot_password.php" class="forget_pass" name="forgot_pass">Forgotten password?</a>
		</div>
		<div >
			<hr style="width: 90%;color: #e4e6e9;">
		</div>
		<div class="type">
			<input type="submit" value="Create a new account" class="new_account" name="register">
		</div>
	</div>
	</form>
	
</body>
</html>