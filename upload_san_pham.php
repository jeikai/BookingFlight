<?php
    include './component/header_as_admin.php';
    $productName = htmlspecialchars( $_POST['productName'] ?? '');
    $weight = htmlspecialchars( $_POST['weight'] ?? '');
    $color = htmlspecialchars( $_POST['color'] ?? '');
    $categoryName = htmlspecialchars( $_POST['categoryName'] ?? '');
    $price = htmlspecialchars( $_POST['price'] ?? '');
    $brand = htmlspecialchars( $_POST['brand'] ?? '');
    $gender = htmlspecialchars( $_POST['gender'] ?? '');
    $check = false;
    $productId = time();
    if ( isset($_POST['submit'])) {
        //Kiểm duyệt file ảnh
        $permitted_extensions = ['png', 'jpg', 'jpeg', 'gif'];
        //Tên file
        $file_name = $_FILES['imgUrls']['name'];
        $count_img = 0;
        for ( $i =0; $i<5; $i++) {
            
            if ( $file_name[$i] ) {
                $count_img++;
            }
            if ( empty($file_name[$i + 1]) ) {
                break;
            }
        }
        if( !empty( $file_name )) {
            
            //Nơi nguồn
            $file_tmp_name = $_FILES['imgUrls']['tmp_name'];
 
            //nơi đích chứa file được upload lên
            $destination[] = "";
            $anh_sp = "";
            for ( $i =0; $i < $count_img; $i++) {
                $destination[$i] = "./Ảnh_sp/".$file_name[$i];
                $anh_sp .= $file_name[$i].', ';
                //Lấy ra đuôi file bằng hàm explode
                //Khi gặp dấu chấm, hàm sẽ tách chuỗi đó ra
                //end: lấy phần tử cuối trong mảng
                $file_extension[$i] = explode('.', $file_name[$i]);
                $file_extension[$i] = strtolower(end($file_extension[$i]));
            }
            $anh_sp = rtrim( $anh_sp, ", ");
            //Kiểm tra tên file
            for ( $i =0; $i < $count_img; $i++) {
            if ( in_array($file_extension[$i], $permitted_extensions)) {
                    $check = true; 
            } else {
                $error_message = 'Invalid file type';
                break;
            }
            }
        if ( empty($productName) || empty($weight) || empty($color) || empty($categoryName) || empty($price) || empty($brand)) {
            $error_message = "You must enter name, weight, color, category, brand and price.";
        } else {
            if ( $connection != NULL) {
                $sql = "SELECT COUNT(*) AS count FROM Products WHERE productName='$productName' AND weight='$weight' AND color='$color' AND categoryName='$categoryName' AND price='$price' AND brand='$brand' ";            
            try {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $connection->prepare($sql); 
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC); 
                //Kiểm tra xem dữ liệu bản ghi đã tồn tại hay chưa
                if(intval($statement->fetchAll()[0]['count']) > 0) {
                    $error_message = "Sản phẩm đã tồn tại";
                } else {
                    //ok to insert
                    if ($check ) {
                        for ( $i =0; $i < $count_img; $i++) {
                        //Upload file từ nơi nguồn lên đích là destination
                        move_uploaded_file($file_tmp_name[$i], $destination[$i]);
                        }
                    }
                        
                        $sql = "INSERT INTO Products(productId, weight, color, price, productName, categoryName, gender, brand) 
                            VALUES(?, ?, ?, ?, ?, ?, ?, ?);
                            INSERT INTO Image_Product(productId, imageUrls) VALUES( ?, ?);";                    
                        $connection->prepare($sql)->execute([$productId, $weight, $color, $price, $productName, $categoryName, $gender, $brand, $productId, $anh_sp]);
                        $error_message = '<p style= "color: green;">Thêm sản phẩm thành công</p>';
                };
            } catch(PDOException $e) {
                echo "Cannot execute sql: " . $e->getMessage();
            }
            }
        }
        } else {
            $error_message = 'No such file selected';
        }
 
    }
    if ( isset( $_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $sql = "DELETE FROM Products WHERE productId = $delete_id; 
        DELETE FROM Image_Product WHERE productID = $delete_id";
        $connection->prepare($sql)->execute();
        header('Location: ./upload_san_pham.php');
    }
?>
<head>
    <link rel="stylesheet" href="./css/upload_san_pham.css">
</head>
<h1 style="text-align: center;">Uploading Table</h1>
<hr>
<div  style="margin-left: 300px;" >
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  enctype="multipart/form-data">
        <table style="width: 50%;height: 300px;">
            <tr>
                <td>Name: </td>
                <td><input type="text" name="productName" id="" require placeholder="Your product name"></td>      
            </tr>
            <tr>
                <td>Weight: </td>
                <td><input type="number" name="weight" id="" min=0 require placeholder="Your product weight"></td>
            </tr>
            <tr>
                <td>Color: </td>
                <td><input type="text" name="color" id="" require placeholder="Your product color"></td>
            </tr>
            <tr>
                <td>Category: </td>
                <td>
                    <input type="text" name="categoryName" list="listdata" require placeholder="Your type">
                    <datalist id="listdata">
                            <option value="adult">ADULT</option>
                            <option value="children">CHILDREN</option>
                            <option value="teenager">TEENAGER</option>
                    </datalist> 
                </td>
            </tr>
            <tr>
                <td>Gender: </td>
                <td>
                    <select name="gender" id="">
                        <option value="male" selected>Nam</option>
                        <option value="female" >Nữ</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Brand: </td>
                <td>
                    <input type="text" name="brand" id="data" placeholder="Brand name">
                    <datalist id="data">
                            <option >VICTORINOX</option>
                            <option >SAMONITE</option>
                            <option >HUBLOT</option>
                            <option >FOSSIL</option>
                            <option >FENDI</option>
                            <option >LIPAULT</option>
                    </datalist>
                </td>
            </tr>
            <tr>
                <td>Image:</td>
                <td>
                    <input type="file" name="imgUrls[]" require multiple>
                </td>

            </tr>
            <tr>
                <td>Price: </td>
                <td><input type="number" name="price" id="" require placeholder="Price of your product"></td>
            </tr>
        </table>
        
        <input type="submit" value="submit" name="submit" class="btn-lg">
    </form>
    <p style= "color: red;"><?php echo $error_message ?? '' ?></p>
</div>
<caption ><h2 class="title">Uploaded Products</h2></caption>
<table border="1px" width="100%" cellspacing="0" cellpadding="5px" >
    
    <thead align="center">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Weight</th>
        <th>Color</th>
        <th>Gender</th>
        <th>Brand</th>
        <th>Brand</th>
        <th>Image</th>
        <th>Price</th>
        <th></th>
    </tr>
    </thead>
    <tbody align="center">
    <?php
        
        $sql = "SELECT * FROM Products";
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
        <td><?php echo $sp['weight'];?>kg</td>
        <td><?php echo $sp['color'];?></td>
        <td><?php echo $sp['gender']?></td>
        <td><?php echo $sp['categoryName'];?></td>
        <td><?php echo $sp['brand'];?></td>
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
        <td><?php echo $sp['price'];?>$</td>
        <td><a  href="./<?php echo 'upload_san_pham.php?delete='.$sp['productId'];?>" onclick="return confirm('are your sure you want to delete this?');"><i class="fas fa-trash"></i>Delete</a></td>
        <td><a href="./<?php echo 'update.php?edit='.$sp['productId'];?>"><i class="fas fa-edit"></i>Update</a></td>
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