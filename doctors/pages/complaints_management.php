<?php

session_start();
$page_title = "complaints management";
include "../includes/header.php";

if (isset($_SESSION['id'])) {

    if ($_SESSION['account_type'] == 2) {
        if ($_SESSION['account_status'] == 1) {

            $box = isset($_GET['box']) ? $_GET['box'] : "index";

            if ($box == "index") {

                $id = $_SESSION['id'];
?>

                <div class="container my-4">
                    <div class="d-flex justify-content-between align-center mb-2">
                        <h3>Managing Unanswered Complaints</h3>
                        <a href="?box=has_been_replied"><button class="btn btn-primary">Complaints That Have Been Answered</button></a>
                    </div>

                    <?php

                    require '../../connect.php';

                    $sql = "SELECT complaints.*, patients.id AS 'id2', patients.full_name AS 'full_name2', patients.user_name AS 'user_name2', patients.email_address AS 'email_address2', doctors.id AS 'id1', doctors.full_name AS 'full_name1', doctors.user_name AS 'user_name1', doctors.email_address AS 'email_address1' FROM complaints, patients, doctors WHERE complaints.complainant_id IS NULL AND complaints.accused_perso_id IS NULL AND complaints.reply_complaint IS NULL AND complaints.complainant_id2 = doctors.id AND complaints.accused_perso_id2 = patients.id AND complaints.complainant_id2='$id' ORDER BY complaints.date_complaint_submitted DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        $counter = 1;

                    ?>

                        <div class="table-responsive my-3">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>complaint</th>
                                        <th>date complaint submitted</th>
                                        <th>Complainant Name</th>
                                        <th>The name of the complainant's account</th>
                                        <th>Defendant Name</th>
                                        <th>The name of the defendant's account</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>

                                <?php

                                while ($row = $result->fetch_assoc()) {

                                ?>

                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php echo $row['complaint'] ?></td>
                                        <td><?php echo $row['date_complaint_submitted'] ?></td>
                                        <td><?php echo $row['full_name1'] ?></td>
                                        <td><?php echo $row['user_name1'] ?></td>
                                        <td><?php echo $row['full_name2'] ?></td>
                                        <td><?php echo $row['user_name2'] ?></td>
                                        <td>
                                            <a href="?box=view_complaint_details&&id=<?php echo $row['id']; ?>"><button class="btn btn-primary m-1">View details</button></a>
                                            <a href="?box=delete&&id=<?php echo $row['id']; ?>"><button class="btn btn-danger m-1">delete</button></a>
                                        </td>
                                    </tr>

                                <?php

                                }

                                ?>
                            </table>
                        </div>

                    <?php

                    } else {

                    ?>
                        <p class="alert alert-warning my-4">
                            no data to view
                        </p>
                    <?php
                    }
                    $conn->close();

                    ?>
                </div>

            <?php

            } elseif ($box == "has_been_replied") {

                $id = $_SESSION['id'];

            ?>
                <div class="container my-4">
                    <div class="d-flex justify-content-between align-center mb-2">
                        <h3>Managing complaints that have been answered</h3>
                        <a href="?box=index"><button class="btn btn-primary">Unanswered Complaints</button></a>
                    </div>

                    <?php

                    require '../../connect.php';

                    $sql = "SELECT complaints.*, patients.id AS 'id2', patients.full_name AS 'full_name2', patients.user_name AS 'user_name2', patients.email_address AS 'email_address2', doctors.id AS 'id1', doctors.full_name AS 'full_name1', doctors.user_name AS 'user_name1', doctors.email_address AS 'email_address1' FROM complaints, patients, doctors WHERE complaints.complainant_id IS NULL AND complaints.accused_perso_id IS NULL AND complaints.reply_complaint IS NOT NULL AND complaints.complainant_id2 = doctors.id AND complaints.accused_perso_id2 = patients.id AND complaints.complainant_id2='$id' ORDER BY complaints.reply_date DESC";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        $counter = 1;

                    ?>

                        <div class="table-responsive my-3">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>complaint</th>
                                        <th>date complaint submitted</th>
                                        <th>Complainant Name</th>
                                        <th>The name of the complainant's account</th>
                                        <th>Defendant Name</th>
                                        <th>The name of the defendant's account</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>

                                <?php

                                while ($row = $result->fetch_assoc()) {

                                ?>

                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php echo $row['complaint'] ?></td>
                                        <td><?php echo $row['date_complaint_submitted'] ?></td>
                                        <td><?php echo $row['full_name1'] ?></td>
                                        <td><?php echo $row['user_name1'] ?></td>
                                        <td><?php echo $row['full_name2'] ?></td>
                                        <td><?php echo $row['user_name2'] ?></td>
                                        <td>
                                            <a href="?box=view_complaint_details&&id=<?php echo $row['id']; ?>"><button class="btn btn-primary m-1">View details</button></a>
                                            <a href="?box=delete&&id=<?php echo $row['id']; ?>"><button class="btn btn-danger m-1">delete</button></a>
                                        </td>
                                    </tr>

                                <?php

                                }

                                ?>
                            </table>
                        </div>

                    <?php

                    } else {

                    ?>
                        <p class="alert alert-warning my-4">
                            no data to view
                        </p>
                    <?php
                    }
                    $conn->close();

                    ?>
                </div>

            <?php

            } elseif ($box == "view_complaint_details") {

                $id = intval($_GET['id']);

                require '../../connect.php';

                $sql = "SELECT complaints.*, patients.id AS 'id2', patients.full_name AS 'full_name2', patients.user_name AS 'user_name2', patients.email_address AS 'email_address2', doctors.id AS 'id1', doctors.full_name AS 'full_name1', doctors.user_name AS 'user_name1', doctors.email_address AS 'email_address1' FROM complaints, patients, doctors WHERE complaints.id='$id' AND complaints.complainant_id2 = doctors.id AND complaints.accused_perso_id2 = patients.id";
                $result = $conn->query($sql);

                $row = $result->fetch_assoc();

            ?>

                <div class="container my-4">
                    <h4 class="my-2">view complaint details</h4>

                    <div class="d-flex flex-column gap-2">
                        <span><b>Complaint:</b> <?php echo $row['complaint']; ?></span>
                        <span><b>Complaint history:</b> <?php echo $row['date_complaint_submitted']; ?></span>


                        <span><b>Complainant Name:</b> <?php echo $row['full_name1']; ?></span>
                        <span><b>Complainant account name:</b> <?php echo $row['user_name1']; ?></span>
                        <span><b>Complainant's email:</b> <?php echo $row['email_address1']; ?></span>


                        <span><b>Name of the defendant:</b> <?php echo $row['full_name2']; ?></span>
                        <span><b>Defendant's account name:</b> <?php echo $row['user_name2']; ?></span>
                        <span><b>The complainant's email:</b> <?php echo $row['email_address2']; ?></span>
                        <?php

                        if (isset($row['reply_complaint']) && isset($row['reply_date'])) {
                        ?>
                            <span><b>The response that was sent to the complaint:</b> <?php echo $row['reply_complaint']; ?></span>
                            <span><b>Reply date:</b> <?php echo $row['reply_date']; ?></span>
                        <?php

                        } else {
                        ?>
                            <p class="alert alert-warning">
                                no response yet
                            </p>
                        <?php
                        }
                        ?>
                    </div>

                </div>
                <?php

            } elseif ($box == "delete") {

                require '../../static_functions.php';

                $id = intval($_GET['id']);

                require '../../connect.php';

                $sql = "DELETE FROM complaints WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                ?>
                    <p class="alert alert-success my-4 mx-2">
                        record deleted successfully
                    </p>
                    <?php
                } else {
                    echo "Error deleting record: " . $conn->error;
                }

                $conn->close();
                redirect("complaints_management.php", 2);
            } elseif ($box == "add_complaint") {

                require '../../static_functions.php';

                $complainant_id2 = $_SESSION['id'];

                $complaint = $accused_perso_id2 = "";
                $complaint_error = $accused_perso_id2_error = "";



                if (isset($_POST['btn_send'])) {

                    if (empty($_POST['complaint'])) {
                        $complaint_error = "Field is required *";
                    } else {
                        $complaint = examine_values($_POST['complaint']);
                    }
                    if (empty($_GET['accused_perso_id2'])) {
                        $accused_perso_id2_error = "Please try again!";
                    } else {
                        $accused_perso_id2 = examine_values($_GET['accused_perso_id2']);
                    }
                    if (!empty($complaint) && !empty($accused_perso_id2)) {

                        require '../../connect.php';

                        $sql = "INSERT INTO complaints(complaint, complainant_id2, accused_perso_id2) VALUES('$complaint', '$complainant_id2', '$accused_perso_id2')";

                        if ($conn->query($sql) === TRUE) {
                    ?>
                            <p class="alert alert-success my-3 mx-2">
                                New record created successfully
                            </p>
                <?php
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                        $conn->close();
                        redirect("complaints_management.php", 2);
                    }
                }

                ?>

                <div class="container my-4">
                    <h3 class="my-2">add complaint details</h3>
                    <form style="width: 100%; max-width: 450px;" class="mt-3 d-flex flex-column gap-2" action="<?php echo $_SERVER['PHP_SELF']; ?>?box=add_complaint&accused_perso_id2=<?php echo $_GET['accused_perso_id2'] ?>" method="post">
                        <div class="form-group">
                            <label for="complaint">complaint: </label> <?php echo $complaint_error; ?> <br>
                            <textarea class="form-control" name="complaint" id="" cols="30" rows="4"></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" value="SEND" name="btn_send">
                    </form>
                </div>

            <?php
            }
        } else {

            ?>

            <script>
                alert("Your account has been suspended. Email the admin to reactivate it project.system.email.2023@gmail.com ");
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
} else {

    ?>

    <script>
        alert("Unauthorized entry");
    </script>

<?php

}

include "../includes/footer.php";
