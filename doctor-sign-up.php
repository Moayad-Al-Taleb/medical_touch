<?php

require 'static_functions.php';

$full_name = $specialty_id = $contact_information = $availability = $languages = $clinic_hospital_affiliation = $user_name = $pass = $email_address = "";
$full_name_error = $specialty_id_error = $contact_information_error = $availability_error = $languages_error = $clinic_hospital_affiliation_error = $user_name_error = $pass_error = $email_address_error = "";

if (isset($_POST['btn_send'])) {
    if (empty($_POST['full_name'])) {
        $full_name_error = "Field is required *";
    } else {
        $full_name = examine_values($_POST['full_name']);
    }

    if (empty($_POST['specialty_id'])) {
        $specialty_id_error = "Field is required *";
    } else {
        $specialty_id = examine_values($_POST['specialty_id']);
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

    if (empty($_POST['availability'])) {
        $availability_error = "Field is required *";
    } else {
        $availability = examine_values($_POST['availability']);
    }

    if (empty($_POST['languages'])) {
        $languages_error = "Field is required *";
    } else {
        $languages = examine_values($_POST['languages']);
    }

    if (empty($_POST['clinic_hospital_affiliation'])) {
        $clinic_hospital_affiliation_error = "Field is required *";
    } else {
        $clinic_hospital_affiliation = examine_values($_POST['clinic_hospital_affiliation']);
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

    if (!empty($full_name) && !empty($specialty_id) && !empty($contact_information) && !empty($availability) && !empty($languages) && !empty($clinic_hospital_affiliation) && !empty($user_name) && !empty($pass) && !empty($email_address)) {

        require 'connect.php';

        $sql = "SELECT * FROM doctors WHERE user_name='$user_name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

?>

            <script>
                alert("The username has already been reserved.");
            </script>

            <?php

        } else {

            $sql = "INSERT INTO doctors(full_name, specialty_id, contact_information, availability, languages, clinic_hospital_affiliation, user_name, password, email_address) VALUES('$full_name', '$specialty_id', '$contact_information', '$availability', '$languages', '$clinic_hospital_affiliation', '$user_name', '$pass', '$email_address')";

            if ($conn->query($sql) === TRUE) {
            ?>

                <script>
                    alert("the account successfully added please sign in now");
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
    <link rel="stylesheet" href="patients/styles/style.css">
    <script src="./main.js"></script>
</head>

<body>
    <div class="signUp">
        <div class="overflow"></div>
        <div class="form">
            <span>sign up as a doctor</span>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="inputs-group">
                    <div class="form-group">
                        <div>
                            <label for="full_name">full name</label> <?php echo $full_name_error; ?>
                        </div>
                        <input type="text" name="full_name" id="full_name" class="input-field" placeholder="full name">
                    </div>
                    <?php

                    require 'connect.php';

                    $sql = "SELECT * FROM specialties";
                    $result = $conn->query($sql);

                    ?>
                    <div class="form-group">
                        <div>
                            <label for="specialty_id">speciality</label> <?php echo $specialty_id_error; ?>
                        </div>
                        <select name="specialty_id" id="specialty_id" class="input-field" name="" id="">
                            <option value="0">-</option>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?> || <?php echo $row['description'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="contact_information">contact information</label> <?php echo $contact_information_error; ?>
                        </div>
                        <input type="text" name="contact_information" id="contact_information" class="input-field" placeholder="contact information">
                    </div>
                </div>
                <div class="inputs-group">
                    <div class="form-group">
                        <div>
                            <label for="availability">availability</label> <?php echo $availability_error; ?>
                        </div>
                        <input type="text" name="availability" id="availability" class="input-field" placeholder="availability">
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="languages">languages</label> <?php echo $languages_error; ?>
                        </div>
                        <input type="text" name="languages" id="languages" class="input-field" placeholder="preferred language">
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
                        <input type="text" name="email_address" id="email_address" class="input-field" placeholder="email address">
                    </div>
                </div>
                <div class="inputs-group">
                    <div class="form-group">
                        <div>
                            <label for="clinic_hospital_affiliation">clinic hospital affiliation</label> <?php echo $clinic_hospital_affiliation_error; ?>
                        </div>
                        <textarea type="text" name="clinic_hospital_affiliation" id="clinic_hospital_affiliation" class="input-field" placeholder="clinic hospital affiliation"></textarea>
                    </div>
                </div>
                <input type="submit" value="sign up" class="main-btn" name="btn_send">
            </form>
            <div style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
                <p>have an account? <a href="login.php" class="main-text-color-with-decoration">sign in now</a></p>
            </div>
        </div>
    </div>
</body>

</html>