<?php
session_start();

if (isset($_SESSION['id'])) {

    $box = (isset($_GET['box'])) ? $_GET['box'] : "start_chat";

    if ($box == "start_chat") {
?>
        <?php
        if (isset($_GET['fromDoctor']) and $_GET['fromDoctor'] == "yes") {
        ?>
            <!DOCTYPE html>
            <html>

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="chat.css">
                <link rel="stylesheet" href="patients/styles/main.css">
                <script src="assets/jquery/code.jquery.com_jquery-3.7.0.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            </head>

            <body>
                <header>
                    <div class="header-logo" style="display: flex; align-items: center; gap: 16px;">
                        <span>logo</span>
                    </div>
                    <nav>
                        <a href="patients/pages/home-page.php">home page</a>
                        <a href="patients/pages/specialities.php">medical specialities</a>
                        <a href="patients/pages/doctors.php">doctors</a>
                    </nav>
                    <div class="header-list-wrapper header-list-wrapper-NO">
                        <ul class="header-list">
                            <li>
                                <svg class="icon" id="SvgjsSvg1176" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                                    <defs id="SvgjsDefs1177"></defs>
                                    <g id="SvgjsG1178"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92 92">
                                            <path d="M46 0C20.6 0 0 20.6 0 46s20.6 46 46 46 46-20.6 46-46S71.4 0 46 0zm3.7 83.8c-.2 0-.4 0-.7.1V62.2c5.2-.1 9.9-.2 14.2-.5-3.8 11.7-10.9 19.5-13.5 22.1zm-7.4 0c-2.7-2.7-9.7-10.5-13.5-22.1 4.2.3 9 .5 14.2.5v21.7c-.2 0-.4-.1-.7-.1zM8 46c0-2.5.3-5 .7-7.4 2.2-.4 6.4-1 12.3-1.6-.5 2.9-.8 5.9-.8 9.1 0 3.2.3 6.2.7 9-5.8-.6-10.1-1.2-12.3-1.6-.3-2.5-.6-5-.6-7.5zm18.3 0c0-3.4.4-6.6 1-9.6 4.6-.3 9.8-.6 15.7-.6v20.4c-5.8-.1-11.1-.3-15.8-.7-.5-2.9-.9-6.1-.9-9.5zM49.6 8.2c2.7 2.7 9.6 10.7 13.5 22.1-4.2-.3-8.9-.5-14.1-.5V8.1c.2 0 .4.1.6.1zM43 8.1v21.7c-5.2.1-9.9.2-14.1.5 3.8-11.4 10.8-19.4 13.4-22.1.3 0 .5-.1.7-.1zm6 48.1V35.8c5.8.1 11.1.3 15.7.6.6 3 1 6.2 1 9.6 0 3.4-.3 6.6-.9 9.6-4.6.3-9.9.5-15.8.6zM70.9 37c5.9.6 10.1 1.2 12.3 1.6.5 2.4.8 4.9.8 7.4s-.3 5-.7 7.4c-2.2.4-6.4 1-12.3 1.6.5-2.9.7-5.9.7-9.1 0-3-.3-6.1-.8-8.9zm10.5-4.8c-2.8-.4-6.8-.9-11.9-1.4-2.4-8.6-6.6-15.5-10.1-20.4 10.1 3.8 18.1 11.8 22 21.8zM32.6 10.4c-3.6 4.8-7.7 11.7-10.1 20.3-5 .4-9 1-11.9 1.4 3.9-9.9 12-17.9 22-21.7zm-22 49.4c2.8.4 6.8.9 11.8 1.4 2.4 8.6 6.4 15.5 10 20.3-10-3.9-17.9-11.8-21.8-21.7zm49 21.7c3.6-4.8 7.6-11.6 10-20.2 5-.4 9-1 11.8-1.4-3.9 9.8-11.8 17.7-21.8 21.6z" fill="#50b3ba" class="color000 svgShape"></path>
                                        </svg></g>
                                </svg>
                            </li>
                            <li class="person-item">
                                <div class="sign-in-wrapper">
                                    <svg class="icon" id="SvgjsSvg1159" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                                        <defs id="SvgjsDefs1160"></defs>
                                        <g id="SvgjsG1161"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z" fill="#50b3ba" class="color000 svgShape"></path>
                                            </svg></g>
                                    </svg>
                                    <?php
                                    if (isset($_SESSION['id'])) {
                                    ?>
                                        <a><?php echo $_SESSION['user_name'] ?></a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="patients/pages/login.php">sign in</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if (isset($_SESSION['id'])) {
                                ?>
                                    <ul class="personal-list">
                                        <li><a href="patients/pages/previewChats.php">chats</a></li>
                                        <li><a href="patients/pages/complaints.php">complaints</a></li>
                                        <li><a href="patients/pages/profile.php">profile</a></li>
                                        <li><a href="patients/pages/logout.php">sign out</a></li>
                                    </ul>
                                <?php
                                } else {
                                ?>
                                <?php
                                }
                                ?>
                            </li>
                        </ul>
                    </div>


                    <div class="responsive-header-els">
                        <div style="display: flex; align-items: center; gap: 16px;">
                            <div class="menu-icon">
                                <svg class="icon" id="SvgjsSvg1011" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                                    <defs id="SvgjsDefs1012"></defs>
                                    <g id="SvgjsG1013"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path fill="#50b3ba" d="M3 6a1 1 0 0 1 1-1h16a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1zm0 6a1 1 0 0 1 1-1h16a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1zm1 5a1 1 0 1 0 0 2h16a1 1 0 1 0 0-2H4z" class="color000 svgShape"></path>
                                        </svg></g>
                                </svg>
                            </div>
                            <span>logo</span>
                        </div>
                        <div class="header-list-wrapper">
                            <ul class="header-list">
                                <li>
                                    <svg class="icon" id="SvgjsSvg1176" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                                        <defs id="SvgjsDefs1177"></defs>
                                        <g id="SvgjsG1178"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92 92">
                                                <path d="M46 0C20.6 0 0 20.6 0 46s20.6 46 46 46 46-20.6 46-46S71.4 0 46 0zm3.7 83.8c-.2 0-.4 0-.7.1V62.2c5.2-.1 9.9-.2 14.2-.5-3.8 11.7-10.9 19.5-13.5 22.1zm-7.4 0c-2.7-2.7-9.7-10.5-13.5-22.1 4.2.3 9 .5 14.2.5v21.7c-.2 0-.4-.1-.7-.1zM8 46c0-2.5.3-5 .7-7.4 2.2-.4 6.4-1 12.3-1.6-.5 2.9-.8 5.9-.8 9.1 0 3.2.3 6.2.7 9-5.8-.6-10.1-1.2-12.3-1.6-.3-2.5-.6-5-.6-7.5zm18.3 0c0-3.4.4-6.6 1-9.6 4.6-.3 9.8-.6 15.7-.6v20.4c-5.8-.1-11.1-.3-15.8-.7-.5-2.9-.9-6.1-.9-9.5zM49.6 8.2c2.7 2.7 9.6 10.7 13.5 22.1-4.2-.3-8.9-.5-14.1-.5V8.1c.2 0 .4.1.6.1zM43 8.1v21.7c-5.2.1-9.9.2-14.1.5 3.8-11.4 10.8-19.4 13.4-22.1.3 0 .5-.1.7-.1zm6 48.1V35.8c5.8.1 11.1.3 15.7.6.6 3 1 6.2 1 9.6 0 3.4-.3 6.6-.9 9.6-4.6.3-9.9.5-15.8.6zM70.9 37c5.9.6 10.1 1.2 12.3 1.6.5 2.4.8 4.9.8 7.4s-.3 5-.7 7.4c-2.2.4-6.4 1-12.3 1.6.5-2.9.7-5.9.7-9.1 0-3-.3-6.1-.8-8.9zm10.5-4.8c-2.8-.4-6.8-.9-11.9-1.4-2.4-8.6-6.6-15.5-10.1-20.4 10.1 3.8 18.1 11.8 22 21.8zM32.6 10.4c-3.6 4.8-7.7 11.7-10.1 20.3-5 .4-9 1-11.9 1.4 3.9-9.9 12-17.9 22-21.7zm-22 49.4c2.8.4 6.8.9 11.8 1.4 2.4 8.6 6.4 15.5 10 20.3-10-3.9-17.9-11.8-21.8-21.7zm49 21.7c3.6-4.8 7.6-11.6 10-20.2 5-.4 9-1 11.8-1.4-3.9 9.8-11.8 17.7-21.8 21.6z" fill="#50b3ba" class="color000 svgShape"></path>
                                            </svg></g>
                                    </svg>
                                </li>
                                <li class="person-item">
                                    <div class="sign-in-wrapper">
                                        <svg class="icon" id="SvgjsSvg1159" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                                            <defs id="SvgjsDefs1160"></defs>
                                            <g id="SvgjsG1161"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z" fill="#50b3ba" class="color000 svgShape"></path>
                                                </svg></g>
                                        </svg>
                                        <?php
                                        if (isset($_SESSION['id'])) {
                                        ?>
                                            <a><?php echo $_SESSION['user_name'] ?></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="patients/pages/login.php">sign in</a>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['id'])) {
                                    ?>
                                        <ul class="personal-list">
                                            <li><a href="patients/pages/previewChats.php">chats</a></li>
                                            <li><a href="patients/pages/complaints.php">complaints</a></li>
                                            <li><a href="patients/pages/profile.php">profile</a></li>
                                            <li><a href="patients/pages/logout.php">sign out</a></li>
                                        </ul>
                                    <?php
                                    } else {
                                    ?>

                                    <?php
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="responsive-links">
                        <a href="patients/pages/home-page.php">home page</a>
                        <a href="patients/pages/specialities.php">medical specialities</a>
                        <a href="patients/pages/doctors.php">doctors</a>
                    </div>
                </header>
            <?php
        } else {
            ?>
                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <link rel="stylesheet" href="chat.css">
                    <script src="assets/jquery/code.jquery.com_jquery-3.7.0.min.js"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                </head>

                <body>
                <?php
            }
                ?>
                <div class="container">
                    <?php
                    if (isset($_GET['doctor_id']) || isset($_GET['patient_id'])) {
                        $id = $_SESSION['id'];

                        $sender_id = $recipient_id = $sender_id2 = $recipient_id2 = "";

                        if (isset($_GET['doctor_id'])) {
                            $doctor_id = $_GET['doctor_id'];

                            $sender_id = $id;
                            $recipient_id  = $doctor_id;
                        } else {
                            $patient_id = $_GET['patient_id'];

                            $sender_id2 = $id;
                            $recipient_id2 = $patient_id;
                        }
                        if (!empty($sender_id) && !empty($recipient_id)) {
                            ///patient section

                            require 'connect.php';

                            $sql_sender = "SELECT * FROM patients WHERE id = '$sender_id'";
                            $result_sender = $conn->query($sql_sender);
                            $row_sender = $result_sender->fetch_assoc();

                            $sql_recipient = "SELECT * FROM doctors WHERE id = '$recipient_id'";
                            $result_recipient = $conn->query($sql_recipient);
                            $row_recipient = $result_recipient->fetch_assoc();
                    ?>
                            <div class="chat-header">
                                <div class="chat-name">
                                    <span><?php echo $row_recipient['full_name'] ?></span>
                                    <span>
                                        <?php
                                        echo ($row_recipient['activity_status'] == 1) ? "<div class='online'></div>" : "<div class='offline'></div>";
                                        ?>
                                    </span>
                                </div>
                                <div>
                                    <a target="_top" href="patients/pages/complaints.php?box=add_complaint&accused_perso_id=<?php echo $row_recipient['id'] ?>" class="chat-report-btn">report</a>
                                </div>
                            </div>
                            <div class="chat-body">
                            </div>

                            <div class="chat-footer">
                                <form onsubmit="sendMessageHandler(event)">
                                    <input type="text" class="input-field" name="content" id="content" autocomplete="off" placeholder="enter your message">
                                    <input type="submit" value="send" class="submit-btn">
                                </form>
                            </div>

                            <script>
                                const sender_id = <?php echo $sender_id ?>;
                                const recipient_id = <?php echo $recipient_id ?>;

                                function fetchMessages() {
                                    $.ajax({
                                        url: `chat.php?box=get_messages_patient&sender_id=${sender_id}&recipient_id=${recipient_id}`,
                                        type: "GET",
                                        success: function(messages) {
                                            displayMessages(messages);
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Error fetching messages:", error);
                                        }
                                    });
                                }

                                function displayMessages(messages) {
                                    var chatMessagesDiv = $(".chat-body");
                                    const isScrolledToBottom = chatMessagesDiv[0].scrollHeight - chatMessagesDiv.scrollTop() === chatMessagesDiv.outerHeight();

                                    chatMessagesDiv.empty();
                                    messages.forEach((ele) => {
                                        if (ele.sender_id != null) {
                                            // console.log("patient message");
                                            chatMessagesDiv.append("<div class='message send-message'><span>" + ele?.content + "</div>");
                                        } else if (ele.sender_id2 != null) {
                                            // console.log("doctor message")
                                            chatMessagesDiv.append("<div class='message recieve-message'><span> " + ele?.content + "</div>");
                                        }
                                    })
                                    // Scroll to the bottom only if the user was already at the bottom before new messages were added
                                    if (isScrolledToBottom && !isUserScrolling) {
                                        chatMessagesDiv.scrollTop(chatMessagesDiv[0].scrollHeight);
                                    }
                                }
                                // Event listener to detect user scrolling
                                $(".chat-body").on("scroll", function() {
                                    isUserScrolling = true;
                                });

                                // Event listener to reset the scrolling status after a delay (100ms)
                                $(".chat-body").on("scroll", function() {
                                    clearTimeout($.data(this, "scrollCheck"));
                                    $.data(this, "scrollCheck", setTimeout(function() {
                                        isUserScrolling = false;
                                    }, 100));
                                });

                                // Fetch messages immediately and then every 1 second (1000 milliseconds)
                                fetchMessages();
                                setInterval(fetchMessages, 1000);


                                //send the message 
                                // Function to handle the form submission and call the sendMessage function
                                function sendMessageHandler(event) {
                                    event.preventDefault(); // Prevent the form from submitting normally
                                    const form = event.target;
                                    const content = form.content.value;

                                    // Call the sendMessage function with the form data
                                    sendMessage(content);
                                    // Clear the input field after sending the message
                                    form.content.value = "";
                                }

                                function sendMessage(content) {
                                    // Create an object with the message data to be sent in the POST request
                                    const sender_id = <?php echo $sender_id ?>;
                                    const recipient_id = <?php echo $recipient_id ?>;

                                    const messageData = {
                                        content: content
                                    };
                                    // Send the POST request to the server
                                    fetch(`?box=send_message_patient&&sender_id=${sender_id}&&recipient_id=${recipient_id}`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify(messageData)
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            fetchMessages();
                                            // Handle the response if needed
                                            // For example, you can check response status and display a success message
                                            console.log('Message sent successfully!');
                                        })
                                        .catch(error => {
                                            console.error('Error sending message:', error);
                                        });
                                }
                            </script>
                        <?php
                        } else {
                            ///doctor section
                            require 'connect.php';

                            $sql_sender2 = "SELECT * FROM doctors WHERE id = '$sender_id2'";
                            $result_sender2 = $conn->query($sql_sender2);
                            $row_sender2 = $result_sender2->fetch_assoc();

                            $sql_recipient2 = "SELECT * FROM patients WHERE id = '$recipient_id2'";
                            $result_recipient2 = $conn->query($sql_recipient2);
                            $row_recipient2 = $result_recipient2->fetch_assoc();
                        ?>
                            <div class="chat-header">
                                <div class="chat-name">
                                    <span><?php echo $row_recipient2['full_name'] ?></span>
                                    <span>
                                        <?php
                                        echo ($row_recipient2['activity_status'] == 1) ? "<div class='online'></div>" : "<div class='offline'></div>";
                                        ?>
                                    </span>
                                </div>
                                <div>
                                    <a target="_top" href="doctors/pages/complaints_management.php?box=add_complaint&accused_perso_id2=<?php echo $row_recipient2['id'] ?>" class="chat-report-btn">report</a>
                                </div>
                            </div>
                            <div class="chat-body">
                            </div>

                            <div class="chat-footer">
                                <form onsubmit="sendMessageHandler(event)">
                                    <input type="text" class="input-field" name="content" id="content" autocomplete="off" placeholder="enter your message">
                                    <input type="submit" value="send" class="submit-btn">
                                </form>
                            </div>

                            <script>
                                const sender_id2 = <?php echo $sender_id2 ?>;
                                const recipient_id2 = <?php echo $recipient_id2 ?>;

                                function fetchMessages() {
                                    $.ajax({
                                        url: `chat.php?box=get_messages_doctor&sender_id2=${sender_id2}&recipient_id2=${recipient_id2}`,
                                        type: "GET",
                                        success: function(messages) {
                                            displayMessages(messages);
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Error fetching messages:", error);
                                        }
                                    });
                                }

                                function displayMessages(messages) {
                                    var chatMessagesDiv = $(".chat-body");
                                    const isScrolledToBottom = chatMessagesDiv[0].scrollHeight - chatMessagesDiv.scrollTop() === chatMessagesDiv.outerHeight();

                                    chatMessagesDiv.empty();
                                    messages.forEach((ele) => {
                                        if (ele.sender_id != null) {
                                            // console.log("patient message");
                                            chatMessagesDiv.append("<div class='message recieve-message'><span>" + ele?.content + "</div>");
                                        } else if (ele.sender_id2 != null) {
                                            // console.log("doctor message")
                                            chatMessagesDiv.append("<div class='message send-message'><span> " + ele?.content + "</div>");
                                        }
                                    })
                                    // Scroll to the bottom only if the user was already at the bottom before new messages were added
                                    if (isScrolledToBottom && !isUserScrolling) {
                                        chatMessagesDiv.scrollTop(chatMessagesDiv[0].scrollHeight);
                                    }
                                }
                                // Event listener to detect user scrolling
                                $(".chat-body").on("scroll", function() {
                                    isUserScrolling = true;
                                });

                                // Event listener to reset the scrolling status after a delay (100ms)
                                $(".chat-body").on("scroll", function() {
                                    clearTimeout($.data(this, "scrollCheck"));
                                    $.data(this, "scrollCheck", setTimeout(function() {
                                        isUserScrolling = false;
                                    }, 100));
                                });

                                // Fetch messages immediately and then every 1 second (1000 milliseconds)
                                fetchMessages();
                                setInterval(fetchMessages, 1000);


                                //send the message 
                                // Function to handle the form submission and call the sendMessage function
                                function sendMessageHandler(event) {
                                    event.preventDefault(); // Prevent the form from submitting normally
                                    const form = event.target;
                                    const content = form.content.value;

                                    // Call the sendMessage function with the form data
                                    sendMessage(content);
                                    // Clear the input field after sending the message
                                    form.content.value = "";
                                }

                                function sendMessage(content) {
                                    // Create an object with the message data to be sent in the POST request
                                    const sender_id2 = <?php echo $sender_id2 ?>;
                                    const recipient_id2 = <?php echo $recipient_id2 ?>;

                                    const messageData = {
                                        content: content
                                    };
                                    // Send the POST request to the server
                                    fetch(`?box=send_message_doctor&&sender_id2=${sender_id2}&&recipient_id2=${recipient_id2}`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify(messageData)
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            fetchMessages();
                                            // Handle the response if needed
                                            // For example, you can check response status and display a success message
                                            console.log('Message sent successfully!');
                                        })
                                        .catch(error => {
                                            console.error('Error sending message:', error);
                                        });
                                }
                            </script>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    if (isset($_GET['fromDoctor']) and $_GET['fromDoctor'] == "yes") {
                        include "patients/includes/footer.php";
                    } else {
                    ?>
                </div>
                </body>

                </html>
        <?php
                    }
                } elseif ($box == "send_message_doctor") {

                    $sender_id2 = $_GET['sender_id2'];
                    $recipient_id2 = $_GET['recipient_id2'];

                    require 'static_functions.php';

                    $data = json_decode(file_get_contents('php://input'), true);

                    $content = examine_values($data['content']);

                    require 'connect.php';

                    $sql = "INSERT INTO messages(sender_id2, recipient_id2, content) VALUES('$sender_id2', '$recipient_id2', '$content')";

                    if ($conn->query($sql) === TRUE) {
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    $conn->close();
                } elseif ($box == "send_message_patient") {

                    $sender_id = $_GET['sender_id'];
                    $recipient_id = $_GET['recipient_id'];

                    require 'static_functions.php';

                    $data = json_decode(file_get_contents('php://input'), true);

                    $content = examine_values($data['content']);

                    require 'connect.php';

                    $sql = "INSERT INTO messages(sender_id, recipient_id, content) VALUES('$sender_id', '$recipient_id', '$content')";

                    if ($conn->query($sql) === TRUE) {
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    $conn->close();
                } elseif ($box == "get_messages_doctor") {

                    $sender_id2 = $_GET['sender_id2'];
                    $recipient_id2 = $_GET['recipient_id2'];

                    require "connect.php";

                    try {
                        $sql = "SELECT messages.id, messages.sender_id, messages.recipient_id, messages.sender_id2, messages.recipient_id2, messages.content, messages.time_stamp, patient.id AS 'patient_id', patient.user_name AS 'patient_username', doctor.id AS 'doctor_id', doctor.user_name AS 'doctor_username'
                                FROM messages
                                LEFT JOIN patients AS patient ON (messages.sender_id = patient.id OR messages.recipient_id2 = patient.id)
                                LEFT JOIN doctors AS doctor ON (messages.sender_id2 = doctor.id OR messages.recipient_id = doctor.id)
                                WHERE (messages.sender_id2 = $sender_id2 AND messages.recipient_id2 = '$recipient_id2')
                                OR (messages.recipient_id = '$sender_id2' AND messages.sender_id = '$recipient_id2')
                                ORDER BY messages.time_stamp ASC";

                        $result = $conn->query($sql);

                        if (!$result) {
                            throw new Exception("Query failed: " . $conn->error);
                        }

                        $data = array();
                        while ($row = $result->fetch_assoc()) {
                            $data[] = $row;
                        }

                        $conn->close();

                        header('Content-Type: application/json');

                        echo json_encode($data);
                    } catch (Exception $e) {
                        header('Content-Type: application/json');
                        echo json_encode(array('error' => $e->getMessage()));
                    }
                } elseif ($box == "get_messages_patient") {

                    $sender_id = $_GET['sender_id'];
                    $recipient_id = $_GET['recipient_id'];

                    require "connect.php";

                    try {
                        $sql = "SELECT messages.id, messages.sender_id, messages.recipient_id, messages.sender_id2, messages.recipient_id2, messages.content, messages.time_stamp, patient.id AS 'patient id', patient.user_name AS 'patient username', doctor.id AS 'doctor id', doctor.user_name AS 'doctor username' FROM messages LEFT JOIN patients AS patient ON (messages.sender_id = patient.id OR messages.recipient_id2 = patient.id) LEFT JOIN doctors AS doctor ON (messages.sender_id2 = doctor.id OR messages.recipient_id = doctor.id) WHERE (messages.sender_id = '$sender_id' AND messages.recipient_id = '$recipient_id') OR (messages.recipient_id2 = '$sender_id' AND messages.sender_id2 = '$recipient_id') ORDER BY messages.time_stamp ASC";

                        $result = $conn->query($sql);

                        if (!$result) {
                            throw new Exception("Query failed: " . $conn->error);
                        }

                        $data = array();
                        while ($row = $result->fetch_assoc()) {
                            $data[] = $row;
                        }

                        $conn->close();

                        header('Content-Type: application/json');

                        echo json_encode($data);
                    } catch (Exception $e) {
                        header('Content-Type: application/json');
                        echo json_encode(array('error' => $e->getMessage()));
                    }
                }
            } else {
                include "static_functions.php";
        ?>
        <script>
            alert("please sign in or sign up first");
        </script>
    <?php
                redirect("patients/pages/login.php", 0);
            }
