<?php
include './component/database.php';
session_start();
$userId = $_SESSION['userId'];

if (!isset($userId)) {
	header('Location: log_in.php');
}
if (isset($_POST['log_out'])) {
	session_destroy();
	header('Location: log_in.php');
}
date_default_timezone_set("Asia/Bangkok");
$time = date("H:i");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Fun Flight</title>
	<link rel="stylesheet" href="./css/home_page.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
	<!-- font-awesome cdn link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?fbclid=IwAR3z5H1piWVUZNQRsfaddkVOmOKojLEgynatk5wQJK4mgmaqia8GD1Y4ljU">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<style>
		.nav-item a {
			font-size: 20px;
		}
	</style>
</head>

<body style="background: #f8f9fa;">
	<!-- Navigation -->
	<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top" style="position: fixed;width: 100%;">
		<div class="container-fluid">
			<a class="navbar-branch" href="/home_page.php">
				<img src="./Ảnh_website/logo.png" height="50">
			</a>

			<?php
			if ($connection != NULL) {
				$sql = "SELECT * FROM Users WHERE userId = $userId;";
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$statement = $connection->prepare($sql);
				$statement->execute();
				$statement->setFetchMode(PDO::FETCH_ASSOC);
				$userName = $statement->fetchAll(); 
				foreach ($userName as $userName) {
			?>
					<p class="navbar-branch">
						༼ つ ◕‿◕ ༽つHi...<?php echo $userName['userName']; ?></p>
					<?php
				}
			}
					?>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarResponsive">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link active" href="./home_page.php">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="./about_us.php">About us</a>
							</li>

							<?php
							if ($connection != NULL) {
								$sql = "SELECT * FROM orderdetails WHERE userId = $userId";
								$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$statement = $connection->prepare($sql);
								$statement->execute();
								$statement->setFetchMode(PDO::FETCH_ASSOC);
								$result = $statement->fetchAll();
								$num = count($result);
							}
							?>
							<li class="nav-item">
								<a class="nav-link" href="./cart.php"><i class="fas fa-cart-arrow-down"></i>(<?php echo $num; ?>)</a>
							</li>

							<?php
							if ($connection != NULL) {
								$sql = "SELECT * FROM Orders WHERE userId = $userId";
								$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$statement = $connection->prepare($sql);
								$statement->execute();
								$statement->setFetchMode(PDO::FETCH_ASSOC);
								$result = $statement->fetchAll();
								$num = count($result);
							}
							?>
							<li class="nav-item">
								<a class="nav-link" href="./order.php"><i class='far fa-credit-card'></i>(<?php echo $num; ?>)</a>
							</li>
							<li class="nav-item">
								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									<input type="submit" value="&#10162" name="log_out" style="font-size: 20px;" class="nav-link">
								</form>
							</li>

						</ul>
					</div>
		</div>
	</nav>