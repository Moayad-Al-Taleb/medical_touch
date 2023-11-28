<?php

session_start();

require 'static_functions.php';

$user_name = $pass = "";
$user_name_error = $pass_error = "";

if (isset($_POST['btn_send'])) {

    if (empty($_POST['user_name'])) {
        $user_name_error = "Field is required *";
    } else {
        $user_name = examine_values($_POST['user_name']);
    }

    if (empty($_POST['pass'])) {
        $pass_error = "Field is required *";
    } else {
        $pass = sha1(examine_values($_POST['pass']));
    }

    if (!empty($user_name) && !empty($pass)) {

        require 'connect.php';

        $sql = "SELECT * FROM doctors WHERE user_name='$user_name' AND password='$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            $_SESSION['id'] = $row['id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['account_status'] = $row['account_status'];
            $_SESSION['activity_status'] = $row['activity_status'];
            $_SESSION['account_type'] = $row['account_type'];

            $id = $row['id'];
            edit_account_activity_status_1(1, $id);

            $session = $_SESSION;
            check_type_account($session);
        } else {
?>
            <script>
                alert("Please double-check your username and password and try again.");
            </script>
<?php
        }
        $conn->close();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form">
            <h3>sign in</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="input-field">
                    <div>
                        <label for="user_name">username</label>
                        <?php echo $user_name_error ?>
                    </div>
                    <input type="text" name="user_name" id="user_name">
                </div>

                <div class="input-field">
                    <div>
                        <label for="pass">pasword</label>
                        <?php echo $pass_error ?>
                    </div>
                    <input type="password" name="pass" id="pass" required>
                </div>

                <input type="submit" value="sign in" name="btn_send" class="submit-btn">
                In case you forgot your password, click on the following link:<a href="password_recovery.php">Password Recovery</a>
            </form>
        </div>
        <div class="img">
            <img src="./assets/imgs/1.PNG" alt="">
        </div>
    </div>
</body>

</html>