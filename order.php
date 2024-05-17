<?php
    include './component/header.php';
?>
    <?php
        $sql = "SELECT * FROM Orders WHERE userId = '$userId'; ";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC); 
        $bill = $statement->fetchAll();
        $productName = '';
        $price = '';
        $quantity = '';
        $dem =0;
        foreach( $bill as $bill) {
            $productName = explode(", ", $bill['productName']);
            $price = explode(", ", $bill['price']);
            $quantity = explode(", ", $bill['quantity']);
            
    ?>
    <div  style="margin-top: 70px;">
        <table class="table table-bordered">
            <h2>Bill No <?php  echo $dem++;?></h2>
            <h3>Date order: <?php echo $bill['orderDate'];?></h3>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <?php
                for( $i =0; $i < count($productName); $i++) {
            ?>
            <tbody>
                <tr>
                    <td><?php echo $productName[$i];?></td>
                    <td><?php echo $price[$i];?>$</td>
                    <td><?php echo $quantity[$i];?></td>
                </tr>
            </tbody>
            <?php
                }
            ?>
        </table>
        <h3>Price: <?php echo $bill['price_sum'];?>$</h3>
    </div>
    <?php
        }
    ?>
<?php
    include './component/footer.php';
?>