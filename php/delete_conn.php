<?php
include('register.php');
$receiver_id = $_COOKIE['delete_receiver_id'];
$sender_id = $_COOKIE['delete_sender_id'];
$sql_delete = "DELETE FROM connections WHERE (user_ID1 = '$sender_id' AND user_ID2 = '$receiver_id') or (user_ID1 = '$receiver_id' AND user_ID2 = '$sender_id')";
$result_delete = mysqli_query($con, $sql_delete);
Header("Location: connect_list.php");