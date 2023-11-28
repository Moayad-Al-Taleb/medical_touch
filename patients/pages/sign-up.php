<?php

require '../../static_functions.php';

$full_name = $date_birth = $gender = $contact_information = $address = $medical_history = $preferred_language = $user_name = $password = $email_address = "";
$full_name_error = $date_birth_error = $gender_error = $contact_information_error = $address_error = $medical_history_error = $preferred_language_error = $user_name_error = $pass_error = $email_address_error = "";

if (isset($_POST['btn_send'])) {
    if (empty($_POST['full_name'])) {
        $full_name_error = "Field is required *";
    } else {
        $full_name = examine_values($_POST['full_name']);
    }

    if (empty($_POST['date_birth'])) {
        $date_birth_error = "Field is required *";
    } else {
        $date_birth = examine_values($_POST['date_birth']);
    }

    if (empty($_POST['gender'])) {
        $gender_error = "Field is required *";
    } else {
        $gender = examine_values($_POST['gender']);
    }

    if (empty($_POST['contact_information'])) {
        $contact_information_error = "Field is required *";
    } else {
        $first_value = examine_values($_POST['contact_information']);
        $first_value = check_phone_number($_POST['contact_information']);

        if (strlen($first_value) !== 10) {
            $contact_information_error = "Phone number must be 10 digits long.";
        } else {
            if (substr($first_value, 0, 2) !== '05') {
                $contact_information_error = "Please enter a valid Saudi phone number starting with '05'.";
            } else {
                $contact_information = $first_value;
            }
        }
    }

    if (empty($_POST['address'])) {
        $address_error = "Field is required *";
    } else {
        $address = examine_values($_POST['address']);
    }

    if (empty($_POST['medical_history'])) {
        $medical_history_error = "Field is required *";
    } else {
        $medical_history = examine_values($_POST['medical_history']);
    }

    if (empty($_POST['preferred_language'])) {
        $preferred_language_error = "Field is required *";
    } else {
        $preferred_language = examine_values($_POST['preferred_language']);
    }

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

    if (empty($_POST['email_address'])) {
        $email_address_error = "Field is required *";
    } else {
        $email_address = examine_values($_POST['email_address']);
    }

    if (!empty($full_name) && !empty($date_birth) && !empty($gender) && !empty($contact_information) && !empty($address) && !empty($medical_history) && !empty($preferred_language) && !empty($user_name) && !empty($pass) && !empty($email_address)) {

        require '../../connect.php';

        $sql = "SELECT * FROM patients WHERE user_name='$user_name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
?>
            <script>
                alert("The username has already been reserved.");
            </script>
            <?php
        } else {

            $sql = "INSERT INTO patients(full_name, date_birth, gender, contact_information, address, medical_history, preferred_language, user_name, password, email_address) VALUES ('$full_name', '$date_birth', '$gender', '$contact_information', '$address', '$medical_history', '$preferred_language', '$user_name', '$pass', '$email_address')";

            if ($conn->query($sql) === TRUE) {
            ?>
                <script>
                    alert("sign up complete, now sign in.");
                </script>
<?php
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
        redirect("login.php", 0);
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
    <div class="signUp">
        <div class="overflow"></div>
        <div class="form">
            <span>sign up as a patient</span>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="inputs-group">
                    <div class="form-group">
                        <div>
                            <label for="full_name">full name </label> <?php echo $full_name_error; ?>
                        </div>
                        <input type="text" name="full_name" id="full_name" class="input-field" placeholder="full name">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="contact_information">contact information</label> <?php echo $contact_information_error; ?>
                        </div>
                        <input type="text" name="contact_information" id="contact_information" class="input-field" placeholder="contact information">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="address">address</label> <?php echo $address_error; ?>
                        </div>
                        <input type="text" name="address" id="address" class="input-field" placeholder="address">
                    </div>
                </div>
                <div class="inputs-group">
                    <div class="form-group">
                        <div>
                            <label for="date_birth">date birth</label> <?php echo $date_birth_error; ?>
                        </div>
                        <input type="date" name="date_birth" id="date_birth" class="input-field" placeholder="date birth">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="">gender</label> <?php echo $gender_error; ?>
                        </div>
                        <div class="radio-group">
                            <div>
                                <input type="radio" name="gender" id="male" value="1">
                                <label for="male">male</label>
                            </div>
                            <div><input type="radio" name="gender" id="female" value="2">
                                <label for="female">female</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="preferred_language">preferred language</label> <?php echo $preferred_language_error; ?>
                        </div>
                        <input type="text" name="preferred_language" id="preferred_language" class="input-field" placeholder="preferred language">
                    </div>
                </div>
                <div class="inputs-group">
                    <div class="form-group">
                        <div>
                            <label for="user_name">user name</label> <?php echo $user_name_error; ?>
                        </div>
                        <input type="text" name="user_name" id="user_name" class="input-field" placeholder="user name">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="pass">password</label> <?php echo $pass_error; ?>
                        </div>
                        <input type="password" name="pass" id="pass" class="input-field" placeholder="password">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="email_address">email address</label> <?php echo $email_address_error; ?>
                        </div>
                        <input type="email" name="email_address" id="email_address" class="input-field" placeholder="email address">
                    </div>
                </div>
                <div class="inputs-group">
                    <div class="form-group">
                        <div>
                            <label for="medical_history">medical history</label> <?php echo $medical_history_error; ?>
                        </div>
                        <textarea type="text" name="medical_history" id="medical_history" class="input-field" placeholder="medical history"></textarea>
                    </div>
                </div>
                <input class="main-btn" type="submit" value="sign up" name="btn_send" />

            </form>
            <div style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
                <p>have an account? <a href="login.php" class="main-text-color-with-decoration">sign in now</a></p>
            </div>
        </div>
    </div>
</body>

</html>