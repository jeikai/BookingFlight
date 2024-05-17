<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form_product">
    <div class="col-md-4"style="width: 33.33333%;float: left;">
        <div class="card">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
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
                        $dem =0;
                        foreach( $anh_sp as $anh_sp) {
                            if ($dem ==0) {
                    ?>
                    <div class="carousel-item active">
                    <img class="d-block w-100" style="height: 500px;" src="./Ảnh_sp/<?php echo $anh_sp;?>" >
                    </div>
                    <?php
                            }
                        else {
                    ?>
                    <div class="carousel-item">
                    <img class="d-block w-100" style="height: 500px;" src="./Ảnh_sp/<?php echo $anh_sp;?>" >
                    </div>
                    <?php
                            }
                            $dem++;
                        }
                        $dem =0;
                    ?>
                </div>
                
            </div>
            <div class="card-body">
                <h4 class="card-title" ><?php echo $sp['productName'];?></h4>
                <input type="hidden" class="card-text" name="productId" value="<?php echo $sp['productId'];?> ">
                <p class="card-text" >Color: <?php echo $sp['color'];?></p>
                <p class="card-text" >Weight: <?php echo $sp['weight'];?></p>
                <p class="card-text">Gender: <?php echo $sp['gender']?></p>
                <p class="card-text">Category: <?php echo $sp['categoryName'];?></p>
                <p class="card-text" >Brand: <?php echo $sp['brand'];?></p>
                <input type="hidden" class="card-text" name="price" value="<?php echo $sp['price'];?> ">
                <p class="card-text">Price: <?php echo $sp['price'];?>$</p>
                <input type="submit" class="btn btn-outline-secondary" value="add to cart" name="add_to_cart">
            </div>
        </div>
    </div>
</form>		
