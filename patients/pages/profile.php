<?php
ob_start();
session_start();

include "../includes/header.php";
if (isset($_SESSION['id'])) {
    if ($_SESSION['account_type'] == 3) {
        $box = isset($_GET['box']) ? $_GET['box'] : "index";
        if ($box == "index") {

?>
            <?php
            require '../../connect.php';
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM patients WHERE id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <main class="container">
                <h1 class="main-text-color">my information</h1>
                <div class="doctor-info">
                    <div>
                        <span><b>full name:</b> <?php echo $row['full_name']; ?></span>
                        <span><b>date birth:</b> <?php echo $row['date_birth']; ?></span>
                        <span><b>gender:</b> <?php echo ($row['gender'] == 1) ? "male" : "female";  ?></span>
                        <span><b>contact information:</b> <?php echo $row['contact_information']; ?></span>
                        <span><b>address:</b> <?php echo $row['address']; ?></span>
                        <span><b>medical history:</b> <?php echo $row['medical_history']; ?></span>
                    </div>
                    <div>
                        <span><b>user name:</b> <?php echo $row['user_name']; ?></span>
                        <span><b>email address:</b> <?php echo $row['email_address']; ?></span>
                        <span><b>account status:</b> <?php echo ($row['account_status'] == 1) ? "account is active" : "account is inactive"; ?></span>
                        <span><b>activity status:</b> <?php echo ($row['activity_status'] == 1) ? "online account" : "The account is offline"; ?></span>
                    </div>
                </div>
            </main>

            <a href="?box=edit&&id=<?php echo $row['id']; ?>"><button class="main-btn" style="width: fit-content; margin: 16px auto; display: block; cursor: pointer;">EDIT</button></a>
            <?php

        } elseif ($box == "edit") {

            require '../../static_functions.php';

            $id = intval($_GET['id']);

            require '../../connect.php';

            $sql = "SELECT * FROM patients WHERE id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            // ----------   ----------  ----------  ----------

            $full_name = $date_birth = $gender = $contact_information = $address = $medical_history = $preferred_language = $user_name = $password = $email_address = "";
            $full_name_error = $date_birth_error = $gender_error = $contact_information_error = $address_error = $medical_history_error = $preferred_language_error = $user_name_error = $pass_error = $email_address_error = "";

            if (isset($_POST['btn_send'])) {
                if (empty($_POST['full_name'])) {
                    $full_name_error = "Field is required *";
                } else {
                    $full_name = examine_values($_POST['full_name']);
                }

                if (empty($_POST['date_birth'])) {
                    $date_birth = $row['date_birth'];
                } else {
                    $date_birth = examine_values($_POST['date_birth']);
                }

                if (empty($_POST['gender'])) {
                    $gender = $row['gender'];
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
                    $pass = $row['password'];
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

                    $sql = "SELECT * FROM patients WHERE user_name='$user_name' AND id!='$id'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
            ?>
                        <script>
                            alert("The username has already been reserved.");
                        </script>
                        <?php
                    } else {

                        $sql = "UPDATE patients SET full_name='$full_name', date_birth='$date_birth', gender='$gender', contact_information='$contact_information', address='$address', medical_history='$medical_history', preferred_language='$preferred_language', user_name='$user_name', password='$pass', email_address='$email_address' WHERE id='$id'";

                        if ($conn->query($sql) === TRUE) {
                        ?>
                            <p class="success-message">
                                data edited successfully
                            </p>
            <?php
                        } else {
                            echo "Error updating record: " . mysqli_error($conn);
                        }
                    }
                    $conn->close();
                    redirect("profile.php", 2);
                }
            }
            ?>
            <link rel="stylesheet" href="../styles/style.css">

            <div class="container">
                <div class="signUp2">
                    <div class="form">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?box=edit&&id=<?php echo $id; ?>" method="post">
                            <div class="inputs-group">
                                <div class="form-group">
                                    <div>
                                        <label for="full_name">full name </label><?php echo $full_name_error; ?>
                                    </div>
                                    <input type="text" name="full_name" id="full_name" value="<?php echo $row['full_name'] ?>" class="input-field" placeholder="full name">
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="contact_information">contact information </label> <?php echo $contact_information_error; ?>
                                    </div>
                                    <input type="text" name="contact_information" id="contact_information" value="<?php echo $row['contact_information'] ?>" class="input-field" placeholder="contact information">
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="address">address </label> <?php echo $address_error; ?>
                                    </div>
                                    <input type="text" name="address" id="address" value="<?php echo $row['address'] ?>" class="input-field" placeholder="address">
                                </div>
                            </div>
                            <div class="inputs-group">
                                <div class="form-group">
                                    <div>
                                        <label for="date_birth">date birth </label> <?php echo $date_birth_error; ?>
                                    </div>
                                    <input type="date" name="date_birth" id="date_birth" class="input-field" placeholder="date birth">
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="">gender </label> <?php echo $gender_error; ?>
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
                                        <label for="preferred_language">preferred language </label> <?php echo $preferred_language_error; ?>
                                    </div>
                                    <input type="text" name="preferred_language" id="preferred_language" value="<?php echo $row['preferred_language'] ?>" class="input-field" placeholder="preferred language">
                                </div>
                            </div>
                            <div class="inputs-group">
                                <div class="form-group">
                                    <div>
                                        <label for="user_name">user name </label> <?php echo $user_name_error; ?>
                                    </div>
                                    <input type="text" name="user_name" id="user_name" value="<?php echo $row['user_name'] ?>" class="input-field" placeholder="user name">
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="pass">password </label> <?php echo $pass_error; ?>
                                    </div>
                                    <input type="password" name="pass" id="pass" class="input-field" placeholder="password">
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="email_address">email address </label> <?php echo $email_address_error; ?>
                                    </div>
                                    <input type="email" name="email_address" id="email_address" value="<?php echo $row['email_address'] ?>" class="input-field" placeholder="email address">
                                </div>
                            </div>
                            <div class="inputs-group">
                                <div class="form-group">
                                    <div>
                                        <label for="medical_history">medical history </label> <?php echo $medical_history_error; ?>
                                    </div>
                                    <textarea type="text" name="medical_history" id="medical_history" class="input-field" placeholder="medical history"><?php echo $row['medical_history'] ?></textarea>
                                </div>
                            </div>
                            <input class="main-btn" type="submit" value="edit" name="btn_send" />
                        </form>
                    </div>
                </div>
            </div>

        <?php
        }
    } else {
        ?>
        <script>
            alert("Unauthorized entry");
        </script>
    <?php
    }
} else {
    ?>

    <script>
        alert("Unauthorized entry");
    </script>

<?php

}
include "../includes/footer.php";
ob_end_flush();
