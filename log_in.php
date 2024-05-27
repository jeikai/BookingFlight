<?php
include './component/database.php';
// session_save_path("C:/xampp/tmp");
session_start();

$error = "";
if (isset($_POST['sign_in'])) {

	$phone = htmlspecialchars($_POST['phone'] ?? '');
	$password = htmlspecialchars($_POST['password'] ?? '');

	if (empty($phone) || empty($password)) {
		$error = "You must enter your phone, email or password";
	} else {
		if ($connection) {
			$sql = "SELECT * FROM Users; ";
			$statement = $connection->prepare($sql);
			$statement->execute();
			//Chế độ lấy dữ liệu ra
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$user = $statement->fetchAll();
			foreach ($user as $user) {
				if (($user['phoneNumber'] == $phone && $user['password'] == $password)) {
					$_SESSION['userId'] = $user['userId'];
					if ($user['role'] == 'user') {
						header('Location: ./home_page.php');
					} else if ($user['role'] == 'admin') {
						header('Location: ./upload_san_pham.php');
					}
				} else {
					echo "Có lỗi";
					$error = "Wrong phone number or password";
				}
			}
		}
	}
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

<body style="background:#cbced3; ">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<div class="login">
			<div class="title">Fun Flight</div>
			<div class="des">
				Wellcome back
			</div>
			<div class="group">
				<input type="text" placeholder="Enter your phone number" name="phone">
			</div>
			<div class="group">
				<input type="password" id="inputPassword" placeholder="Password" name="password">
				<span id="showPassword">
					<ion-icon name="eye-outline"></ion-icon>
					<ion-icon name="eye-off-outline"></ion-icon>
				</span>
			</div>
			<div class="recovery">
				<a href="./forgot_password.php">recovery password</a>
			</div>
			<div class="signIn">
				<input type="submit" value="Log In" class="logIn" name="sign_in">
			</div>
			<div class="or">
				Or continue with
			</div>
			<div class="list">
				<div class="item">
					<img src="https://cdn1.iconfinder.com/data/icons/google-s-logo/150/Google_Icons-09-512.png" alt="">
				</div>
				<div class="item">
					<img src="https://museumandgallery.org/wp-content/uploads/2020/03/Facebook-Icon-Facebook-Logo-Social-Media-Fb-Logo-Facebook-Logo-PNG-and-Vector-with-Transparent-Background-for-Free-Download.png" alt="">
				</div>
				<div class="item">
					<img src="https://www.iconpacks.net/icons/2/free-twitter-logo-icon-2429-thumb.png" alt="">
				</div>
			</div>
			<div class="register">
				<a href="./register.php">recovery password</a>
			</div>
		</div>
	</form>
</body>

</html>