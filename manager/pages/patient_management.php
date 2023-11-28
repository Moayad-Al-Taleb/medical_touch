<?php

session_start();
$page_title = "patients management";

if (isset($_SESSION['id'])) {

    if ($_SESSION['account_type'] == 1) {

        $box = isset($_GET['box']) ? $_GET['box'] : "index";

        if ($box == "index") {
            include "../includes/header.php";

?>

            <div class="container">
                <div class=" mt-4 justify-content-between align-items-center">
                    <div class="input-field">
                        <label for="">search by patient name</label>
                        <input class="form-control w-25" type="text" name="search" id="searchInput" placeholder="ex: john doe" required>
                    </div>
                </div>

                <?php

                require '../../connect.php';
                $sql = "SELECT * FROM patients ORDER BY patients.account_status ASC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $counter = 1;
                ?>

                    <div class="table-responsive my-4">
                        <table id="userTable" class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">full name</th>
                                    <th scope="col">user name</th>
                                    <th scope="col">email address</th>
                                    <th scope="col">account status</th>
                                    <th scope="col">activity status</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    $account_status = ($row['account_status'] == 1) ? "account is active" : "account is inactive";
                                    $account_activity_status = ($row['activity_status'] == 1) ? "online account" : "The account is offline";

                                    echo '<tr>';
                                    echo '<td>' . $counter++ . '</td>';
                                    echo '<td>' . $row['full_name'] . '</td>';
                                    echo '<td>' . $row['user_name'] . '</td>';
                                    echo '<td>' . $row['email_address'] . '</td>';
                                    echo '<td>' . $account_status . '</td>';
                                    echo '<td>' . $account_activity_status . '</td>';
                                    echo '<td><div> <a href="?box=view&&id=' . $row['id'] . '"><button class="btn btn-primary m-1" >view</button></a>' .
                                        ($row['account_status'] == 1 ? '<a href="?box=deactivate&&id=' . $row['id'] . '"><button class="btn btn-warning m-1">Deactivate</button></a>' : '<a href="?box=activate&&id=' . $row['id'] . '"><button class="btn btn-warning m-1">Activate</button></a>') .
                                        '<a href="?box=delete&&id=' . $row['id'] . '"><button class="btn btn-danger m-1">delete</button></a> </div></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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
            <script>
                $(document).ready(function() {
                    $('#searchInput').keyup(function() {
                        var searchText = $(this).val();

                        if (searchText.trim() === '') {
                            // If search text is empty, fetch all data
                            fetchAllData();
                        } else {
                            // Perform search for non-empty input
                            performSearch(searchText);
                        }
                    });
                });

                function fetchAllData() {
                    $.ajax({
                        type: 'POST',
                        url: 'patient_management.php?box=search', // Path to your PHP script to fetch all data
                        success: function(response) {
                            $('#userTable tbody').html(response);
                        }
                    });
                }

                function performSearch(searchText) {
                    $.ajax({
                        type: 'POST',
                        url: 'patient_management.php?box=search', // Path to your PHP script to handle the search
                        data: {
                            search: searchText
                        },
                        success: function(response) {
                            $('#userTable tbody').html(response);
                        }
                    });
                }
            </script>
        <?php

        } elseif ($box == "view") {
            include "../includes/header.php";

            require '../../static_functions.php';

            $id = intval($_GET['id']);

            require '../../connect.php';

            $sql = "SELECT * FROM patients WHERE id='$id'";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();

        ?>

            <div class="container">
                <div class="d-flex w-100 mt-4 justify-content-between align-items-center">
                    <h4>Patient information</h4>
                    <div>
                        <?php
                        if ($row['account_status'] == 1) {
                        ?>
                            <a href="?box=deactivate&&id=<?php echo $row['id']; ?>"><button class="btn btn-warning ">Deactivate</button></a>
                        <?php
                        } else {
                        ?>
                            <a href="?box=activate&&id=<?php echo $row['id']; ?>"><button class="btn btn-warning ">Activate</button></a>
                        <?php
                        }
                        ?>
                        <a href="?box=delete&&id=<?php echo $row['id']; ?>"><button class="btn btn-danger ">Delete</button></a>
                    </div>

                </div>

                <div class="d-flex flex-column gap-2 my-4">
                    <span><b>full name:</b> <?php echo $row['full_name']; ?></span>
                    <span><b>date birth:</b> <?php echo $row['date_birth']; ?></span>
                    <span><b>gender:</b> <?php echo ($row['gender'] == 1) ? "male" : "female";  ?></span>
                    <span><b>contact information:</b> <?php echo $row['contact_information']; ?></span>
                    <span><b>address:</b> <?php echo $row['address']; ?></span>
                    <span><b>medical history:</b> <?php echo $row['medical_history']; ?></span>
                    <span><b>user name:</b> <?php echo $row['user_name']; ?></span>
                    <span><b>email address:</b> <?php echo $row['email_address']; ?></span>
                    <span><b>account status:</b> <?php echo ($row['account_status'] == 1) ? "account is active" : "account is inactive"; ?></span>
                    <span><b>activity status:</b> <?php echo ($row['activity_status'] == 1) ? "online account" : "The account is offline"; ?></span>
                </div>

            </div>
            <?php

        } elseif ($box == "deactivate") {

            include "../includes/header.php";
            require '../../static_functions.php';

            $id = intval($_GET['id']);

            require '../../connect.php';

            $sql = "UPDATE patients SET account_status=2 WHERE id='$id'";

            if (mysqli_query($conn, $sql)) {
            ?>
                <div class="alert alert-success m-4">
                    Record updated successfully
                </div>
            <?php
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }

            $conn->close();
            redirect("patient_management.php", 2);
        } elseif ($box == "activate") {


            include "../includes/header.php";
            require '../../static_functions.php';

            $id = intval($_GET['id']);

            require '../../connect.php';

            $sql = "UPDATE patients SET account_status=1 WHERE id='$id'";

            if (mysqli_query($conn, $sql)) {
            ?>
                <div class="alert alert-success m-4">
                    Record updated successfully
                </div>
            <?php
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }

            $conn->close();
            redirect("patient_management.php", 2);
        } elseif ($box == "delete") {

            include "../includes/header.php";
            require '../../static_functions.php';

            $id = intval($_GET['id']);

            require '../../connect.php';

            $sql = "DELETE FROM patients WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
            ?>
                <div class="alert alert-success m-4">
                    Record deleted successfully
                </div>
        <?php
            } else {
                echo "Error deleting record: " . $conn->error;
            }

            $conn->close();
            redirect("patient_management.php", 2);
        } elseif ($box == "search") {

            require '../../static_functions.php';
            require '../../connect.php';

            $searchText = "";
            if (!empty($_POST['search'])) {
                $searchText = examine_values($_POST['search']);
            }


            $sql = "SELECT * FROM patients WHERE user_name LIKE '%$searchText%'";
            $result = $conn->query($sql);

            $html = '';

            if ($result->num_rows > 0) {
                $counter = 1;

                while ($row = $result->fetch_assoc()) {
                    $account_status = ($row['account_status'] == 1) ? "account is active" : "account is inactive";
                    $account_activity_status = ($row['activity_status'] == 1) ? "online account" : "The account is offline";

                    $html .= '<tr>';
                    $html .= '<td>' . $counter++ . '</td>';
                    $html .= '<td>' . $row['full_name'] . '</td>';
                    $html .= '<td>' . $row['user_name'] . '</td>';
                    $html .= '<td>' . $row['email_address'] . '</td>';
                    $html .= '<td>' . $account_status . '</td>';
                    $html .= '<td>' . $account_activity_status . '</td>';
                    $html .= '<td> <a href="?box=view&&id=' . $row['id'] . '"><button class="btn btn-primary m-1">View</button></a>';
                    if ($row['account_status'] == 1) {
                        $html .= '<a href="?box=deactivate&&id=' . $row['id'] . '"><button class="btn btn-warning m-1">Deactivate</button></a>';
                    } else {
                        $html .= '<a href="?box=activate&&id=' . $row['id'] . '"><button class="btn btn-warning m-1">Activate</button></a>';
                    }
                    $html .= '<a href="?box=delete&&id=' . $row['id'] . '"><button class="btn btn-danger m-1">Delete</button></a></td>';
                    $html .= '</tr>';
                }
            } else {
                $html .= "<tr><td colspan='7'>no data</td></tr>";
            }
            $conn->close();
            echo $html;
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