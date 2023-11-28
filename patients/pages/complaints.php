<?php
ob_start();
session_start();

include "../includes/header.php";
if (isset($_SESSION['id'])) {
    if ($_SESSION['account_type'] == 3) {

        if ($_SESSION['account_status'] == 1) {

            $box = isset($_GET['box']) ? $_GET['box'] : "index";
            if ($box == "index") {

?>
                <main class="container">
                    <div class="complaints-header">
                        <h2 class="">my Unanswered Complaints</h2>
                        <div>
                            <a href="?box=has_been_replied" class="main-btn">answered complaints</a>
                        </div>
                    </div>
                    <?php
                    $id = $_SESSION['id'];

                    require '../../connect.php';

                    $sql = "SELECT complaints.*, patients.id AS 'id1', patients.full_name AS 'full_name1', patients.user_name AS 'user_name1', patients.email_address AS 'email_address1', doctors.id AS 'id2', doctors.full_name AS 'full_name2', doctors.user_name AS 'user_name2', doctors.email_address AS 'email_address2' FROM complaints, patients, doctors WHERE complaints.complainant_id2 IS NULL AND complaints.accused_perso_id2 IS NULL AND complaints.reply_complaint IS NULL AND complaints.complainant_id = patients.id AND complaints.accused_perso_id = doctors.id AND complaints.complainant_id='$id' ORDER BY complaints.date_complaint_submitted DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        $counter = 1;

                    ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-head">
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
                                <tbody>
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
                                                <a href="?box=view_complaint_details&&id=<?php echo $row['id']; ?>"><button class="main-btn">View details</button></a>
                                                <a href="?box=delete&&id=<?php echo $row['id']; ?>"><button class="third-btn">delete</button></a>
                                            </td>
                                        </tr>

                                    <?php

                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    } else {
                        echo "No data has been added.";
                    }
                    $conn->close();
                    ?>

                </main>
            <?php
            } elseif ($box == "has_been_replied") {
            ?>
                <main class="container">
                    <div class="complaints-header">
                        <h2 class="">my answered Complaints</h2>
                        <div>
                            <a href="?box=index" class="main-btn">unanswered complaints</a>
                        </div>
                    </div>
                    <?php
                    $id = $_SESSION['id'];

                    require '../../connect.php';

                    $sql = "SELECT complaints.*, patients.id AS 'id1', patients.full_name AS 'full_name1', patients.user_name AS 'user_name1', patients.email_address AS 'email_address1', doctors.id AS 'id2', doctors.full_name AS 'full_name2', doctors.user_name AS 'user_name2', doctors.email_address AS 'email_address2' FROM complaints, patients, doctors WHERE complaints.complainant_id2 IS NULL AND complaints.accused_perso_id2 IS NULL AND complaints.reply_complaint IS NOT NULL AND complaints.complainant_id = patients.id AND complaints.accused_perso_id = doctors.id AND complaints.complainant_id='$id' ORDER BY complaints.reply_date DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        $counter = 1;

                    ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-head">
                                    <tr>
                                        <th>#</th>
                                        <th>complaint</th>
                                        <th>date complaint submitted</th>
                                        <th>Complainant Name</th>
                                        <th>The name of the complainant's account</th>
                                        <th>Defendant Name</th>
                                        <th>The name of the defendant's account</th>
                                        <th>The response that was sent</th>
                                        <th>Reply date</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <td><?php echo $row['reply_complaint'] ?></td>
                                            <td><?php echo $row['reply_date'] ?></td>
                                            <td align="center">
                                                <a href="?box=view_complaint_details&&id=<?php echo $row['id']; ?>"><button class="main-btn">View complaint details</button></a>
                                                <a href="?box=delete&&id=<?php echo $row['id']; ?>"><button class="third-btn">delete</button></a>
                                            </td>
                                        </tr>

                                    <?php

                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    } else {
                        echo "No data has been added.";
                    }
                    $conn->close();
                    ?>

                </main>
            <?php
            } elseif ($box == "view_complaint_details") {

                $id = intval($_GET['id']);

                require '../../connect.php';

                $sql = "SELECT complaints.*, patients.id AS 'id1', patients.full_name AS 'full_name1', patients.user_name AS 'user_name1', patients.email_address AS 'email_address1', doctors.id AS 'id2', doctors.full_name AS 'full_name2', doctors.user_name AS 'user_name2', doctors.email_address AS 'email_address2' FROM complaints, patients, doctors WHERE complaints.id='$id' AND complaints.complainant_id = patients.id AND complaints.accused_perso_id = doctors.id";
                $result = $conn->query($sql);

                $row = $result->fetch_assoc();

            ?>
                <div class="container">

                    <h2 class="main-text-color">view complaint details</h2>
                    <br> <br>

                    <div class="doctor-info">
                        <div>
                            <span><b>Complaint:</b> <?php echo $row['complaint']; ?></span>
                            <span><b>Complaint history:</b> <?php echo $row['date_complaint_submitted']; ?></span>
                            <span><b>Complainant Name:</b> <?php echo $row['full_name1']; ?></span>
                            <span><b>Complainant account name:</b><?php echo $row['user_name1']; ?> </span>
                            <span><b>Complainant's email:</b> <?php echo $row['email_address1']; ?></span>
                        </div>
                        <div>
                            <span><b>Name of the defendant:</b> <?php echo $row['full_name2']; ?></span>
                            <span><b>Defendant's account name:</b> <?php echo $row['user_name2']; ?> </span>
                            <span><b>The complainant's email:</b><?php echo $row['email_address2']; ?></span>
                            <?php
                            if (isset($row['reply_complaint']) && isset($row['reply_date'])) {
                            ?>
                                <span><b>The response that was sent to the complaint:</b> <?php echo $row['reply_complaint']; ?></span>
                                <span><b>Reply date:</b> <?php echo $row['reply_date']; ?></span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php

            } elseif ($box == "add_complaint") {

                require '../../static_functions.php';

                $complainant_id = $_SESSION['id'];

                $complaint = $accused_perso_id = "";
                $complaint_error = $accused_perso_id_error = "";

                if (isset($_POST['btn_send'])) {

                    if (empty($_POST['complaint'])) {
                        $complaint_error = "Field is required *";
                    } else {
                        $complaint = examine_values($_POST['complaint']);
                    }

                    if (empty($_GET['accused_perso_id'])) {
                        $accused_perso_id_error = "Field is required *";
                    } else {
                        $accused_perso_id = examine_values($_GET['accused_perso_id']);
                    }

                    if (!empty($complaint) && !empty($accused_perso_id)) {

                        require '../../connect.php';

                        $sql = "INSERT INTO complaints(complaint, complainant_id, accused_perso_id) VALUES('$complaint', '$complainant_id', '$accused_perso_id')";

                        if ($conn->query($sql) === TRUE) {
                ?>
                            <p class="success-message ">
                                new record added successfully
                            </p>
                <?php
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                        $conn->close();
                        redirect("complaints.php", 2);
                    }
                }

                ?>
                <div class="container">
                    <h2 class="main-text-color">add new complaint</h2>
                    <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>?box=add_complaint&accused_perso_id=<?php echo $_GET['accused_perso_id'] ?>" method="post">
                        <div class="form-group">
                            <label for="complaint">complaint: </label> <?php echo $complaint_error; ?>
                            <textarea class="input-field" name="complaint" id="" cols="30" rows="3"></textarea>
                        </div>
                        <input type="submit" class="main-btn" value="SEND" name="btn_send">
                    </form>
                </div>

                <?php
            } elseif ($box == "delete") {

                require '../../static_functions.php';

                $id = intval($_GET['id']);

                require '../../connect.php';

                $sql = "DELETE FROM complaints WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                ?>
                    <p class="success-message ">
                        record deleted successfully
                    </p>
            <?php
                } else {
                    echo "Error deleting record: " . $conn->error;
                }

                $conn->close();
                redirect("complaints.php", 2);
            }
        } else {

            ?>

            <script>
                alert("Your account has been suspended. Email the admin to reactivate it project.system.email .2023 @gmail.com ");
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
ob_end_flush();
