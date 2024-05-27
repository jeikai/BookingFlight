<?php
include './component/header_as_admin.php';
$error = '';
if (!isset($_GET['edit'])) {
    header('Location: ./upload_san_pham.php');
}
$edit_id = $_GET['edit'];
?>
<div style="margin-left: 300px;">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <table style="width: 50%;height: 500px;">
            <?php
            $sql_update = "SELECT * FROM Flight WHERE flightId = $edit_id";
            try {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $connection->prepare($sql_update);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $product = $statement->fetchAll();
                foreach ($product as $product) {
            ?>
                    <tr>
                        <input type="hidden" name="id" value="<?php echo $product['flightId']; ?>" id="">
                    </tr>
                    <tr>
                        <td>Brand: </td>
                        <td><input type="text" class="box" name="brand" value="<?php echo $product['brand']; ?>" id=""></td>
                    </tr>
                    <tr>
                        <td>From: </td>
                        <td><input type="text" class="box" name="startCity" value="<?php echo $product['startCity']; ?>"></td>
                    </tr>
                    <tr>
                        <td>To: </td>
                        <td><input type="text" class="box" name="endCity" value="<?php echo $product['endCity']; ?>" id=""></td>
                    </tr>
                    <tr>
                        <td>Start time: </td>
                        <td>
                            <input type="datetime-local" class="box" name="startTime" value="<?php echo $product['startTime']; ?>" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>End time: </td>
                        <td>
                            <input type="datetime-local" class="box" name="endTime" value="<?php echo $product['endTime']; ?>" id="">
                    </tr>
                    <tr>
                        <td>Total customer: </td>
                        <td>
                            <input type="number" min=0 class="box" name="totalCustomer" value="<?php echo $product['totalCustomer']; ?>" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>Remaining customer:</td>
                        <td>
                            <input type="number" min=0 class="box" name="remainingCustomer" value="<?php echo $product['remainingCustomer']; ?>" id="">
                        </td>

                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="standardPrice" min=0 id="" require value="<?php echo $product['standardPrice']; ?>">$</td>
                    </tr>


            <?php
                }
            } catch (PDOException $e) {
                echo "Cannot execute sql: " . $e->getMessage();
            }
            ?>

        </table>
        <p style="color: red;"><?php echo $error; ?></p>
        <input type="submit" value="Update" name="update_product" class="btn-lg" id="">
        <input type="submit" value="Cancel" name="cancel" class="btn-lg">
    </form>
</div>
<?php
if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $brand = $_POST['brand'] ?? '';
    $startCity = $_POST['startCity'] ?? '';
    $endCity = $_POST['endCity'] ?? '';
    $startTime = $_POST['startTime'] ?? '';
    $endTime = $_POST['endTime'] ?? '';
    $totalCustomer = $_POST['totalCustomer'] ?? 0;
    $remainingCustomer = $_POST['remainingCustomer'] ?? 0;
    $standardPrice = $_POST['standardPrice'] ?? 0;

    $sql = "UPDATE Flight 
        SET brand = '$brand', startCity = '$startCity', 
        endCity = '$endCity', startTime = '$startTime', endTime = '$endTime', 
        totalCustomer = '$totalCustomer', remainingCustomer = '$remainingCustomer', standardPrice = '$standardPrice' WHERE flightId = '$id';";
    $connection->prepare($sql)->execute();
    header('Location: ./upload_san_pham.php');
} else if (isset($_POST['cancel'])) {
    header('Location: ./upload_san_pham.php');
}

include './component/footer.php';
?>