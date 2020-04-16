<?php
include('register.php');
$ban = $_COOKIE['ban'];
$sql_user = "select * from profile where user_ID = '$ban'";
$result_user = mysqli_query($con, $sql_user);
$user = $result_user->fetch_assoc();
if ($user['banned']=='0') {
    $sql = "UPDATE profile SET banned = '1' WHERE user_ID = '$ban'";
    $result = mysqli_query($con, $sql);
}
else{
    $sql = "UPDATE profile SET banned = '0' WHERE user_ID = '$ban'";
    $result = mysqli_query($con, $sql);
}
if(!$result)
    echo "error";
else
    echo "good";
Header("Location: admin_user.php");