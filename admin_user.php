<?php
include './component/header_as_admin.php';
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $sql = "DELETE FROM Users WHERE userId = $delete_id;";
    $connection->prepare($sql)->execute();
    header('Location: ./admin_user.php');
}
?>

<head>
    <link rel="stylesheet" href="./css/upload_san_pham.css">
</head>
<caption>
    <h2 class="title">Manage Users</h2>
</caption>
<table border="1px" width="100%" cellspacing="0" cellpadding="5px">
    <thead align="center">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th></th>
        </tr>
    </thead>
    <tbody align="center">
        <?php

        $sql = "SELECT * FROM Users WHERE role != 'admin';";
        $statement = $connection->prepare($sql);
        $statement->execute();
        //Chế độ đọc dữ liệu ra
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        $sp = $statement->fetchAll();
        foreach ($sp as $sp) {
        ?>
            <tr>
                <td><?php echo $sp['userId']; ?></td>
                <td><?php echo $sp['userName']; ?></td>
                <td><?php echo $sp['phoneNumber']; ?></td>
                <td><?php echo $sp['address']; ?></td>
                <td><a href="./<?php echo 'admin_user.php?delete=' . $sp['userId']; ?>" onclick="return confirm('are your sure you want to delete this?');"><i class="fas fa-trash"></i>Delete</a></td>
                <td><a href="./<?php echo 'update_user.php?edit=' . $sp['userId']; ?>"><i class="fas fa-edit"></i>Update</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
include './component/footer.php';
?>