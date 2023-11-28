<?php

session_start();
$page_title = "manage complaints";
include "../includes/header.php";

if (isset($_SESSION['id'])) {

    if ($_SESSION['account_type'] == 1) {


        $box = isset($_GET['box']) ? $_GET['box'] : "index";

        if ($box == "index") {

?>

            <div class="container my-4">
                <div class="d-flex mt-4 justify-content-between align-items-center">
                    <h4>Managing Unanswered Complaints</h4>
                    <a href="?box=has_been_replied"><button class="btn btn-primary">Complaints That Have Been Answered</button></a>
                </div>
                <?php

                require '../../connect.php';

                $sql = "SELECT complaints.*, patients.id AS 'id1', patients.full_name AS 'full_name1', patients.user_name AS 'user_name1', patients.email_address AS 'email_address1', doctors.id AS 'id2', doctors.full_name AS 'full_name2', doctors.user_name AS 'user_name2', doctors.email_address AS 'email_address2' FROM complaints, patients, doctors WHERE complaints.complainant_id2 IS NULL AND complaints.accused_perso_id2 IS NULL AND complaints.reply_complaint IS NULL AND complaints.complainant_id = patients.id AND complaints.accused_perso_id = doctors.id ORDER BY complaints.date_complaint_submitted DESC";
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
                                        <td align="center">
                                            <a href="?box=view_complaint_details&&id=<?php echo $row['id']; ?>"><button class="btn btn-primary m-1">View details</button></a>
                                            <a href="?box=delete&&id=<?php echo $row['id']; ?>"><button class="btn btn-danger m-1 ">delete</button></a>
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

                ?>
                    <div class="alert alert-warning m-4">
                        no data to show
                    </div>
                <?php
                }
                $conn->close();

                ?>
            </div>

        <?php

        } elseif ($box == "has_been_replied") {

        ?>

            <div class="container my-4">
                <div class="d-flex mt-4 justify-content-between align-items-center">
                    <h4>Managing answered Complaints</h4>
                    <a href="?box=index"><button class="btn btn-primary">Unanswered Complaints</button></a>
                </div>
                <?php

                require '../../connect.php';

                $sql = "SELECT complaints.*, patients.id AS 'id1', patients.full_name AS 'full_name1', patients.user_name AS 'user_name1', patients.email_address AS 'email_address1', doctors.id AS 'id2', doctors.full_name AS 'full_name2', doctors.user_name AS 'user_name2', doctors.email_address AS 'email_address2' FROM complaints, patients, doctors WHERE complaints.complainant_id2 IS NULL AND complaints.accused_perso_id2 IS NULL AND complaints.reply_complaint IS NOT NULL AND complaints.complainant_id = patients.id AND complaints.accused_perso_id = doctors.id ORDER BY complaints.reply_date DESC";
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
                                            <a href="?box=view_complaint_details&&id=<?php echo $row['id']; ?>"><button class="btn btn-primary m-1">View details</button></a>
                                            <a href="?box=delete&&id=<?php echo $row['id']; ?>"><button class="btn btn-danger m-1 ">delete</button></a>
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

                ?>
                    <div class="alert alert-warning m-4">
                        no data to show
                    </div>
                <?php
                }
                $conn->close();

                ?>
            </div>

        <?php

        } elseif ($box == "view_complaint_details") {

            $id = intval($_GET['id']);

            require '../../connect.php';

            $sql = "SELECT complaints.*, patients.id AS 'id1', patients.full_name AS 'full_name1', patients.user_name AS 'user_name1', patients.email_address AS 'email_address1', doctors.id AS 'id2', doctors.full_name AS 'full_name2', doctors.user_name AS 'user_name2', doctors.email_address AS 'email_address2' FROM complaints, patients, doctors WHERE complaints.id='$id' AND complaints.complainant_id = patients.id AND complaints.accused_perso_id = doctors.id";
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

                    }
                    ?>
                </div>
                <?php

                if (isset($row['reply_complaint']) && isset($row['reply_date'])) {

                ?>

                    <a href="?box=delete_reply&&id=<?php echo $row['id']; ?>"><button class="btn btn-danger my-2">delete reply</button></a>

                <?php

                } else {

                ?>

                    <a href="?box=respond_complaint&&id=<?php echo $row['id']; ?>"><button class="btn btn-info my-2">respond complaint</button></a>

                <?php

                }

                ?>

            </div>
            <?php

        } elseif ($box == "delete") {

            require '../../static_functions.php';

            $id = intval($_GET['id']);

            require '../../connect.php';

            $sql = "DELETE FROM complaints WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
            ?>
                <div class="alert alert-success m-4">
                    record deleted successfully
                </div>
            <?php
            } else {
                echo "Error deleting record: " . $conn->error;
            }

            $conn->close();
            redirect("complaints_management1.php", 2);
        } elseif ($box == "delete_reply") {

            require '../../static_functions.php';

            $id = intval($_GET['id']);

            require '../../connect.php';

            $sql = "UPDATE complaints SET complaints.reply_complaint=NULL, complaints.reply_date=NULL WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
            ?>
                <div class="alert alert-success m-4">
                    record deleted successfully
                </div>
                <?php
            } else {
                echo "Error deleting record: " . $conn->error;
            }

            $conn->close();
            redirect("complaints_management1.php", 2);
        } elseif ($box == "respond_complaint") {

            require '../../static_functions.php';

            $id = intval($_GET['id']);

            $reply_complaint = $reply_date = "";
            $reply_complaint_error = "";

            if (isset($_POST['btn_send'])) {

                if (empty($_POST['reply_complaint'])) {
                    $reply_complaint_error = "Field is required *";
                } else {
                    $reply_complaint = examine_values($_POST['reply_complaint']);
                }

                $dt = new DateTime("now", new DateTimeZone('Asia/Damascus'));
                $reply_date = $dt->format('Y-m-d H:i:s');

                if (!empty($reply_complaint) && !empty($reply_date)) {

                    require '../../connect.php';

                    $sql = "UPDATE complaints SET complaints.reply_complaint='$reply_complaint', complaints.reply_date='$reply_date' WHERE id='$id'";

                    if ($conn->query($sql) === TRUE) {
                ?>
                        <div class="alert alert-success m-4">
                            record added successfully
                        </div>
            <?php
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                    $conn->close();
                    redirect("complaints_management1.php", 2);
                }
            }

            ?>

            <div class="container">
                <h4>respond complaint</h4>

                <form style="width: 100%; max-width: 450px;" class="mt-3 d-flex flex-column gap-2" action="<?php echo $_SERVER['PHP_SELF']; ?>?box=respond_complaint&&id=<?php echo $id; ?>" method="post">
                    <div class="form-group">
                        <div>
                            <label for="reply_complaint">reply complaint: </label>
                            <span class="text-danger"><?php echo $reply_complaint_error ?></span>
                        </div>
                        <textarea class="form-control" name="reply_complaint" id="reply_complaint" cols="30" rows="10"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" value="SEND" name="btn_send">
                </form>

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
?>