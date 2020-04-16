<?php
include('register.php');
$delete_ID = $_COOKIE['delete'];
$sql_message = "DELETE from messages where message_ID = '$delete_ID'";
$result_message = mysqli_query($con, $sql_message);
Header("Location: admin_message.php");
