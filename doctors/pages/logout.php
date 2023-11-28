<?php
session_start();
$id = $_SESSION['id'];

session_destroy();

require '../../static_functions.php';

edit_account_activity_status_1(2, $id);

header('Location: ../../login.php');
exit;
