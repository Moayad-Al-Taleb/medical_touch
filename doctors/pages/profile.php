<?php

session_start();
$page_title = "my profile information";
include "../includes/header.php";

if (isset($_SESSION['id'])) {

    if ($_SESSION['account_type'] == 2) {

        $box = isset($_GET['box']) ? $_GET['box'] : "index";

        if ($box == "index") {

            require '../../connect.php';

            $id = $_SESSION['id'];
            $sql = "SELECT doctors.*, specialties.name, specialties.description FROM doctors, specialties WHERE doctors.specialty_id = specialties.id AND doctors.id='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

?>

            <div class="container my-4">
                <div class="d-flex justify-content-between align-center">
                    <h3>Your data and certificate management</h3>
                    <a href="?box=edit&&id=<?php echo $row['id']; ?>"><button class="btn btn-primary">EDIT</button></a>
                </div>


                <div class="d-flex flex-column gap-2 my-4">
                    <span><b>full name:</b> <?php echo $row['full_name']; ?></span>
                    <span><b>specialty:</b> <?php echo $row['name']; ?></span>
                    <span><b>contact information:</b> <?php echo $row['contact_information']; ?></span>
                    <span><b>availability:</b> <?php echo $row['availability']; ?></span>
                    <span><b>languages:</b> <?php echo $row['languages']; ?></span>
                    <span><b>clinic hospital affiliation:</b> <?php echo $row['clinic_hospital_affiliation']; ?></span>
                    <span><b>user name:</b> <?php echo $row['user_name']; ?></span>
                    <span><b>email address:</b> <?php echo $row['email_address']; ?></span>
                    <span><b>account status:</b> <?php echo ($row['account_status'] == 1) ? "account is active" : "account is inactive"; ?></span>
                    <span><b>activity status:</b> <?php echo ($row['activity_status'] == 1) ? "online account" : "The account is offline"; ?></span>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-center">
                    <h3>Certification management to prove you are a doctor</h3>
                    <a href="?box=add_certificate&&id=<?php echo $id; ?>"><button class="btn btn-primary">Add Certificate</button></a>
                </div>


                <?php

                require '../../connect.php';

                $sql = "SELECT * FROM certificates WHERE certificates.doctor_id='$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    $counter = 1;

                ?>

                    <div class="table-responsive my-3">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>description</th>
                                    <th>experience</th>
                                    <th>Options</th>
                                </tr>
                            </thead>

                            <?php

                            while ($row = $result->fetch_assoc()) {

                                $file = "../../manager/Attached Certificates/" . $row['certificate'];

                            ?>

                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo $row['description'] ?></td>
                                    <td><?php echo $row['experience'] ?></td>
                                    <td>
                                        <a href="<?php echo $file; ?>"><button class="btn btn-info m-1">file view</button></a>
                                        <a href="?box=download&&file=<?php echo $file; ?>"><button class="btn btn-warning m-1">download file</button></a>
                                        <a href="?box=delete_certificate&&id=<?php echo $row['id']; ?>"><button class="btn btn-danger m-1">delete certificate</button></a>
                                    </td>
                                </tr>

                            <?php

                            }

                            ?>
                        </table>
                        </center>

                    <?php

                } else {

                    ?>
                        <p class="alert alert-warning my-3">
                            No data has been added
                        </p>
                    <?php
                }
                $conn->close();

                    ?>

                    </div>
                    <?php
                } elseif ($box == "edit") {

                    require '../../static_functions.php';

                    $id = intval($_GET['id']);

                    require '../../connect.php';

                    $sql = "SELECT doctors.*, specialties.name, specialties.description FROM doctors, specialties WHERE doctors.specialty_id = specialties.id AND doctors.id='$id'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    // ----------   ----------  ----------  ----------

                    $full_name = $specialty_id = $contact_information = $availability = $languages = $clinic_hospital_affiliation = $user_name = $pass = $email_address = "";
                    $full_name_error = $specialty_id_error = $contact_information_error = $availability_error = $languages_error = $clinic_hospital_affiliation_error = $user_name_error = $pass_error = $email_address_error = "";

                    if (isset($_POST['btn_send'])) {
                        if (empty($_POST['full_name'])) {
                            $full_name_error = "Field is required *";
                        } else {
                            $full_name = examine_values($_POST['full_name']);
                        }

                        if (empty($_POST['specialty_id'])) {
                            $specialty_id = $row['specialty_id'];
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
                            $pass = $row['password'];
                        } else {
                            $pass = sha1(examine_values($_POST['pass']));
                        }

                        if (empty($_POST['email_address'])) {
                            $email_address_error = "Field is required *";
                        } else {
                            $email_address = examine_values($_POST['email_address']);
                        }

                        if (!empty($full_name) && !empty($specialty_id) && !empty($contact_information) && !empty($availability) && !empty($languages) && !empty($clinic_hospital_affiliation) && !empty($user_name) && !empty($pass) && !empty($email_address)) {

                            require '../../connect.php';

                            $sql = "SELECT * FROM doctors WHERE user_name='$user_name' AND id!='$id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                    ?>

                                <script>
                                    alert("The username has already been reserved.");
                                </script>

                                <?php

                            } else {

                                $sql = "UPDATE doctors SET full_name='$full_name', specialty_id='$specialty_id', contact_information='$contact_information', availability='$availability', languages='$languages', clinic_hospital_affiliation='$clinic_hospital_affiliation', user_name='$user_name', password='$pass', email_address='$email_address', account_status='2' WHERE id='$id'";

                                if ($conn->query($sql) === TRUE) {
                                ?>
                                    <p class="alert alert-success my-2 mx-4">
                                        record updated successfully
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

                    <div class="container my-4">

                        <form style="width: 100%; max-width: 450px;" class="mt-3 d-flex flex-column gap-2" action="<?php echo $_SERVER['PHP_SELF']; ?>?box=edit&&id=<?php echo $id; ?>" method="post">
                            <div class="form-group">
                                <div>
                                    <label for="full_name">full name: </label>
                                    <span class="text-danger"><?php echo $full_name_error ?></span>
                                </div>
                                <input type="text" class="form-control" name="full_name" id="full_name" value="<?php echo $row['full_name']; ?>" />
                            </div>
                            <?php
                            require '../../connect.php';
                            $sql2 = "SELECT * FROM specialties";
                            $result2 = $conn->query($sql2);
                            ?>
                            <div class="form-group">
                                <div>
                                    <label for="specialty_id">specialty: </label>
                                    <?php echo $row['name'] ?>
                                    <span class="text-danger"><?php echo $specialty_id_error ?></span>
                                </div>
                                <select class="form-control" name="specialty_id" id="specialty_id">
                                    <option value="">-</option>
                                    <?php
                                    while ($row2 = $result2->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row2['id'] ?>"><?php echo $row2['name'] ?> || <?php echo $row2['description'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="contact_information">contact information: </label>
                                    <span class="text-danger"><?php echo $contact_information_error ?></span>
                                </div>
                                <input type="text" class="form-control" name="contact_information" id="contact_information" value="<?php echo $row['contact_information']; ?>" />
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="availability">availability: </label>
                                    <span class="text-danger"><?php echo $availability_error ?></span>
                                </div>
                                <input type="text" class="form-control" name="availability" id="availability" value="<?php echo $row['availability']; ?>" />
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="languages">languages: </label>
                                    <span class="text-danger"><?php echo $languages_error ?></span>
                                </div>
                                <input type="text" class="form-control" name="languages" id="languages" value="<?php echo $row['languages']; ?>" />
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="clinic_hospital_affiliation">clinic hospital affiliation: </label>
                                    <span class="text-danger"><?php echo $clinic_hospital_affiliation_error ?></span>
                                </div>
                                <input type="text" class="form-control" name="clinic_hospital_affiliation" id="clinic_hospital_affiliation" value="<?php echo $row['clinic_hospital_affiliation']; ?>" />
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="user_name">user name: </label>
                                    <span class="text-danger"><?php echo $user_name_error ?></span>
                                </div>
                                <input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo $row['user_name']; ?>" />
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="pass">password: </label>
                                    <span class="text-danger"><?php echo $pass_error ?></span>
                                </div>
                                <input type="password" class="form-control" name="pass" id="pass" />
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="email_address">email address: </label>
                                    <span class="text-danger"><?php echo $email_address_error ?></span>
                                </div>
                                <input type="email" class="form-control" name="email_address" id="email_address" value="<?php echo $row['email_address']; ?>" />
                            </div>
                            <input type="submit" class="btn btn-primary" value="SEND" name="btn_send">
                        </form>
                    </div>

                    <?php

                } elseif ($box == "add_certificate") {

                    require '../../static_functions.php';

                    $id = intval($_GET['id']);

                    $certificate = $description = $experience = "";
                    $certificate_error = $description_error = $experience_error = "";

                    if (isset($_POST['btn_send'])) {
                        if (empty($_FILES["certificate"]["name"])) {
                            $certificate_error = "Field is required *";
                        } else {
                            $targetDir = "../../manager/Attached Certificates/";
                            $fileName = basename($_FILES["certificate"]["name"]);
                            $targetFilePath = $targetDir . $fileName;
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                            $allowTypes = array('pdf');
                            if (in_array($fileType, $allowTypes)) {
                                if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $targetFilePath)) {
                                    $certificate = $fileName;
                                } else {
                                    $certificate_error = "Sorry, there was an error uploading your file.";
                                }
                            } else {
                                $certificate_error = 'Sorry, only PDF files are allowed to upload.';
                            }
                        }

                        if (empty($_POST['description'])) {
                            $description_error = "Field is required *";
                        } else {
                            $description = examine_values($_POST['description']);
                        }

                        if (empty($_POST['experience'])) {
                            $experience_error = "Field is required *";
                        } else {
                            $experience = examine_values($_POST['experience']);
                        }

                        if (!empty($certificate) && !empty($description) && !empty($experience)) {

                            require '../../connect.php';

                            $sql = "INSERT INTO certificates(certificate, description, experience, doctor_id) VALUES ('$certificate', '$description', '$experience', '$id')";

                            if ($conn->query($sql) === TRUE) {
                    ?>
                                <p class="alert alert-success my-3">
                                    new record added successfully
                                </p>
                    <?php
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                            $conn->close();
                            redirect("profile.php", 2);
                        }
                    }

                    ?>

                    <div class="container my-4">
                        <h3>add certificate</h3>
                        <form style="width: 100%; max-width: 450px;" class="mt-3 d-flex flex-column gap-2" action="<?php echo $_SERVER['PHP_SELF']; ?>?box=add_certificate&&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div>
                                    <label for="description">description: </label>
                                    <span class="text-danger"><?php echo $description_error ?></span>
                                </div>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="experience">experience: </label>
                                    <span class="text-danger"><?php echo $experience_error ?></span>
                                </div>
                                <textarea class="form-control" name="experience" id="experience" cols="30" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="certificate">certificate: </label>
                                    <span class="text-danger"><?php echo $certificate_error ?></span>
                                </div>
                                <input type="file" class="form-control" name="certificate" id="certificate" />
                            </div>
                            <input type="submit" class="btn btn-primary" value="SEND" name="btn_send">
                        </form>
                    </div>

                    <?php

                } elseif ($box == "download") {

                    $fileWithPath = $_GET['file'];
                    $fileName = basename($fileWithPath);

                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="' . $fileName . '"');

                    readfile($fileWithPath);
                } elseif ($box == "delete_certificate") {

                    require '../../static_functions.php';

                    $id = intval($_GET['id']);

                    require '../../connect.php';

                    $sql = "SELECT certificate FROM certificates WHERE id = '$id'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    $sql2 = "DELETE FROM certificates WHERE id='$id'";

                    if ($conn->query($sql2) === TRUE) {
                    ?>
                        <p class="alert alert-success my-3 mx-4">
                            record deleted successfully
                        </p>
                <?php
                        if (file_exists('../../manager/Attached Certificates/' . $row['certificate'])) {
                            unlink('../../manager/Attached Certificates/' . $row['certificate']);
                        }
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }

                    $conn->close();
                    redirect("profile.php", 2);
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

        ?>