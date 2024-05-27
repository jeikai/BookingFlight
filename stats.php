<?php
include './component/header_as_admin.php';
$sql = "SELECT * FROM Orders;";
$statement = $connection->prepare($sql);
$statement->execute();
//Chế độ đọc dữ liệu ra
$result = $statement->setFetchMode(PDO::FETCH_ASSOC);
$orders = $statement->fetchAll();
$brands = [];
foreach ($orders as $order) {
    $flightNameString = $order['flightName'];
    $flightQuantity = $order['quantity'];
    $flightIds = explode(',', $flightNameString);
    $quantity = explode(',', $flightQuantity);
    foreach ($flightIds as $i => $flightId) {
        $flightSql = "SELECT brand FROM Flight WHERE flightId = '$flightId';";
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $flightStatement =  $connection->prepare($flightSql);
        $flightStatement->execute();
        $brand =  $flightStatement->fetch();
        if ($brand) {
            if (!isset($brands[$brand[0]])) {
                $brands[$brand[0]] = 0;
            }
            $brands[$brand[0]] += $quantity[$i];
        } else {
            $brands['Others'] += $quantity[$i];
        }
    }
}
$sum = 0;
foreach ($brands as $brand) {
    $sum += $brand;
}

?>

<link rel="stylesheet" href="./css/stats.css">
<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <ul class="chart">
        <li>
            <?php
            $percentage = isset($brands['Bamboo']) ? ($brands['Bamboo'] / $sum) * 100 : 0;

            $title = 'Bamboo' . ' _ ' . $percentage . '%';
            $style = "height: " . $percentage . "%;";
            ?>
            <span style="<?php echo $style; ?>" title="<?php echo $title; ?>"></span>
        </li>
        <li>
            <?php
            $percentage = isset($brands['Jetstar']) ? ($brands['Jetstar'] / $sum) * 100 : 0;

            $title = 'Jetstar' . ' _ ' . $percentage . '%';
            $style = "height: " . $percentage . "%;";
            ?>
            <span style="<?php echo $style; ?>" title="<?php echo $title; ?>"></span>
        </li>
        <li>
            <?php
            $percentage = isset($brands['Vietjet Air']) ? ($brands['Vietjet Air'] / $sum) * 100 : 0;

            $title = 'Vietjet Air' . ' _ ' . $percentage . '%';
            $style = "height: " . $percentage . "%;";
            ?>
            <span style="<?php echo $style; ?>" title="<?php echo $title; ?>"></span>
        </li>
        <li>
            <?php
            $percentage = isset($brands['Vietnam Airlines']) ? ($brands['Vietnam Airlines'] / $sum) * 100 : 0;

            $title = 'Vietnam Airlines' . ' _ ' . $percentage . '%';
            $style = "height: " . $percentage . "%;";
            ?>
            <span style="<?php echo $style; ?>" title="<?php echo $title; ?>"></span>
        </li>
        <li>
            <?php
            $percentage = isset($brands['Emirates']) ? ($brands['Emirates'] / $sum) * 100 : 0;

            $title = 'Emirates' . ' _ ' . $percentage . '%';
            $style = "height: " . $percentage . "%;";
            ?>
            <span style="<?php echo $style; ?>" title="<?php echo $title; ?>"></span>
        </li>
        <li>
            <?php
            $percentage = isset($brands['Pacific Airlines']) ? ($brands['Pacific Airlines'] / $sum) * 100 : 0;

            $title = 'Pacific Airlines' . ' _ ' . $percentage . '%';
            $style = "height: " . $percentage . "%;";
            ?>
            <span style="<?php echo $style; ?>" title="<?php echo $title; ?>"></span>
        </li>
        <li>
            <?php
            $percentage = isset($brands['Others']) ? ($brands['Others'] / $sum) * 100 : 0;

            $title = 'Others' . ' _ ' . $percentage . '%';
            $style = "height: " . $percentage . "%;";
            ?>
            <span style="<?php echo $style; ?>" title="<?php echo $title; ?>"></span>
        </li>
    </ul>
    <h2>Revenue analysis</h2>
</form>

<?php
include './component/footer.php';
?>