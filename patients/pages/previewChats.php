<?php

session_start();
$page_title = "my chats";
include "../includes/header.php";

if (isset($_SESSION['id'])) {

    if ($_SESSION['account_type'] == 3) {
        if ($_SESSION['account_status'] == 1) {

            $box = isset($_GET['box']) ? $_GET['box'] : "index";

            if ($box == "index") {

                require '../../connect.php';

                $recipient_id2 = $_SESSION['id'];

                $sql = "SELECT doctors.id, doctors.user_name, doctors.activity_status FROM doctors WHERE doctors.id IN ( SELECT messages.sender_id2 FROM messages WHERE messages.recipient_id2 = '$recipient_id2' )";
                $result = $conn->query($sql);
?>
                <div class="main-page-wrapper">
                    <div class="select-person">
                        <?php

                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <a class="chat-user-btn" target="myFrame" href="../../chat.php?box=start_chat&&doctor_id=<?php echo $row['id']; ?>">
                                <span><?php echo $row['user_name'] ?> </span>
                                <div class="activit-stutas">
                                    <?php
                                    echo ($row['activity_status'] == 1) ? "<div class='online'></div>" : "<div class='offline'></div>";
                                    ?>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="chat-page">
                        <iframe name="myFrame" src="../../chat.php" width="100%" height="100%" frameborder="0"></iframe>
                    </div>
                    <?php
                    if ($result->num_rows > 0) {
                    }
                    ?>
                </div>
            <?php
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
