<?php

session_start();

require '../../static_functions.php';

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

        require '../../connect.php';

        $sql = "SELECT * FROM patients WHERE user_name='$user_name' AND password='$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            $_SESSION['id'] = $row['id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['account_status'] = $row['account_status'];
            $_SESSION['activity_status'] = $row['activity_status'];
            $_SESSION['account_type'] = $row['account_type'];


            $id = $row['id'];
            edit_account_activity_status_2(1, $id);

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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <div class="login">
        <div class="overflow"></div>
        <div class="form">
            <span>sign in</span>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <input type="text" placeholder="username" name="user_name" id="user_name">
                    <svg class="icon" id="SvgjsSvg1090" width="300" height="300" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                        <defs id="SvgjsDefs1091"></defs>
                        <g id="SvgjsG1092"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                <path d="M88 23H12c-1.1 0-2 .9-2 2v50c0 1.1.9 2 2 2h76c1.1 0 2-.9 2-2V25c0-1.1-.9-2-2-2zm-4.8 4L50 60.2 16.8 27h66.4zM14 29.8 34.2 50 14 70.2V29.8zM16.9 73 37 52.9l11.6 11.6c.8.8 2 .8 2.8 0L63 52.9 83.1 73H16.9zM86 70.2 65.8 50 86 29.8v40.4z" fill="#50b3ba" class="color000 svgShape"></path>
                                <path fill="#0000ff" d="M804-510v1684H-980V-510H804m8-8H-988v1700H812V-518z" class="color00F svgShape"></path>
                            </svg></g>
                    </svg>
                </div>
                <div class="form-group">
                    <input type="password" placeholder="password" name="pass" id="pass">
                    <svg class="icon" id="SvgjsSvg1072" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                        <defs id="SvgjsDefs1073"></defs>
                        <g id="SvgjsG1074"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                <path fill="none" d="M0 0h48v48H0z"></path>
                                <path d="M36 16h-2v-4c0-5.52-4.48-10-10-10S14 6.48 14 12v4h-2c-2.21 0-4 1.79-4 4v20c0 2.21 1.79 4 4 4h24c2.21 0 4-1.79 4-4V20c0-2.21-1.79-4-4-4zM24 34c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm6.2-18H17.8v-4c0-3.42 2.78-6.2 6.2-6.2 3.42 0 6.2 2.78 6.2 6.2v4z" fill="#50b3ba" class="color000 svgShape"></path>
                            </svg></g>
                    </svg>
                </div>
                <a href="password_recovery.php" class="main-text-color">forgot your password?</a>
                <input type="submit" class="main-btn" name="btn_send" value="sign in" />
            </form>
            <div style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
                <p>don't have an account? <a href="sign-up.php" class="main-text-color-with-decoration">join now</a>
                </p>
                <p>are you a doctor? <a href="../../doctor-sign-up.php" class="main-text-color-with-decoration">sign up</a>
                </p>
            </div>
            <div class="login-footer">
                <p>Contact us via </p>
                <div class="icons-group">
                    <a href="#">
                        <svg class="footer-icon" id="SvgjsSvg1056" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                            <defs id="SvgjsDefs1057"></defs>
                            <g id="SvgjsG1058"><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
                                    <path d="M20.47,2H3.53A1.45,1.45,0,0,0,2.06,3.43V20.57A1.45,1.45,0,0,0,3.53,22H20.47a1.45,1.45,0,0,0,1.47-1.43V3.43A1.45,1.45,0,0,0,20.47,2ZM8.09,18.74h-3v-9h3ZM6.59,8.48h0a1.56,1.56,0,1,1,0-3.12,1.57,1.57,0,1,1,0,3.12ZM18.91,18.74h-3V13.91c0-1.21-.43-2-1.52-2A1.65,1.65,0,0,0,12.85,13a2,2,0,0,0-.1.73v5h-3s0-8.18,0-9h3V11A3,3,0,0,1,15.46,9.5c2,0,3.45,1.29,3.45,4.06Z" fill="#50b3ba" class="color000 svgShape"></path>
                                </svg></g>
                        </svg>
                    </a>
                    <a href="#">
                        <svg class="footer-icon" id="SvgjsSvg1026" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                            <defs id="SvgjsDefs1027"></defs>
                            <g id="SvgjsG1028"><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
                                    <path d="M15.12,5.32H17V2.14A26.11,26.11,0,0,0,14.26,2C11.54,2,9.68,3.66,9.68,6.7V9.32H6.61v3.56H9.68V22h3.68V12.88h3.06l.46-3.56H13.36V7.05C13.36,6,13.64,5.32,15.12,5.32Z" fill="#50b3ba" class="color000 svgShape"></path>
                                </svg></g>
                        </svg>
                    </a>
                    <a href="#">
                        <svg class="footer-icon" id="SvgjsSvg1041" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                            <defs id="SvgjsDefs1042"></defs>
                            <g id="SvgjsG1043"><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
                                    <path d="M22,5.8a8.49,8.49,0,0,1-2.36.64,4.13,4.13,0,0,0,1.81-2.27,8.21,8.21,0,0,1-2.61,1,4.1,4.1,0,0,0-7,3.74A11.64,11.64,0,0,1,3.39,4.62a4.16,4.16,0,0,0-.55,2.07A4.09,4.09,0,0,0,4.66,10.1,4.05,4.05,0,0,1,2.8,9.59v.05a4.1,4.1,0,0,0,3.3,4A3.93,3.93,0,0,1,5,13.81a4.9,4.9,0,0,1-.77-.07,4.11,4.11,0,0,0,3.83,2.84A8.22,8.22,0,0,1,3,18.34a7.93,7.93,0,0,1-1-.06,11.57,11.57,0,0,0,6.29,1.85A11.59,11.59,0,0,0,20,8.45c0-.17,0-.35,0-.53A8.43,8.43,0,0,0,22,5.8Z" fill="#50b3ba" class="color000 svgShape"></path>
                                </svg></g>
                        </svg>
                    </a>
                    <a href="#">
                        <svg class="footer-icon" id="SvgjsSvg1011" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                            <defs id="SvgjsDefs1012"></defs>
                            <g id="SvgjsG1013"><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
                                    <path d="M17.34,5.46h0a1.2,1.2,0,1,0,1.2,1.2A1.2,1.2,0,0,0,17.34,5.46Zm4.6,2.42a7.59,7.59,0,0,0-.46-2.43,4.94,4.94,0,0,0-1.16-1.77,4.7,4.7,0,0,0-1.77-1.15,7.3,7.3,0,0,0-2.43-.47C15.06,2,14.72,2,12,2s-3.06,0-4.12.06a7.3,7.3,0,0,0-2.43.47A4.78,4.78,0,0,0,3.68,3.68,4.7,4.7,0,0,0,2.53,5.45a7.3,7.3,0,0,0-.47,2.43C2,8.94,2,9.28,2,12s0,3.06.06,4.12a7.3,7.3,0,0,0,.47,2.43,4.7,4.7,0,0,0,1.15,1.77,4.78,4.78,0,0,0,1.77,1.15,7.3,7.3,0,0,0,2.43.47C8.94,22,9.28,22,12,22s3.06,0,4.12-.06a7.3,7.3,0,0,0,2.43-.47,4.7,4.7,0,0,0,1.77-1.15,4.85,4.85,0,0,0,1.16-1.77,7.59,7.59,0,0,0,.46-2.43c0-1.06.06-1.4.06-4.12S22,8.94,21.94,7.88ZM20.14,16a5.61,5.61,0,0,1-.34,1.86,3.06,3.06,0,0,1-.75,1.15,3.19,3.19,0,0,1-1.15.75,5.61,5.61,0,0,1-1.86.34c-1,.05-1.37.06-4,.06s-3,0-4-.06A5.73,5.73,0,0,1,6.1,19.8,3.27,3.27,0,0,1,5,19.05a3,3,0,0,1-.74-1.15A5.54,5.54,0,0,1,3.86,16c0-1-.06-1.37-.06-4s0-3,.06-4A5.54,5.54,0,0,1,4.21,6.1,3,3,0,0,1,5,5,3.14,3.14,0,0,1,6.1,4.2,5.73,5.73,0,0,1,8,3.86c1,0,1.37-.06,4-.06s3,0,4,.06a5.61,5.61,0,0,1,1.86.34A3.06,3.06,0,0,1,19.05,5,3.06,3.06,0,0,1,19.8,6.1,5.61,5.61,0,0,1,20.14,8c.05,1,.06,1.37.06,4S20.19,15,20.14,16ZM12,6.87A5.13,5.13,0,1,0,17.14,12,5.12,5.12,0,0,0,12,6.87Zm0,8.46A3.33,3.33,0,1,1,15.33,12,3.33,3.33,0,0,1,12,15.33Z" fill="#50b3ba" class="color000 svgShape"></path>
                                </svg></g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>