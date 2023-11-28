<?php
function examine_values($value)
{
    $value = trim($value);
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

    return $value;
}

function redirect($page, $delay)
{
    header("refresh:{$delay};url={$page}");
}

function check_type_account($session)
{
    if ($session['account_type'] == 1) {
        redirect("manager/pages/doctors_management.php", 0);
    } elseif ($session['account_type'] == 2) {
        if ($session['account_status'] == 1) {
            redirect("doctors/pages/profile.php", 0);
        } else {
            redirect("doctors/pages/profile.php", 0);
        }
    } elseif ($session['account_type'] == 3) {
        redirect("home-page.php", 0);
    }
}
function edit_account_activity_status_1($activity_status, $id)
{
    require 'connect.php';

    $sql = "UPDATE doctors SET activity_status='$activity_status' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

function edit_account_activity_status_2($activity_status, $id)
{
    require 'connect.php';

    $sql = "UPDATE patients SET activity_status='$activity_status' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

function check_phone_number($value)
{
    // Remove leading and trailing whitespace
    $value = trim($value);
    // Remove any dashes or spaces from the number
    $value = str_replace(['-', ' '], '', $value);
    return $value;
}
