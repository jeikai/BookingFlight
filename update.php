<?php
    include './component/header_as_admin.php';
    $error = '';
    if( !isset( $_GET['edit'])) {
        header('Location: ./upload_san_pham.php');
    }
    $edit_id = $_GET['edit'];
?>
<div  style="margin-left: 300px;" >
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  enctype="multipart/form-data">
    <table>
    <?php 
    $sql_update = "SELECT * FROM Flight WHERE flightId = $edit_id";
    try {        
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        $statement = $connection->prepare($sql_update);
        $statement->execute();
        $statement->setFetchMode ( PDO::FETCH_ASSOC);
        $product = $statement->fetchAll();
        foreach ( $product as $product) {
    ?>
            <tr>
                <input type="hidden" name="id" value="<?php echo $product['flightId'];?>" id="">
            </tr>
            <tr>
                <td>Brand: </td>
                <td><input type="text" class="box" name="brand" value="<?php echo $product['brand'];?>" id=""></td>      
            </tr>
            <tr>
                <td>Weight: </td>
                <td><input type="number" min="0" class="box"  name="update_weight" value="<?php echo $product['weight'];?>"></td>
            </tr>
            <tr>
                <td>Color: </td>
                <td><input type="text" class="box" name="update_color" value="<?php echo $product['color'];?>" id=""></td>
            </tr>
            <tr>
                <td>Category: </td>
                <td>
                <input type="text" class="box" name="update_category" value="<?php echo $product['categoryName'];?>" id="">
                </td>
            </tr>
            <tr>
                <td>Gender: </td>
                <td>
                <input type="text" class="box" name="update_gender" value="<?php echo $product['gender'];?>" id="">
            </tr>
            <tr>
                <td>Brand: </td>
                <td>
                <input type="text" class="box" name="update_brand" value="<?php echo $product['brand'];?>" id="">
                </td>
            </tr>
            <tr>
                <td>Picture:</td>
                <td>
                <input type="file" class="box"  name="update_image[]" accept="image/png, image/jpg, image/jpeg" multiple>
                </td>

            </tr>
            <tr>
                <td>Price: </td>
                <td><input type="number" name="price" min=0 id="" require value="<?php echo $product['price'];?>">$</td>
            </tr>
        
    
    <?php
        }
        
        } catch(PDOException $e) {
            echo "Cannot execute sql: " . $e->getMessage();
        }
    ?>
    
    </table>
    <p style="color: red;"><?php echo $error;?></p>
    <input type="submit" value="Update" name="update_product" class="btn-lg" id="">
    <input type="submit" value="Cancel" name="cancel" class="btn-lg">
    </form>
</div>
<?php
    if ( isset($_POST['update_product'])) {
        $id = $_POST['id'];
        $update_name = $_POST['update_name'] ?? '';
        $update_price = $_POST['price'] ?? '';
        $update_weight = $_POST['update_weight'] ?? '';
        $update_color = $_POST['update_color'] ?? '';
        $update_brand = $_POST['update_brand'] ?? '';
        $update_gender = $_POST['update_gender'] ?? '';
        $update_category = $_POST['update_category'] ?? '';

        $update_image = $_FILES['update_image']['name'] ?? '';
        $count_img = 0;
        $destination[] = "";
        for ( $i =0; $i<5; $i++) {
            if ( $update_image[$i] ) {
                $count_img++;
            }
            if ( empty($update_image[$i + 1]) ) {
                break;
            }
            $destination = "./Ảnh_sp/".$update_name[$i];
        }
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $anh_sp = "";
        for ( $i =0; $i < $count_img; $i++) {
            move_uploaded_file( $update_image_tmp_name[$i], $destination[$i]);
            $anh_sp .= $update_image[$i].', ';
        }
        $anh_sp = rtrim( $anh_sp, ", ");
        echo $anh_sp;
        $sql = "UPDATE Products 
        SET productName = '$update_name', weight = '$update_weight', 
        color = '$update_color', price = '$update_price', categoryName = '$update_category', 
        brand = '$update_brand', gender = '$update_gender' WHERE productId = '$id';
        UPDATE Image_Product SET imageUrls = '$anh_sp' WHERE productId = '$id';";
        $connection->prepare( $sql )->execute();
        header('Location: ./upload_san_pham.php');
    }
    else if ( isset($_POST['cancel'])) {
        header('Location: ./upload_san_pham.php');
    }

    include './component/footer.php';
?>