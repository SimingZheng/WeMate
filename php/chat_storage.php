<?php
include('register.php');
$ID = uniqid();
$receiver_ID = $_COOKIE['receiver_ID'];
$sender_ID = $_COOKIE['sender_ID'];
$text = $_COOKIE['text'];
$sql = "insert into messages(message_ID,sender_ID,receiver_ID,message) values ('$ID','$sender_ID','$receiver_ID','$text')";
$result = mysqli_query($con, $sql);
if(!$result)
    echo "error";
else
    echo "good";
Header("Location: chat.php");
?>
