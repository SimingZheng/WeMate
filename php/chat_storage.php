<?php
include('register.php');
if (!isset($_POST["submit"])) {
    exit("submit error");
}
$ID = uniqid();
$sender_ID = $_COOKIE['id'];
$receiver_ID = $_COOKIE['receiver_id'];
$text = $_POST['message'];
$sql = "insert into messages(message_ID,sender_ID,receiver_ID,message) values ('$ID','$sender_ID','$receiver_ID','$text')";
$result = mysqli_query($con, $sql);
if(!$result)
    echo "error";
else
    echo "good";
Header("Location: chat.php");
?>
