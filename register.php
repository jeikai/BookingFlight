<?php
    include './component/database.php';
    $error = '';
    $userId = time();
    $userName = htmlspecialchars( $_POST['userName'] ?? '');
    $phoneNumber = htmlspecialchars( $_POST['phoneNumber'] ?? '');
    $password = htmlspecialchars( $_POST['password'] ?? '');
    $role = htmlspecialchars( $_POST['role'] ?? '');
    $address = htmlspecialchars( $_POST['address'] ?? '');
    function validate($phoneNumber, $password) {
        if ( strlen($phoneNumber) != 10) {
            return false;
        } 
        if ( strlen($password) <=4) {
            return false;
        }
        return true;
    }
    if ( isset( $_POST['submit']) ) {
        
        
        if ( empty($userName) || empty($phoneNumber) || empty($password) || empty($role) || empty($address)) {
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
                    $error = "User exists";
                } else {
                    //ok to insert
                    if ( validate($phoneNumber, $password) ) {
                    $sql = "INSERT INTO Users(userId, userName, phoneNumber, address, password, role) VALUES(?, ?, ?, ?, ?, ?);";                    
                    $connection->prepare($sql)->execute([$userId, $userName, $phoneNumber, $address, $password, $role]);
                    $error = "Register user successfully";
                    header('Location: ./log_in.php');
                    }
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
        <div class="title">Registration</div>
        
            <div class="user-details">
                <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="register">
                <div class="input-box">
                    <span class="details">UserName</span>
                    <input type="text" placeholder="Enter your userName"  name="userName" value="<?php echo $userName;?>">
                </div>
                <div class="input-box">
                    <span class="details">Your address</span>
                    <input type="text" placeholder="Enter your address"  name="address" value="<?php echo $address;?>">
                </div>
                <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="number" placeholder="Enter your number"  name="phoneNumber" value="<?php echo $phoneNumber;?>">
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" placeholder="Enter your password"  name="password" value="<?php echo $password;?>">
                </div>
                <div class="input-box"> 
                    <span class="details">You are user or admin?</span>
                    <select name="role" id="">
                        <option value="user" selected>user</option>
                        <option value="admin" >admin</option>
                    </select>
                </div>
                <div class="input-box">
                    <a href="./log_in.php">Already have an account.</a>
                </div>
                <div class="input-box">
                    <p style="color: red;"><?php echo $error;?></p>
                </div>
                <div class="button">
                    <input type="submit" value="Register" name="submit" onclick="xuli()">
                    
                </div>
                </form>
            </div>
        </form>
    </div>
    
</body>
<script>
    function xuli() {
        with(register) {
            if ( phoneNumber.value.length != 10) {
                alert("Phone number must have 10 digits");
            }
            if ( password.value.length <=4) {
                alert( "Your password is too short!" );
            }
        }
    }
</script>
</html>
