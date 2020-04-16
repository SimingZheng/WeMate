<?php
$back = "homepage.php";
include('register.php');
$receiver_id = $_COOKIE['receiver_id'];
$sender_id = $_COOKIE['sender_id'];
$sql_liked = "SELECT * FROM notifications WHERE sender_ID = '$sender_id' AND receiver_ID = '$receiver_id'";
$result_liked = mysqli_query($con, $sql_liked);
$liked = $result_liked->fetch_assoc();
if (empty($liked['sender_ID'])) {
    $sql_like = "INSERT INTO notifications (sender_ID, receiver_ID) VALUES ('$sender_id','$receiver_id')";
    $result_like = mysqli_query($con, $sql_like);
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                background-color: darkkhaki;
            }

            .p {
                color: darkgoldenrod;
                font-size: 100px;
                font-weight: bolder;
                margin-top: 200px;
                text-align: center;
                margin-bottom: 40px;
            }

            div {
                position: fixed;
                right: 0;
                left: 0;
                margin: auto;
            }

            .p1 {
                text-align: center;
            }

            input {
                margin-top: 10px;
                width: 400px;
                height: 80px;
                border-width: 0px;
                border-radius: 15px;
                background-color: #FF8C00;
                cursor: pointer;
                outline: none;
                font-family: Microsoft YaHei;
                color: white;
                font-size: 30px;
            }

            input:hover {
                background-color: darkred;
            }
        </style>
    </head>
<body>
    <?php
    {
        ?>
        <p class="p">User like be sent</p>
        <div>
            <p class="p1"><input type="button"
                                 onclick="back()"
                                 value="Back"/></p>
        </div>
        <script>
            function  back() {
                //document.cookie = "start ="+"<?php //echo $_COOKIE['start'];?>//";
                window.location.href= "<?php echo $_COOKIE['backpage'];?>";
            }
        </script>
        </body>
<?php
    }
} else {
    $sql_dislike = "DELETE FROM notifications WHERE sender_ID = '$sender_id' AND receiver_ID = '$receiver_id'";
    $result_dislike = mysqli_query($con, $sql_dislike);
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                background-color: darkkhaki;
            }

            .p {
                color: darkgoldenrod;
                font-size: 100px;
                font-weight: bolder;
                margin-top: 200px;
                text-align: center;
                margin-bottom: 40px;
            }

            div {
                position: fixed;
                right: 0;
                left: 0;
                margin: auto;
            }

            .p1 {
                text-align: center;
            }

            input {
                margin-top: 10px;
                width: 400px;
                height: 80px;
                border-width: 0px;
                border-radius: 15px;
                background-color: #FF8C00;
                cursor: pointer;
                outline: none;
                font-family: Microsoft YaHei;
                color: white;
                font-size: 30px;
            }

            input:hover {
                background-color: darkred;
            }
        </style>
    </head>
<body>
    <?php
    {
        ?>
        <p class="p">User like be canceled</p>
        <div>
            <p class="p1"><input type="button"
                                 onclick="back()"
                                 value="Back"/></p>
        </div>
        <script>
            function  back() {
                //document.cookie = "start ="+"<?php //echo $_COOKIE['start'];?>//";
                window.location.href= "<?php echo $_COOKIE['backpage'];?>";
            }
        </script>
        </body>
    <?php
}
}
?>