<!DOCTYPE html>
<html lang="zh">
<head>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/button_style.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_message.css">
    <meta charset="UTF-8">
    <title>Admin connection management</title>
    <style>
    </style>
</head>
<script>
    function Delete() {
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval = getCookie('firstname');
        if (cval != null)
            document.cookie = 'firstname' + "=" + cval + ";expires=" + exp.toGMTString();
        var cval = getCookie('lastname');
        if (cval != null)
            document.cookie = 'lastname' + "=" + cval + ";expires=" + exp.toGMTString();
        <!--        --><?php
        //        setcookie('firstname', null, time()-3600);
        //        setcookie('lastname', null, time()-3600);
        //        setcookie('email', null, time()-3600);
        //        setcookie('password', null, time()-3600);
        //        header("Location:../html/signin.html");
        //        ?>
    }
</script>
<body>
<div class="top">
    <div class="left">
        <p class="p1">WeMate |</p>
        <p class="p2">connection management</p>
    </div>
    <div class="right">
        <?php
        if (isset($_COOKIE['firstname'])) {
            ?>
            <p class="welcome">Welcome</p>
            <p class="name"><?php echo $_COOKIE['firstname'] ?></p>
            <a class="sign_out" onclick="Delete()" href="../html/index.html">Sign out</a>
            <?php
        } else {
            ?>
            <a class="sign_in" href="../html/index.html">Sign in</a>
            <?php
        }
        ?>
    </div>
</div>
<div class="nav">
    <a href="admin_user.php">User management</a>
    <a href="admin_message.php">User message management</a>
    <a href="admin_connection.php">User connection management</a>
</div>
<div class="container">
    <div class="body">
        <?php
        if (!isset($_COOKIE['firstname'])) {
            ?>
            <p style="text-align: center ; margin-top: 120px ; font-size: 40px ; color: #385f9e ; font-family: Times New Roman;
                line-height: 50px">
                Please Sign in <br/></p>
            <p style=" text-align: center;margin-top: 120px"><input class="btn btn-large btn-blue btn-radius"
                                                                    type="button"
                                                                    onclick=" window.location.href='../html/index.html' "
                                                                    value="Sign in"/></p>
            <?php
        } else {
            ?>
            <div class="Top">
                <?php
                include('register.php');
                $start1 = 0;
                define("PAGE_SIZE", 8);
                $start = 0;
                if (isset($_GET["start"]) and $_GET["start"] >= 0 and $_GET["start"] <= 1000) {
                    $start = $_GET["start"];
                }
                $end = $start + PAGE_SIZE - 1;
                $sql = "select * from connections";
                $result = mysqli_query($con, $sql);
                $result1 = mysqli_query($con, $sql);
                if (!$result)
                    echo "Not data :" . mysqli_connect_error();
                if ($start == 0) {
                    $res = mysqli_fetch_assoc($result1);
                    for ($j = 0; $row = mysqli_fetch_assoc($result1); $j++) ;
                    $num = $j + 1;
                    setcookie("num", $num);
                } else
                    $num = $_COOKIE['num'];
                ?>
                <div class="Top2">
                    <p class="Top3">Users Connections Management</p>
                    <p style="font-family:Times New Roman ;text-align: center ;font-size: 20px ; color: grey ; margin-top: 30px;margin-bottom: 30px">
                        <?php
                        if ($num==1)
                            echo "connection";
                        else
                            echo ($num - 1) . " connections";
                        ?>
                    </p>
                </div>
            </div>
            <div class="result">
                <div class="result2">
                    <?php
                    for ($i = 0; $i < $start; $i++) {
                        $row = mysqli_fetch_assoc($result);
                    }
                    for (; $i <= $end; $i++) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['user_ID1'] != null) {
                            $user_ID1 = $row['user_ID1'];
                            $user_ID2 = $row['user_ID2'];
                            $sql_user1 = "select * from users where user_ID = '$user_ID1'";
                            $result_user_ID1 = mysqli_query($con, $sql_user1);
                            $user1 = $result_user_ID1->fetch_assoc();
                            $sql_user2 = "select * from users where user_ID = '$user_ID2'";
                            $result_user_ID2 = mysqli_query($con, $sql_user2);
                            $user2 = $result_user_ID2->fetch_assoc();
                            ?>
                            <div class="results">
                                <div class="div">
                                    <font size="5px" color="blue" style=" font-style: italic">
                                         Name: <p
                                            style="color: #0c5460"> <?= $user1['firstname']; ?> <?= $user1['lastname']; ?> </p>
                                    </font>
                                    <font size="5px" color="blue" style=" font-style: italic">
                                         Name: <p
                                            style="color: #0c5460"> <?= $user2['firstname']; ?> <?= $user2['lastname']; ?> </p>
                                    </font>
                                    <font size="5px" color="blue" style=" font-style: italic">
                                        connection time: <p style="color: #0c5460"><?= $row['connect_date']; ?><br/></p></font>
                                    <button onclick="delete_conn()" class="info" value="">
                                        <span class="glyphicon glyphicon-trash info_icon"></span>
                                    </button>
                                    <script>
                                        function delete_conn(){
                                            var receiver_id = "<?php echo $user_ID1 ?>";
                                            var sender_id = "<?php echo $user_ID2 ?>";
                                            var backpage = "homepage.php";
                                            //if("<?php //echo $start?>//") {
                                            //    var start = "<?php //echo $start ?>//";
                                            //    document.cookie = "start ="+start;
                                            //}
                                            document.cookie = "backpage ="+ backpage;
                                            document.cookie = "delete_receiver_id ="+receiver_id;
                                            document.cookie = "delete_sender_id ="+sender_id;
                                            window.location.href="delete_conn_admin.php";
                                        }
                                    </script>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="page">
                    <?php
                    if ($start > 0) {
                        ?>
                        <a style="text-decoration: none ; font-size: 50px ; font-weight: bolder"
                           href="admin_message.php?start=<?php echo $start - PAGE_SIZE ?>"><<</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                    }
                    if ($start + PAGE_SIZE < $num) {
                        ?>
                        <a style="text-decoration: none ; font-size: 50px ;font-weight: bold ;float: right"
                           href="admin_message.php?start=<?php echo $start + PAGE_SIZE ?>">>></a>
                        <?php
                    }
                    ?>
                    <br/><br/><br/>
                    <div style="margin: auto;width: 30%">
                        <?php
                        $k = $num / 8;
                        if ($num % 8 != 0)
                            $k++;
                        for ($l = 1; $l <= $k; $l++) { ?>
                            <a style="text-decoration: none ; font-size: 20px;
            " href="admin_message.php?start=<?php echo $start1 + ($l - 1) * PAGE_SIZE ?>"><?php echo $l ?>&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <?php
                        }
                        if (!$con)
                            echo "Could not connect:" . mysqli_connect_error();
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="footer">
    <div class="brand">
        <p class="p1">WeMate |</p>
    </div>
</div>
</body>
</html>