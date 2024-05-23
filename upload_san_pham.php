<?php
include './component/header_as_admin.php';
$brand = htmlspecialchars($_POST['brand'] ?? '');
$startCity = htmlspecialchars($_POST['startCity'] ?? '');
$endCity = htmlspecialchars($_POST['endCity'] ?? '');
$startTime = htmlspecialchars($_POST['startTime'] ?? '');
$endTime = htmlspecialchars($_POST['endTime'] ?? '');
$totalCustomer = htmlspecialchars($_POST['totalCustomer'] ?? '');
$remainingCustomer = htmlspecialchars($_POST['remainingCustomer'] ?? '');
$standardPrice = htmlspecialchars($_POST['standardPrice'] ?? '');
$isRoundTrip = htmlspecialchars($_POST['isRoundTrip'] ?? '');
$flightId = time();
if (isset($_POST['submit'])) {

    if (empty($productName) || empty($weight) || empty($color) || empty($categoryName) || empty($price) || empty($brand)) {
        $error_message = "You must enter full information";
    } else {
        if ($connection != NULL) {
            $sql = "SELECT COUNT(*) AS count FROM Flight WHERE startCity='$startCity' AND endCity='$endCity' AND startTime='$startTime' AND brand='$brand' ";
            try {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $connection->prepare($sql);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                //Kiểm tra xem dữ liệu bản ghi đã tồn tại hay chưa
                if (intval($statement->fetchAll()[0]['count']) > 0) {
                    $error_message = "Sản phẩm đã tồn tại";
                } else {

                    $sql = "INSERT INTO Flight(flightId, brand, startCity, endCity, startTime, endTime, totalCustomer, remainingCustomer) 
                            VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
                    $connection->prepare($sql)->execute([$productId, $weight, $color, $price, $productName, $categoryName, $gender, $brand, $productId, $anh_sp]);
                    $error_message = '<p style= "color: green;">Thêm sản phẩm thành công</p>';
                };
            } catch (PDOException $e) {
                echo "Cannot execute sql: " . $e->getMessage();
            }
        }
    }
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $sql = "DELETE FROM Flight WHERE flightId = $delete_id;";
    $connection->prepare($sql)->execute();
    header('Location: ./upload_san_pham.php');
}
?>

<head>
    <link rel="stylesheet" href="./css/upload_san_pham.css">
</head>
<h1 style="text-align: center;">Uploading Table</h1>
<hr>
<div style="margin-left: 300px;">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <table style="width: 50%;height: 500px;">
            <tr>
                <td>From: </td>
                <td><input type="text" name="startCity" id="" require placeholder="Your flight start place"></td>
            </tr>
            <tr>
                <td>To: </td>
                <td><input type="text" name="endCity" id="" require placeholder="Your flight destination"></td>
            </tr>
            <tr>
                <td>Flight start: </td>
                <td><input type="date" name="startTime" id="" require placeholder="Your flight start time"></td>
            </tr>
            <tr>
                <td>Flight end: </td>
                <td>
                    <input type="date" name="endTime" require placeholder="Your flight end time">
                </td>
            </tr>
            <tr>
                <td>Total customer: </td>
                <td><input type="number" name="totalCustomer" id="" require placeholder="Total customer"></td>
            </tr>
            <tr>
                <td>Remaining customer: </td>
                <td><input type="number" name="remainingCustomer" id="" require placeholder="Remaining customer"></td>
            </tr>
            <tr>
                <td>Brand: </td>
                <td>
                    <input type="text" name="brand" list="listdata" id="data" placeholder="Brand name">
                    <datalist id="listdata">
                        <option>VICTORINOX</option>
                        <option>SAMONITE</option>
                        <option>HUBLOT</option>
                        <option>FOSSIL</option>
                        <option>FENDI</option>
                        <option>LIPAULT</option>
                    </datalist>
                </td>
            </tr>
            <tr>
                <td>Price: </td>
                <td><input type="number" min=0 name="standardPrice" id="" require placeholder="Price of your flight"></td>
            </tr>
        </table>

        <input type="submit" value="submit" name="submit" class="btn-lg">
    </form>
    <p style="color: red;"><?php echo $error_message ?? '' ?></p>
</div>
<caption>
    <h2 class="title">Uploaded Flight</h2>
</caption>
<table border="1px" width="100%" cellspacing="0" cellpadding="5px">

    <thead align="center">
        <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>From</th>
            <th>To</th>
            <th>Start time</th>
            <th>End time</th>
            <th>Total Customer</th>
            <th>Remaining Customer</th>
            <th>Price</th>
            <th>Round trip</th>
            <th></th>
        </tr>
    </thead>
    <tbody align="center">
        <?php

        $sql = "SELECT * FROM Flight";
        $statement = $connection->prepare($sql);
        $statement->execute();
        //Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        $sp = $statement->fetchAll();
        foreach ($sp as $sp) {
        ?>
            <tr>
                <td><?php echo $sp['flightId']; ?></td>
                <td><?php echo $sp['brand']; ?></td>
                <td><?php echo $sp['startCity']; ?>kg</td>
                <td><?php echo $sp['endCity']; ?></td>
                <td><?php echo $sp['startTime'] ?></td>
                <td><?php echo $sp['endTime']; ?></td>
                <td><?php echo $sp['totalCustomer']; ?></td>
                <td><?php echo $sp['remainingCustomer']; ?></td>
                <td><?php echo $sp['standardPrice']; ?>$</td>
                <td><?php echo $sp['isRoundTrip']; ?></td>
                <td><a href="./<?php echo 'upload_san_pham.php?delete=' . $sp['flightId']; ?>" onclick="return confirm('are your sure you want to delete this?');"><i class="fas fa-trash"></i>Delete</a></td>
                <td><a href="./<?php echo 'update.php?edit=' . $sp['flightId']; ?>"><i class="fas fa-edit"></i>Update</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</body>

</html>

<?php
include './component/footer.php';
?>