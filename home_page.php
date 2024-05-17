<?php 
	include './component/header.php';
	
	if(isset($_POST['add_to_cart'])){
		$quantity = 1;
		$productId = $_POST['productId'];
		$price = $_POST['price'];
		$orderId = time();
		try {
			$sql = "SELECT * FROM orderdetails WHERE productId = '$productId';";
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$statement = $connection->prepare($sql);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_ASSOC); 
			$result = $statement->fetchAll();
			
			//Kiểm tra xem dữ liệu bản ghi đã tồn tại hay chưa
			if( count($result) > 0) {
				$message[] = 'product already added to cart';
			} else {
				
				$insert = "INSERT INTO  orderdetails(OrderDetailID, quantity, productId, price, userId) 
					VALUES( $orderId, $quantity, $productId, $price, $userId);";
				$connection->prepare($insert)->execute();
				$message[] = 'product added to cart succesfully';
				$page = $_SERVER['PHP_SELF'];
				$sec = "1.5";
				header("Refresh: $sec; url=$page");
			}
		} catch(PDOException $e) {
			echo "Cannot execute sql: " . $e->getMessage();
		}
	}
	$filter = '';
	function select_from($filter, $connection) {
		$sql = "SELECT * FROM Products WHERE brand = '$filter';";
		$statement = $connection->prepare($sql);
        $statement->execute();
    	//Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
		$sp = $statement->fetchAll();
		return $sp;
	}
?>
<!-- Notification -->
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>

<!-- Slide show -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="margin-top: 35px;">
  <div class="carousel-inner">
    <div class="carousel-item active">
		<img src="./Ảnh_website/anh1.png" class="d-block w-100">
    </div>
    <div class="carousel-item">
		<img src="./Ảnh_website/anh2.png" class="d-block w-100">
    </div>
    <div class="carousel-item">
		<img src="./Ảnh_website/anh3.png" class="d-block w-100">
    </div>
	<div class="carousel-item">
		<img src="./Ảnh_website/anh4.png" class="d-block w-100">
    </div>
	<div class="carousel-item">
		<img src="./Ảnh_website/anh5.png" class="d-block w-100">
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
<div class="search-container nav-link" >
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
	$sale_status = array('', '','','','','');
	$golden_time = array("00:00", "03:00", "09:00", "12:00", "18:00", "21:00");
	if ( $time >= '00:00' && $time <= '00:15') {
		$sale_color[0] = 'golden_hour';
		$sale_status[0] = 'Opening';
		for ( $i =1; $i <= 5; $i++) {
				$sale_color[$i] = 'normal_hour';
				$sale_status[$i] = 'Coming';
		}
	}
	 if ( $time > '00:15') {
		$sale_color[0] = 'end_hour';
		$sale_status[0] = 'Ended';
		for ( $i =1; $i <= 5; $i++) {
			$sale_color[$i] = 'normal_hour';
			$sale_status[$i] = 'Coming';
		}
	}
	 if ( $time >= '03:00' && $time <= '03:15') {
		$sale_color[1] = 'golden_hour';
		$sale_status[1] = 'Opening';
		for ( $i =2; $i <= 5; $i++) {
				$sale_color[$i] = 'normal_hour';
				$sale_status[$i] = 'Coming';
		}
	}
	if ( $time > '03:15') {
		$sale_color[1] = 'end_hour';
		$sale_status[1] = 'Ended';
		for ( $i =2; $i <= 5; $i++) {
			$sale_color[$i] = 'normal_hour';
			$sale_status[$i] = 'Coming';
	}
	}
	if ( $time >= '09:00' && $time <= '09:15') {
		$sale_color[2] = 'golden_hour';
		$sale_status[2] = 'Opening';
		for ( $i =3; $i <= 5; $i++) {
				$sale_color[$i] = 'normal_hour';
				$sale_status[$i] = 'Coming';
		}
	}
	if ( $time > '09:15') {
		$sale_color[2] = 'end_hour';
		$sale_status[2] = 'Ended';
		for ( $i =3; $i <= 5; $i++) {
			$sale_color[$i] = 'normal_hour';
			$sale_status[$i] = 'Coming';
	}
	}
	if ( $time >= '12:00' && $time <= '12:15') {
		$sale_color[3] = 'golden_hour';
		$sale_status[3] = 'Opening';
		for ( $i =4; $i <= 5; $i++) {
				$sale_color[$i] = 'normal_hour';
				$sale_status[$i] = 'Coming';
		}
	}
	if ( $time > '12:15') {
		$sale_color[3] = 'end_hour';
		$sale_status[3] = 'Ended';
		for ( $i =4; $i <= 5; $i++) {
			$sale_color[$i] = 'normal_hour';
			$sale_status[$i] = 'Coming';
	}
	}
	if ( $time >= '18:00' && $time <= '18:15') {
		$sale_color[4] = 'golden_hour';
		$sale_status[4] = 'Opening';
		$sale_color[5] = 'normal_hour';
		$sale_status[5] = 'Coming';
	}
	if ( $time > '18:15') {
		$sale_color[4] = 'end_hour';
		$sale_status[4] = 'Ended';
		$sale_color[5] = 'normal_hour';
		$sale_status[5] = 'Coming';
	}
	if ( $time >= '21:00' && $time <= '21:15') {
		$sale_color[5] = 'golden_hour';
		$sale_status[5] = 'Opening';
	}
	if ( $time > '21:15') {
		$sale_color[5] = 'end_hour';
		$sale_status[5] = 'Ended';
	}
?>
<div class="container-fluid padding">
	<div class="row text-center">
		<?php
			for ( $i =0; $i <=5; $i++) {
		?>
		<div class="col-md-2 <?php echo $sale_color[$i];?>" >
			<h3><?php echo $golden_time[$i];?></h3>
			<p><?php echo $sale_status[$i];?></p>
		</div>
		<?php
			}
		?>
	</div>
</div>

<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4 neonText">Welcome to Bronx Luggage</h1>
		</div>
		<!-- Horizontal Rule -->
		<hr> 
		<div class="col-12">
			<p>Standing by you everywhere in the world</p>
		</div>
	</div>
</div>
<!-- Category -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="container-fluid padding">
	<div class="row text-center padding">		
		<div class="col-xs-12 col-sm-6 col-md-4 " >			
				<i class="fa fa-child"></i>	
				<h3>CHILDREN</h3>
				<p>4 - 12 years old</p>
				<input type="radio" name="category" value="children" id="">
		</div>		
		<div class="col-xs-12 col-sm-6 col-md-4">	
			<i class="fas fa-running"></i>			
			<h3>TEENAGER</h3>
			<p>13 - 18 years old</p>
			<input type="radio" value="teenager" name="category">
		</div>
		<div class="col-sm-12 col-md-4">
			<i class="fas fa-hiking"></i>
			<h3>ADULT</h3>
			<p>> 18 years old</p>
			<input type="radio" value="adult" name="category">

		</div>
		
	</div>	
	
	<hr class="my-4">	
</div>

<!-- Gender -->
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-md-4">
			
			<i class="fa fa-female"></i>	
			<h3>FEMALE</h3>
			<input type="radio" value="female" name="gender">	
		</div>
		<div class="col-md-4">
			<input type="submit" class="btn-lg" value="Find" name="" id="">
		</div>
		<div class="col-md-4">
			
			<i class="fa fa-male"></i>	
			<h3>MALE</h3>
			<input type="radio" value="male" name="gender">		
		</div>
	</div>	
	<hr class="my-4">	
</div>
</form>

<div class="container-fluid padding" >
	<div class="row text-center" >
		<div class="col-md-2 ">
			<a href="home_page.php?search=Victorinox"><img src="./Ảnh_website/logo_1.png" alt="" style="width: 200px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="home_page.php?search=samsonite"><img src="./Ảnh_website/logo_2.png" alt="" style="width: 200px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="home_page.php?search=hublot"><img src="./Ảnh_website/logo_3.png" alt="" style="width: 200px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="home_page.php?search=fossil"><img src="./Ảnh_website/logo_4.png" alt="" style="width: 200px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="home_page.php?search=fendi"><img src="./Ảnh_website/logo_5.png" alt="" style="width: 200px"></a>
		</div>
		<div class="col-md-2 ">
			<a href="home_page.php?search=Lipault"><img src="./Ảnh_website/logo_6.png" alt="" style="width: 200px"></a>
		</div>
	</div>
	<hr class="my-4">
</div>

<!-- photos of products and their infor -->
<?php
	$category = $_POST['category'] ?? '';
	$gender = $_POST['gender'] ?? '';
	if ( isset( $_POST['category']) && isset( $_POST['gender'])) {
		$sql = "SELECT * FROM Products WHERE categoryName = '$category' AND gender = '$gender'; ";
		$statement = $connection->prepare($sql);
        $statement->execute();
    	//Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
		$sp = $statement->fetchAll();
			foreach ( $sp as $sp) {
?>
		<?php
			include './detail_product.php';
		?>	
	<?php
		}
	
	}
	else if ( isset( $_POST['category'])) {
		$sql = "SELECT * FROM Products WHERE categoryName = '$category'; ";
		$statement = $connection->prepare($sql);
        $statement->execute();
    	//Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
		$sp = $statement->fetchAll();
			foreach ( $sp as $sp) {
	?>	
	<?php
			include './detail_product.php';
		?>	
	<?php 	
	
	}
	}else if ( isset( $_POST['gender'])) {
		$sql = "SELECT * FROM Products WHERE gender = '$gender'; ";
		$statement = $connection->prepare($sql);
        $statement->execute();
    	//Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
		$sp = $statement->fetchAll();
			foreach ( $sp as $sp) {	
	?>
	<?php
			include './detail_product.php';
		?>	
	<?php 
			}
	}
	else if( isset( $_GET['search'])) {
		$ket_qua = $_GET['search'] ;
		$array = explode(" ", $ket_qua);
		$name = "productName LIKE '%".$ket_qua."%'; ";
		// foreach( $array as $array) {
		// 	$name .=	"productName LIKE '%".$array."%' OR ";
		// }
		// $name = rtrim($name, "OR ");
		$sql = "SELECT * FROM Products WHERE $name";
		$statement = $connection->prepare($sql);
        $statement->execute();
    	//Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
		$sp = $statement->fetchAll();
		if ( count( $sp) >0) {
?>
<div class="container-fluid padding">
		<?php
			foreach ( $sp as $sp) {		
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
	<a  name="Victorinox"><h2 style="text-align: center;"><?php echo $filter ="Victorinox"; ?></h2></a>
	<?php 
		$sp = select_from($filter, $connection);
		foreach ( $sp as $sp) {
			include './detail_product.php';
		}
	?>
</div>
<div class="container-fluid padding">
	<hr>
	<a  name="samsonite"><h2 style="text-align: center;"><?php echo $filter ="Samsonite"; ?></h2></a>
	<?php 
		$sp = select_from($filter, $connection);
		foreach ( $sp as $sp) {
			include './detail_product.php';
		}
	?>

</div>
<div class="container-fluid padding">
	<hr>
	<a  name="hublot"><h2 style="text-align: center;"><?php echo $filter ="Hublot"; ?></h2></a>
	<?php 
		$sp = select_from($filter, $connection);
		foreach ( $sp as $sp) {
			include './detail_product.php';
		}
	?>
</div>
<div class="container-fluid padding">
	<hr>
	<a  name="fossil"><h2 style="text-align: center;"><?php echo $filter ="Fossil"; ?></h2></a>
	<?php 
		$sp = select_from($filter, $connection);
		foreach ( $sp as $sp) {
			include './detail_product.php';
		}
	?>
</div>
<div class="container-fluid padding">
	<hr>
	<a  name="fendi"><h2 style="text-align: center;"><?php echo $filter ="Fendi"; ?></h2></a>
	<?php 
		$sp = select_from($filter, $connection);
		foreach ( $sp as $sp) {
			include './detail_product.php';
		}
	?>
</div>
<div class="container-fluid padding">
	<hr>
	<a  name="lipault"><h2 style="text-align: center;"><?php echo $filter ="Lipault"; ?></h2></a>
	<?php 
		$sp = select_from($filter, $connection);
		foreach ( $sp as $sp) {
			include './detail_product.php';
		}
	?>
</div>
<div class="container-fluid padding">
	<hr>
	<h2 style="text-align: center;"><?php echo $filter ="Others"; ?></h2>
	<?php
		$sql = "SELECT * FROM Products WHERE brand != 'Victorinox' AND brand != 'samsonite' 
		AND brand != 'hublot' AND brand != 'fendi' AND brand != 'fossil' AND brand != 'lipault';";
		$statement = $connection->prepare($sql);
        $statement->execute();
    	//Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
		$sp = $statement->fetchAll();
		foreach ( $sp as $sp) {
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

