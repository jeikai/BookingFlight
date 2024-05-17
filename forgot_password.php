<?php
    include './component/database.php';
    $error = '';
    $phoneNumber = htmlspecialchars( $_POST['phoneNumber'] ?? '');
    $password = htmlspecialchars( $_POST['password'] ?? '');
    if ( isset( $_POST['submit']) ) {

        if (  empty($phoneNumber) || empty($password) ) {
            $error = "You must enter your username, password, phonenumber, address and your role";
        } else { 
            if ( $connection != NULL) {
                $sql = "SELECT COUNT(*) AS count FROM Users WHERE phoneNumber='$phoneNumber';";            
            try {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $connection->prepare($sql); 
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC); 
                //Kiểm tra xem dữ liệu bản ghi đã tồn tại hay chưa
                if(intval($statement->fetchAll()[0]['count']) > 0) {
                    $sql = "UPDATE Users SET password = ? WHERE phoneNumber = ? ;";
                    $connection->prepare($sql)->execute([$password, $phoneNumber]);
                    $error = "Reset password successfully";
                } else {
                    $error = "Wrong phonenumber. Cannot reset password.";
                };
            } catch(PDOException $e) {
                echo "Cannot execute sql: " . $e->getMessage();
            }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <meta name="viewport" content="wisth=device-width, intial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
</head>

<body style="background: #cbced3;">

    <div class="container">
        <div class="title">Reset your password.</div>
        
            <div class="user-details">
                <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="text" placeholder="Enter your number"  name="phoneNumber">
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" placeholder="Enter your password"  name="password">
                </div>
                <div class="input-box">
                    <a href="./log_in.php">Back to log in page.</a>
                </div>
                <div class="input-box">
                    <p style="color: red;"><?php echo $error;?></p>
                </div>
                <div class="button">
                    <input type="submit" value="Change password" name="submit">
                    
                </div>
                </form>
            </div>
        </form>
    </div>
    
</body>

</html>
