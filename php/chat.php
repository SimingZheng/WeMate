<html>

<head><title>chat UI</title>
    <link rel="stylesheet" type="text/css" href="../css/button_style.css">
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="../css/nav_circle.css">
    <script type="text/javascript" src="../js/js_slider/jquery-1.7.2.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="../css/chat.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<script>    document.getElementsByTagName('body').height = window.innerHeight;</script>
<body class="box">
<?php
include('register.php');
$ID = $_COOKIE['id'];
$sql_portrait = "select * from profile where user_ID = '$ID'";
$result_portrait = mysqli_query($con, $sql_portrait);
$portrait = $result_portrait->fetch_assoc();
$seeking = $portrait['seeking'];

$sql = "SELECT DISTINCT user_ID2 AS user_ID FROM connections WHERE user_ID1 = '$ID' 
                   UNION 
                 SELECT DISTINCT user_ID1  FROM connections WHERE user_ID2 = '$ID'";
$result = mysqli_query($con, $sql);
$res = $result->fetch_assoc();

$user = $_COOKIE['receiver_id'];
$sql_chat = "SELECT message_ID FROM messages WHERE sender_ID = '$ID' AND receiver_ID = '$user'
                UNION 
                SELECT message_ID FROM messages WHERE sender_ID = '$user' AND receiver_ID = '$ID'";
$result_chat_1 = mysqli_query($con, $sql_chat);
$result_chat_2 = mysqli_query($con, $sql_chat);
$result_chat_3 = mysqli_query($con, $sql_chat);
$result_chat_4 = mysqli_query($con, $sql_chat);
?>
<div class="top">
    <div class="left">
        <?php
        if (isset($_COOKIE['firstname'])) {
            echo '<a href="profile.php">
            <img class="portrait" src="data:image/jpeg;base64,' . base64_encode($portrait['photo']) . '"  alt=""/></a>';
            ?>
            <?php
        } else {
            ?>
            <a class="sign_in" href="../html/login.html">Sign in</a>
            <?php
        }
        ?>
        <a href="profile.php"><p class="name"><?php echo $_COOKIE['firstname'] ?></p></a>
    </div>

    <div class="middle">
        <!--        <div class="magnifier"><i></i></div>-->
        <form onSubmit="submitFn(this, event);">

        </form>

    </div>
    <div class="right">
        <nav class="top-right">
            <a onclick="clearAllCookie()" class="disc l1">
                <div>Sign out</div>
                <script>
                    function clearAllCookie() {
                        var keys = document.cookie.match(/[^ =;]+(?=\=)/g);
                        if (keys) {
                            for (var i = keys.length; i--;)
                                document.cookie = keys[i] + '=0;expires=' + new Date(0).toUTCString()
                        }
                        window.location.href = "../html/login.html";
                    }
                </script>
            </a>
            <a href="connect_list.php" class="disc l2">
                <div>Mate</div>
            </a>
            <a href="profile.php" class="disc l3">
                <div>Profile</div>
            </a>
            <a href="homepage.php" class="disc l4">
                <div>Homepage</div>
            </a>
            <a class="disc l5 toggle">
                Menu
            </a>
        </nav>
        <script>
            toggle = document.querySelectorAll(".toggle")[0];
            nav = document.querySelectorAll("nav")[0];
            toggle_open_text = 'Menu';
            toggle_close_text = 'Close';

            toggle.addEventListener('click', function () {
                nav.classList.toggle('open');

                if (nav.classList.contains('open')) {
                    toggle.innerHTML = toggle_close_text;
                } else {
                    toggle.innerHTML = toggle_open_text;
                }
            }, false);
        </script>
    </div>
</div>
<!--<div class="leftbar">-->
<!--    <ul>-->
<!--        <li><i class="fas fa-user"></i></li>-->
<!--        <li><i class="fas fa-users"></i></li>-->
<!--        <li><i class="fas fa-smile"></i></li>-->
<!--        <li><i class="fas fa-envelope"></i></li>-->
<!--        <li><i class="fas fa-bell"></i></li>-->
<!--        <li><i class="fas fa-calendar-alt"></i></li>-->
<!--        <li><i class="fas fa-power-off"></i></li>-->
<!--    </ul>-->
<!--</div>-->
<!--<div class="container">-->
<div class="chatbox">
    <div class="chatleft">
        <!--            <div class="top">-->
        <!--                <i class="fas fa-bars" style="font-size: 1.4em"></i>-->
        <!--                <label>-->
        <!--                    <input type="text" placeholder="search" style="width: 140px; height: 36px; margin-left: 25px;">-->
        <!--                </label>-->
        <!--                <button class="searchbtn"><i class="fas fa-search"></i></button>-->
        <!--            </div>-->
        <div class="center">
            <?php
            $sql_profile = "select * from profile where user_ID = '$user'";
            $result_profile = mysqli_query($con, $sql_profile);
            $photo = $result_profile->fetch_assoc();
            $sql_user = "select * from users where user_ID = '$user'";
            $result_user = mysqli_query($con, $sql_user);
            $name = $result_user->fetch_assoc();
            echo '<a><img class="portrait_user" src="data:image/jpeg;base64,' . base64_encode($photo['photo']) . '"  alt=""/></a>'
            ?>
            <p class="name_user"><?php echo $name['firstname'] ?></p>
            <!--                <ul>-->
            <!--                    <li><img style="border-radius: 20px; vertical-align: middle;" src="http://placehold.it/40x40"> <span-->
            <!--                                style="margin-left: 10px;">Barack Obama</span></li>-->
            <!--                </ul>-->
        </div>
    </div>
    <div class="chatright">
        <!--            <div class="top"><img style="border-radius: 20px; vertical-align: middle;" src="http://placehold.it/40x40">-->
        <!--                <span style="margin-left: 20px;">Barack Obama</span>-->
        <!--              <i class="fas fa-ellipsis-v"style="font-size: 1.4em; position: absolute; right: 20px; color: gray;"></i>-->
        <!--            </div>-->
        <div class="center">
            <div class="center-left">
                <ul>
                    <?php
                    for ($j = 0; $res_chat1 = $result_chat_1->fetch_assoc(); $j++) ;
                    $num = $j;
                    for ($i = 0; $i < $num; $i++) {
                        $res_chat = $result_chat_2->fetch_assoc();
                        $id = $res_chat['message_ID'];
                        $sql_check = "SELECT * FROM messages WHERE message_ID = '$id' order by time asc";
                        $result_check = mysqli_query($con, $sql_check);
                        $check = $result_check->fetch_assoc();?>
                    <?php
                        if (strcmp($check['sender_ID'], $user) == 0) {
                            ?>
                            <li class="msgleft">
                                <?php
                                echo '<p><img class="portrait_little" style="border-radius: 20px; vertical-align: top;"
                                             src="data:image/jpeg;base64,' . base64_encode($photo['photo']) . '"></p>' ?>
                                <p class="msgcard"> <?php echo $check['message'] ?> </p></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="center-right">
                <ul>
                    <?php
                    for ($j = 0; $res_chat1 = $result_chat_3->fetch_assoc(); $j++) ;
                    $num = $j;
                    for ($i = 0; $i < $num; $i++) {
                        $res_chat = $result_chat_4->fetch_assoc();
                        $id = $res_chat['message_ID'];
                        $sql_check = "SELECT * FROM messages WHERE message_ID = '$id' order by time asc";
                        $result_check = mysqli_query($con, $sql_check);
                        $check = $result_check->fetch_assoc();
                        if (strcmp($check['sender_ID'], $ID) == 0) {
                            ?>
                            <li class="msgleft">
                                <?php
                                echo '<p><img class="portrait_little" style="border-radius: 20px; vertical-align: top;"
                                             src="data:image/jpeg;base64,' . base64_encode($portrait['photo']) . '"></p>' ?>
                                <p class="msgcard"> <?php echo $check['message'] ?> </p></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="footer">
            <form name="message" action="../php/chat_storage.php" method="post" >
                <textarea id="text" name="message" maxlength="800" rows="5" cols="40"
                                      style="width: 100%; resize: none; border: none; "
                                      placeholder="input..."> </textarea>
            <button class="sendbtn" type="submit" name="submit">Send</button>
            </form>
            <script>
                // function submit() {
                //     var text = document.getElementById('text').value;
                //     document.cookie = "text =" + text;
                //     window.location.href = "chat_storage.php";
                // }
            </script>
        </div>
    </div>
</div>
<div class="footer_brand">
    <div class="brand">
        <p class="p1">WeMate |</p>
    </div>
</div>
<!--</div>-->
</body>
</html>

