<?php

session_start();
$page_title = "Specialties Management";
include "../includes/header.php";

if (isset($_SESSION['id'])) {

    if ($_SESSION['account_type'] == 1) {

        $box = isset($_GET['box']) ? $_GET['box'] : "index";

        if ($box == "index") {

?>
            <div class="container">
                <div class=" mt-4 justify-content-between align-items-center">

                    <a href="?box=add"><button class="btn btn-primary">add new</button></a>
                </div>
                <?php

                require '../../connect.php';

                $sql = "SELECT * FROM specialties";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    $counter = 1;

                ?>

                    <div class="table-responsive my-4">
                        <table class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">description</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td style="min-width: 300px;"><?php echo $row['description'] ?></td>
                                        <td><a href="?box=delete&&id=<?php echo $row['id']; ?>"><button class="btn btn-danger">delete</button></a></td>
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
            </div>

            <?php
        } elseif ($box == "add") {

            require '../../static_functions.php';

            $name = $description = "";
            $name_error = $description_error = "";

            if (isset($_POST['btn_send'])) {

                if (empty($_POST['name'])) {
                    $name_error = "**";
                } else {
                    $name = examine_values($_POST['name']);
                }

                if (empty($_POST['description'])) {
                    $description_error = "**";
                } else {
                    $description = examine_values($_POST['description']);
                }

                if (!empty($name) && !empty($description)) {

                    require '../../connect.php';

                    $sql = "SELECT * FROM specialties WHERE name='$name'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
            ?>
                        <script>
                            alert("The data entered already exists.");
                        </script>
                        <?php
                    } else {

                        $sql = "INSERT INTO specialties(name, description) VALUES('$name', '$description')";

                        if ($conn->query($sql) === TRUE) {
                        ?>
                            <div class="alert alert-success m-4">
                                record added successfully
                            </div>
            <?php
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                    $conn->close();
                    redirect("specialties_management.php", 2);
                }
            }

            ?>

            <div class="container">
                <div class="d-flex w-100 mt-4 justify-content-between align-items-center">
                    <h4>add new speciality</h4>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?box=add" method="post" style="width: 100%; max-width: 450px;" class="mt-3 d-flex flex-column gap-2">
                    <div class="form-group">
                        <div>
                            <label for="name">name:</label>
                            <span class="text-danger"><?php echo $name_error ?></span>
                        </div>
                        <input type="text" name="name" id="name" class="form-control" id="exampleFormControlTextarea1" required />
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="description">description:</label>
                            <span class="text-danger"><?php echo $description_error ?></span>
                        </div>
                        <textarea name="description" id="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn_send">submit</button>
                </form>
            </div>

            <?php
        } elseif ($box == "delete") {

            require '../../static_functions.php';

            $id = intval($_GET['id']);

            require '../../connect.php';

            $sql = "DELETE FROM specialties WHERE id='$id'";

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
            redirect("specialties_management.php", 2);
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