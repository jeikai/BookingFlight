<?php
    include './component/header.php';
    
    if ( isset( $_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $sql = "DELETE FROM orderdetails WHERE productId = $delete_id";
        $connection->prepare($sql)->execute();
        header('Location: ./cart.php');
    }
    if ( isset( $_POST['update_update_btn'])) {
        $update_value = $_POST['update_quantity'];
        $update_id = $_POST['update_quantity_id'];
        if ( $update_value >= 1) {
        $sql = "UPDATE orderdetails SET quantity = $update_value WHERE productId = $update_id";
        $connection->prepare($sql)->execute();
        header('Location: ./cart.php');
        }
    }
    if(isset($_GET['delete_all'])){
        $sql = "DELETE FROM orderdetails";
        $connection->prepare($sql)->execute();
        header('Location: ./cart.php');
    }
?>
<head>
    <link rel="stylesheet" href="./css/cart.css">
</head>

<div class="container">
<section class="shopping-cart">
<h1 class="heading">shopping cart</h1>
<table>
    <thead >
        <th>ID</th>
        <th style="width: 400px;">Name</th>
        <th>Price</th>
        <th>Image</th>
        <th style="width: 400px;">Quantity</th>
        <th></th>
    </thead>
    <tbody>
        <?php
            $sale = '';
            $grand_total =0;
            $sql = "SELECT * FROM orderdetails a JOIN Products b 
            ON a.productId = b.productId WHERE a.userId = $userId";
            $statement = $connection->prepare($sql);
            $statement->execute();
            //Chế độ đọc dữ liệu ra
            $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
            $sp = $statement->fetchAll();
            foreach( $sp as $sp) {
        ?>
        <tr>
            <td><?php echo $sp['productId'];?></td>
            <td><?php echo $sp['productName'];?></td>
            <td><?php echo $sum = $sp['price'] * $sp['quantity'];?>$</td>
            <?php
            $id = $sp['productId'];
            $sql = "SELECT * FROM Image_Product WHERE productId = '$id'; ";
            $statement = $connection->prepare($sql);
            $statement->execute();
            //Chế độ đọc dữ liệu ra
            $result = $statement->setFetchMode ( PDO::FETCH_ASSOC);
            $img = $statement->fetchAll();
            $anh_sp = '';
            foreach( $img as $img) {
                $anh_sp = explode(', ', $img['imageUrls']);
            }
            foreach( $anh_sp as $anh_sp) {
        ?>
        <td><img style="width: 100px;" src="./Ảnh_sp/<?php echo $anh_sp;?>"></td>
        <?php
            break;
            }
        ?>
            <td>
            <form action="" method="post">
                <input type="hidden" name="update_quantity_id"  value="<?php echo $sp['productId']; ?>" >
                <input type="number" name="update_quantity" min="1"  value="<?php echo $sp['quantity']; ?>" >
                <input type="submit" value="update" name="update_update_btn">
            </form>
            </td>
            <td><a href="./<?php echo 'cart.php?delete='.$sp['productId'];?>" onclick="return confirm('are your sure you want to delete this?');"><i class="fas fa-trash"></i>Delete</a></td>
        </tr>
        <?php
            $grand_total += $sum;
            }
            if ( ($time >= '00:00' && $time <= '00:15')
            || ($time >= '03:00' && $time <= '03:15') 
            || ($time >= '09:00' && $time <= '09:15') 
            || ($time >= '12:00' && $time <= '12:15') 
            || ($time >= '18:00' && $time <= '18:15') 
            || ($time >= '21:00' && $time <= '21:15')) {
                $grand_total -= $grand_total * (30/100);
                $sale = "Sale up to 30% in golden hour frame";
            } 
        ?>
        <tr class="table-bottom">
            <td colspan="4">grand total</td>
            <td>$<?php echo $grand_total; ?>/- <?php echo $sale;?></td>
            <td><a href="./cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
        </tr>
    </tbody>
</table>
<div class="checkout-btn">
      <a href="./checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
</div>
</section>
</div>
<?php
    include './component/footer.php';
?>