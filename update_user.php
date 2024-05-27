<?php
include './component/header_as_admin.php';
$error = '';
if (!isset($_GET['edit'])) {
    header('Location: ./admin_user.php');
}
$edit_id = $_GET['edit'];
?>
<div style="margin-left: 300px;">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <table style="width: 50%;height: 300px;">
            <?php
            $sql_update = "SELECT * FROM Users WHERE userId = $edit_id";
            try {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $connection->prepare($sql_update);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $product = $statement->fetchAll();
                foreach ($product as $product) {
            ?>
                    <tr>
                        <input type="hidden" name="id" value="<?php echo $product['userId']; ?>" id="">
                    </tr>
                    <tr>
                        <td>Name: </td>
                        <td><input type="text" class="box" name="userName" value="<?php echo $product['userName']; ?>" id=""></td>
                    </tr>
                    <tr>
                        <td>Phone: </td>
                        <td><input type="text" class="box" name="phoneNumber" value="<?php echo $product['phoneNumber']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Address: </td>
                        <td><input type="text" class="box" name="address" value="<?php echo $product['address']; ?>" id=""></td>
                    </tr>
            <?php
                }
            } catch (PDOException $e) {
                echo "Cannot execute sql: " . $e->getMessage();
            }
            ?>

        </table>
        <p style="color: red;"><?php echo $error; ?></p>
        <input type="submit" value="Update" name="update_user" class="btn-lg" id="">
        <input type="submit" value="Cancel" name="cancel" class="btn-lg">
    </form>
</div>
<?php
if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $userName = $_POST['userName'] ?? '';
    $phoneNumber = $_POST['phoneNumber'] ?? '';
    $address = $_POST['address'] ?? '';

    $sql = "UPDATE Users 
        SET userName = '$userName', phoneNumber = '$phoneNumber', 
        address = '$address' WHERE userId = '$id';";
    $connection->prepare($sql)->execute();
    header('Location: ./admin_user.php');
} else if (isset($_POST['cancel'])) {
    header('Location: ./admin_user.php');
}

include './component/footer.php';
?>