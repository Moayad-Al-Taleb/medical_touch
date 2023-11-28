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
                <div class="d-flex aling-center justify-content-center w-100 gap-4 flex-wrap">
                    <a class="section-btn" href="complaints_management1.php">
                        <ion-icon name="people-circle" size="large"></ion-icon>
                        <span>Complaints made by patients</span></a>
                    <a class="section-btn" href="complaints_management2.php">
                        <ion-icon name="person" size="large"></ion-icon>
                        <span>Complaints made by doctors</span></a>
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

?>