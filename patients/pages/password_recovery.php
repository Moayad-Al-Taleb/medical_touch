<?php

require '../../static_functions.php';

$user_name = $full_name = $contact_information = "";
$user_name_error = $full_name_error = $contact_information_error = "";

if (isset($_POST['btn_send'])) {

    if (empty($_POST['user_name'])) {
        $user_name_error = "Field is required *";
    } else {
        $user_name = examine_values($_POST['user_name']);
    }

    if (empty($_POST['full_name'])) {
        $full_name_error = "Field is required *";
    } else {
        $full_name = examine_values($_POST['full_name']);
    }

    if (empty($_POST['contact_information'])) {
        $contact_information_error = "Field is required *";
    } else {
        $contact_information = examine_values($_POST['contact_information']);
    }

    if (!empty($user_name) && !empty($full_name) && !empty($contact_information)) {

        require '../../connect.php';

        $sql = "SELECT * FROM patients WHERE user_name='$user_name' AND full_name='$full_name' AND contact_information='$contact_information'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            $email_address = $row['email_address'];

            $new_pass = generateRandomPassword();

            $sha1_pass = sha1($new_pass);
            $sql = "UPDATE patients SET password='$sha1_pass' WHERE user_name='$user_name'";
            $conn->query($sql);

            $subject = "Password Recovery";
            $message = "Your new password is: $new_pass";
            $headers = "From: project.system.email.2023@gmail.com";

            if (mail($email_address, $subject, $message, $headers)) {
                echo "Password recovery email sent successfully.";
            } else {
                echo "Failed to send password recovery email.";
            }
        } else {
?>
            <script>
                alert("Please double-check your username, full name, and contact information and try again.");
            </script>
<?php
        }

        $conn->close();
        redirect("Login.php", 2);
    }
}

function generateRandomPassword()
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $length = 10;
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
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
    <div class="signUp">
        <div class="overflow"></div>
        <div class="form">
            <span>passwrod recovery</span>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="max-width: 600px;">
                <div class="form-group">
                    <div>
                        <label for="user_name">Please enter your account name: </label>
                        <?php echo $user_name_error; ?>
                    </div>
                    <input type="text" name="user_name" id="user_name" class="input-field">
                </div>
                <div class="form-group">
                    <div>
                        <label for="full_name">Please enter your full name: </label>
                        <?php echo $full_name_error; ?>
                    </div>
                    <input type="text" name="full_name" id="full_name" class="input-field">
                </div>
                <div class="form-group">
                    <div>
                        <label for="contact_information">Please enter your contact information: </label>
                        <?php echo $contact_information_error; ?>
                    </div>
                    <input type="text" name="contact_information" id="contact_information" class="input-field">
                </div>
                <input type="submit" value="send" name="btn_send" class="main-btn">
                <a href="login.php" class="main-text-color">back to sign in page</a>
            </form>
        </div>
    </div>
</body>

</html>