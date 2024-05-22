<?php
include './component/header.php';

if (isset($_POST['add_to_cart'])) {
	$quantity = 1;
	$flightId = $_POST['flightId'];
	$price = $_POST['price'];
	$orderId = time();
	try {
		$sql = "SELECT * FROM orderdetails WHERE flightId = '$flightId';";
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement = $connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$result = $statement->fetchAll();

		//Kiểm tra xem dữ liệu bản ghi đã tồn tại hay chưa
		if (count($result) > 0) {
			$message[] = 'Flight already added to cart';
		} else {

			$insert = "INSERT INTO  orderdetails(OrderDetailID, quantity, flightId, price, userId) 
					VALUES( $orderId, $quantity, $flightId, $price, $userId);";
			$connection->prepare($insert)->execute();
			$message[] = 'Flight added to cart succesfully';
			$page = $_SERVER['PHP_SELF'];
			$sec = "1.5";
			header("Refresh: $sec; url=$page");
		}
	} catch (PDOException $e) {
		echo "Cannot execute sql: " . $e->getMessage();
	}
}
$filter = '';
function select_from($filter, $connection)
{
	$sql = "SELECT * FROM Flight WHERE brand = '$filter';";
	$statement = $connection->prepare($sql);
	$statement->execute();
	//Chế độ đọc dữ liệu ra
	$result = $statement->setFetchMode(PDO::FETCH_ASSOC);
	$sp = $statement->fetchAll();
	return $sp;
}
?>
<!-- Notification -->
<?php
if (isset($message)) {
	foreach ($message as $message) {
		echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
	};
};
?>

<!-- Slide show -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="margin-top: 35px;">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="./Ảnh_website/anh1.png" class="d-block w-100" style="height: 600px;">
		</div>
		<div class="carousel-item">
			<img src="./Ảnh_website/anh2.png" class="d-block w-100" style="height: 600px;">
		</div>
		<div class="carousel-item">
			<img src="./Ảnh_website/anh3.png" class="d-block w-100" style="height: 600px;">
		</div>
		<div class="carousel-item">
			<img src="./Ảnh_website/anh4.png" class="d-block w-100" style="height: 600px;">
		</div>
		<div class="carousel-item">
			<img src="./Ảnh_website/anh5.png" class="d-block w-100" style="height: 600px;">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<!-- Search button -->
<div class="search-container nav-link">
	<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="text" placeholder="Search.." name="search">
	</form>
</div>
<!-- Time -->
<hr>
<p id="myTime" class="time neonText"></p>
<!-- Sale time -->
<?php
$sale_color[] = '';
$sale_status = array('', '', '', '', '', '');
$golden_time = array("00:00", "03:00", "09:00", "12:00", "18:00", "21:00");
if ($time >= '00:00' && $time <= '00:15') {
	$sale_color[0] = 'golden_hour';
	$sale_status[0] = 'Opening';
	for ($i = 1; $i <= 5; $i++) {
		$sale_color[$i] = 'normal_hour';
		$sale_status[$i] = 'Coming';
	}
}
if ($time > '00:15') {
	$sale_color[0] = 'end_hour';
	$sale_status[0] = 'Ended';
	for ($i = 1; $i <= 5; $i++) {
		$sale_color[$i] = 'normal_hour';
		$sale_status[$i] = 'Coming';
	}
}
if ($time >= '03:00' && $time <= '03:15') {
	$sale_color[1] = 'golden_hour';
	$sale_status[1] = 'Opening';
	for ($i = 2; $i <= 5; $i++) {
		$sale_color[$i] = 'normal_hour';
		$sale_status[$i] = 'Coming';
	}
}
if ($time > '03:15') {
	$sale_color[1] = 'end_hour';
	$sale_status[1] = 'Ended';
	for ($i = 2; $i <= 5; $i++) {
		$sale_color[$i] = 'normal_hour';
		$sale_status[$i] = 'Coming';
	}
}
if ($time >= '09:00' && $time <= '09:15') {
	$sale_color[2] = 'golden_hour';
	$sale_status[2] = 'Opening';
	for ($i = 3; $i <= 5; $i++) {
		$sale_color[$i] = 'normal_hour';
		$sale_status[$i] = 'Coming';
	}
}
if ($time > '09:15') {
	$sale_color[2] = 'end_hour';
	$sale_status[2] = 'Ended';
	for ($i = 3; $i <= 5; $i++) {
		$sale_color[$i] = 'normal_hour';
		$sale_status[$i] = 'Coming';
	}
}
if ($time >= '12:00' && $time <= '12:15') {
	$sale_color[3] = 'golden_hour';
	$sale_status[3] = 'Opening';
	for ($i = 4; $i <= 5; $i++) {
		$sale_color[$i] = 'normal_hour';
		$sale_status[$i] = 'Coming';
	}
}
if ($time > '12:15') {
	$sale_color[3] = 'end_hour';
	$sale_status[3] = 'Ended';
	for ($i = 4; $i <= 5; $i++) {
		$sale_color[$i] = 'normal_hour';
		$sale_status[$i] = 'Coming';
	}
}
if ($time >= '18:00' && $time <= '18:15') {
	$sale_color[4] = 'golden_hour';
	$sale_status[4] = 'Opening';
	$sale_color[5] = 'normal_hour';
	$sale_status[5] = 'Coming';
}
if ($time > '18:15') {
	$sale_color[4] = 'end_hour';
	$sale_status[4] = 'Ended';
	$sale_color[5] = 'normal_hour';
	$sale_status[5] = 'Coming';
}
if ($time >= '21:00' && $time <= '21:15') {
	$sale_color[5] = 'golden_hour';
	$sale_status[5] = 'Opening';
}
if ($time > '21:15') {
	$sale_color[5] = 'end_hour';
	$sale_status[5] = 'Ended';
}
?>
<div class="container-fluid padding">
	<div class="row text-center">
		<?php
		for ($i = 0; $i <= 5; $i++) {
		?>
			<div class="col-md-2 <?php echo $sale_color[$i]; ?>">
				<h3><?php echo $golden_time[$i]; ?></h3>
				<p><?php echo $sale_status[$i]; ?></p>
			</div>
		<?php
		}
		?>
	</div>
</div>

<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4 neonText">Welcome to Fun Flight</h1>
		</div>
		<!-- Horizontal Rule -->
		<hr>
		<div class="col-12">
			<p>Standing by you everywhere in the world</p>
		</div>
	</div>
</div>

<div class="container-fluid padding">
	<div class="row text-center">
		<div class="col-md-2 ">
			<a href="home_page.php?search=Vietnam Airlines"><img src="./Ảnh_website/logo_1.png" alt="" style="width: 200px;height: 100px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="home_page.php?search=jetstar"><img src="./Ảnh_website/logo_2.png" alt="" style="width: 200px;height: 100px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="home_page.php?search=bamboo"><img src="./Ảnh_website/logo_3.png" alt="" style="width: 200px;height: 100px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="home_page.php?search=fossil"><img src="./Ảnh_website/logo_4.png" alt="" style="width: 200px; height: 100px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="home_page.php?search=fendi"><img src="./Ảnh_website/logo_5.png" alt="" style="width: 200px;height: 100px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="home_page.php?search=Lipault"><img src="./Ảnh_website/logo_6.png" alt="" style="width: 200px;height: 100px"></a>
		</div>
	</div>
	<hr class="my-4">
</div>

<!-- photos of products and their infor -->
<?php
if (isset($_GET['search'])) {
	$ket_qua = $_GET['search'];
	$array = explode(" ", $ket_qua);
	$name = "brand LIKE '%" . $ket_qua . "%'; ";
	// foreach( $array as $array) {
	// 	$name .=	"productName LIKE '%".$array."%' OR ";
	// }
	// $name = rtrim($name, "OR ");
	$sql = "SELECT * FROM Flight WHERE $name";
	$statement = $connection->prepare($sql);
	$statement->execute();
	//Chế độ đọc dữ liệu ra
	$result = $statement->setFetchMode(PDO::FETCH_ASSOC);
	$sp = $statement->fetchAll();
	if (count($sp) > 0) {
?>
		<div class="container-fluid padding">
			<?php
			foreach ($sp as $sp) {
			?>
				<?php
				include './detail_product.php';
				?>
			<?php
			}
			?>
		</div>
	<?php
	}
} else {
	?>
	<div class="container-fluid padding">
		<hr>
		<a name="Vietnam Airlines">
			<h2 style="text-align: center;"><?php echo $filter = "Vietnam Airlines"; ?></h2>
		</a>
		<?php
		$sp = select_from($filter, $connection);
		foreach ($sp as $sp) {
			include './detail_product.php';
		}
		?>
	</div>
	<div class="container-fluid padding">
		<hr>
		<a name="jetstar">
			<h2 style="text-align: center;"><?php echo $filter = "Jetstar"; ?></h2>
		</a>
		<?php
		$sp = select_from($filter, $connection);
		foreach ($sp as $sp) {
			include './detail_product.php';
		}
		?>

	</div>
	<div class="container-fluid padding">
		<hr>
		<a name="bamboo">
			<h2 style="text-align: center;"><?php echo $filter = "Bamboo"; ?></h2>
		</a>
		<?php
		$sp = select_from($filter, $connection);
		foreach ($sp as $sp) {
			include './detail_product.php';
		}
		?>
	</div>
	<div class="container-fluid padding">
		<hr>
		<a name="Vietjet Air">
			<h2 style="text-align: center;"><?php echo $filter = "Vietjet Air"; ?></h2>
		</a>
		<?php
		$sp = select_from($filter, $connection);
		foreach ($sp as $sp) {
			include './detail_product.php';
		}
		?>
	</div>
	<div class="container-fluid padding">
		<hr>
		<a name="Emirates">
			<h2 style="text-align: center;"><?php echo $filter = "Emirates"; ?></h2>
		</a>
		<?php
		$sp = select_from($filter, $connection);
		foreach ($sp as $sp) {
			include './detail_product.php';
		}
		?>
	</div>
	<div class="container-fluid padding">
		<hr>
		<a name="Pacific Airlines">
			<h2 style="text-align: center;"><?php echo $filter = "Pacific Airlines"; ?></h2>
		</a>
		<?php
		$sp = select_from($filter, $connection);
		foreach ($sp as $sp) {
			include './detail_product.php';
		}
		?>
	</div>
	<div class="container-fluid padding">
		<hr>
		<a name="Vietjet Air">
			<h2 style="text-align: center;"><?php echo $filter = "Vietjet Air"; ?></h2>
		</a>
		<?php
		$sp = select_from($filter, $connection);
		foreach ($sp as $sp) {
			include './detail_product.php';
		}
		?>
	</div>
	<div class="container-fluid padding">
		<hr>
		<h2 style="text-align: center;"><?php echo $filter = "Others"; ?></h2>
		<?php
		$sql = "SELECT * FROM Flight WHERE brand != 'Vietnam Airlines' AND brand != 'Jetstar' 
		AND brand != 'Bamboo' AND brand != 'Vietjet Air' AND brand != 'Pacific Airlines' AND brand != 'Emirates';";
		$statement = $connection->prepare($sql);
		$statement->execute();
		//Chế độ đọc dữ liệu ra
		$result = $statement->setFetchMode(PDO::FETCH_ASSOC);
		$sp = $statement->fetchAll();
		foreach ($sp as $sp) {
			include './detail_product.php';
		}
		?>
	</div>
<?php
}
?>

<script src="./js/javascript.js"></script>
<?php
include './component/footer.php';
?>