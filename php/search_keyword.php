<!DOCTYPE html>
<?php
include('register.php');
$ID = $_COOKIE['id'];
$sql_portrait = "select * from profile where user_ID = '$ID'";
$result_portrait = mysqli_query($con, $sql_portrait);
$portrait = $result_portrait->fetch_assoc();
$seeking = $portrait['seeking'];

$value = trim($_COOKIE['value']);
//if(isset($_POST['value']))
//{
//    setcookie('value',null);
//    $keyword = $_POST['value'];
//    setcookie("keyword",$keyword);
//}
//similar_text($value,"Low Cost, Custom Web Design",$percent);
//echo "Percent: $percent%"; ;

$start1 = 0;
define("PAGE_SIZE", 1);
$start = 0;
if (isset($_GET["start"]) and $_GET["start"] >= 0 and $_GET["start"] <= 1000) {
    $start = $_GET["start"];
}
//else if(isset($_COOKIE['start'])) {
//    $start =$_COOKIE['start'];
//}
$end = $start + PAGE_SIZE - 1;
if (!isset($_POST['submit'])&&$_COOKIE['gender']=="E") {
    $sql_interest = "SELECT DISTINCT user_ID FROM interests JOIN interest_type ON interests.interest_ID = interest_type.interest_ID
                    WHERE instr(interest,'$value') >0";
}
else if(isset($_POST['submit'])){
    $leftNum = $_COOKIE['leftNum'];
    $rightNum = $_COOKIE['rightNum'];
    $gender = $_POST['gender'];
    setcookie('gender',$gender);
    $sql_interest = "SELECT DISTINCT user_ID FROM profile WHERE gender='$gender' AND age between '$leftNum' and '$rightNum' AND user_ID IN 
                    (SELECT DISTINCT user_ID FROM interests JOIN interest_type ON interests.interest_ID = interest_type.interest_ID
                    WHERE instr(interest,'$value') >0)";
}
else{
    $leftNum = $_COOKIE['leftNum'];
    $rightNum = $_COOKIE['rightNum'];
    $gender = $_COOKIE['gender'];
    $sql_interest = "SELECT DISTINCT user_ID FROM profile WHERE gender='$gender' AND age between '$leftNum' and '$rightNum' AND user_ID IN 
                    (SELECT DISTINCT user_ID FROM interests JOIN interest_type ON interests.interest_ID = interest_type.interest_ID
                    WHERE instr(interest,'$value') >0)";
}

$result_interest = mysqli_query($con, $sql_interest);
$res_interest = $result_interest->fetch_assoc();
$result = mysqli_query($con, $sql_interest);
$result1 = mysqli_query($con, $sql_interest);

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
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/button_style.css">
    <link rel="stylesheet" type="text/css" href="../css/search_keyword.css">
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="../css/nav_circle.css">
    <link rel="stylesheet" href="../css/css_slider/public.css">
    <link rel="stylesheet" href="../css/css_slider/ion.rangeSlider.css">
    <link rel="stylesheet" href="../css/css_slider/index.css">
    <link rel="stylesheet" type="text/css" href="../css/css_search/search-form.css"/>
    <script type="text/javascript" src="../js/js_slider/jquery-1.7.2.min.js"></script>
    <meta charset="UTF-8">
    <title>Searching</title>
    <style>
    </style>
</head>
<body>
<div class="top">
    <div class="middle">
        <!--        <div class="magnifier"><i></i></div>-->
        <form onSubmit="submitFn(this, event);">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="input keyword"/>
                    <button class="search-icon" onClick="searchToggle(this, event);"><span></span></button>
                </div>
                <span class="close" onClick="searchToggle(this, event);"></span>
                <div class="result-container">

                </div>
            </div>
        </form>
        <script src="../js/js_search/jquery-1.11.0.min.js" type="text/javascript"></script>
        <script>
            function searchToggle(obj, evt) {
                var container = $(obj).closest('.search-wrapper');

                if (!container.hasClass('active')) {
                    container.addClass('active');
                    evt.preventDefault();
                } else if (container.hasClass('active') && $(obj).closest('.input-holder').length == 0) {
                    container.removeClass('active');
                    // clear input
                    container.find('.search-input').val('');
                    // clear and hide result container when we press close
                    container.find('.result-container').fadeOut(100, function () {
                        $(this).empty();
                    });
                }
            }

            function submitFn(obj, evt) {
                value = $(obj).find('.search-input').val().trim();

                _html = "keyword: ";
                if (!value.length) {
                    _html = "keyword can't empty";
                } else {
                    _html += "<b>" + value + "</b>";
                }

                $(obj).find('.result-container').html('<span>' + _html + '</span>');
                $(obj).find('.result-container').fadeIn(100);

                document.cookie = "value =" + value;
                document.cookie = "gender ="+ "E";

                window.location.href = "search_keyword.php";

                evt.preventDefault();
            }
        </script>
        <!--        <div class="form">-->
        <!--            <form action="admin_search_user.php" method="post">-->
        <!--                <input class="search" results="s" type="search" name="keywords">-->
        <!--                <input class="btn btn-small btn-blue btn-radius" type="submit" value="Search information">-->
        <!--            </form>-->
        <!--        </div>-->
    </div>
    <div class="right">
        <nav class="top-right">
            <a onclick="clearAllCookie()" class="disc l1">
                <div>Sign out</div>
                <script>
                    function clearAllCookie() {
                        var keys = document.cookie.match(/[^ =;]+(?=\=)/g);
                        if(keys) {
                            for(var i = keys.length; i--;)
                                document.cookie = keys[i] + '=0;expires=' + new Date(0).toUTCString()
                        }
                        window.location.href= "../html/index.html";
                    }
                </script>
            </a>
            <a href="connect_list.php" class="disc l2">
                <div>Mate</div>
            </a>
            <a href="homepage.php" class="disc l3">
                <div>Homepage</div>
            </a>
            <a href="user_like_noti.php" class="disc l4">
                <div>Wooer</div>
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
        <!--        <a href="#" class="notification">-->
        <!--            <span class="glyphicon glyphicon-envelope notification_icon"></span>-->
        <!--        </a>-->
        <!--            <a class="sign_out" onclick="Delete()" href="../html/signin.html">Sign out</a>-->
    </div>
</div>
<form class="nav" action="../php/search_keyword.php" method="post">
    <div class="nav_selector">
        <div class="age">
            <div class="moveBox">
                <div class="moveTitle clearfix"><p class="fl">Age Range<span class="wangCss">&nbsp;(Y)</span></p>
                    <p data-leftNum="" data-rightNum="" class="changeNum bxsh fr">No Demand</p></div>
                <div class="moveContent">
                    <input type="text" value="1111" class="range_1"/>
                    <div class="moveScale">
                        <p>19</p>
                        <p class="ndownPayment_p_1">25</p>
                        <p class="ndownPayment_p_2">30</p>
                        <p class="ndownPayment_p_3">40</p>
                        <p class="ndownPayment_p_4">50</p>
                        <p class="ndownPayment_p_5">60</p>
                        <p>No Limit</p>
                        <script src="../js/js_slider/jquery-1.7.2.min.js"></script>
                        <script src="../js/js_slider/ion.rangeSlider.js"></script>
                        <script src="../js/js_slider/index.js"></script>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(".range_1").ionRangeSlider({
                min: 19, //min
                max: 70, //max
                from: 19, //default start
                to: 70, //default max
                type: 'double', //data type
                step: 1,
                prefix: "", //prefix
                postfix: "", //postfix
                prettify: true,
                hasGrid: true,
                onChange: function (data) {//数据变化时触发
                    console.log(data)
                    moveSliderRange1(data.from, data.to);

                },
            });
            var sliderRange1 = $(".range_1").data("ionRangeSlider");

            function moveSliderRange1(leftNum, rightNum) {
                if (leftNum >= 19 && rightNum <= 60) {
                    $('.bxsh').text(leftNum + '-' + rightNum + '');
                    $('.bxsh').attr("data-leftNum", leftNum * 10000);
                    $('.bxsh').attr("data-rightNum", rightNum * 10000);
                    document.cookie = "leftNum ="+leftNum;
                    document.cookie = "rightNum ="+rightNum;
                } else if (leftNum == 70 && rightNum == 70) {
                    $('.bxsh').text('Above 60');
                    $('.bxsh').attr("data-leftNum", 50000);
                    $('.bxsh').attr("data-rightNum", "");
                    document.cookie = "leftNum ="+leftNum;
                    document.cookie = "rightNum ="+rightNum;
                } else if (leftNum > 19 && leftNum < 60 && rightNum > 60) {
                    $('.bxsh').text('Above '+leftNum );
                    $('.bxsh').attr("data-leftNum", leftNum*10000);
                    $('.bxsh').attr("data-rightNum", "");
                    document.cookie = "leftNum ="+leftNum;
                    document.cookie = "rightNum ="+rightNum;
                } else if (leftNum >= 50 && rightNum > 60) {
                    $('.bxsh').text('Above 60');
                    $('.bxsh').attr("data-leftNum", "50000");
                    $('.bxsh').attr("data-rightNum", "");
                    document.cookie = "leftNum ="+leftNum;
                    document.cookie = "rightNum ="+rightNum;
                } else if (leftNum == 19 && rightNum > 60) {
                    $('.bxsh').text("No Limit");
                    $('.bxsh').attr("data-leftNum", "0");
                    $('.bxsh').attr("data-rightNum", "");
                    document.cookie = "leftNum ="+leftNum;
                    document.cookie = "rightNum ="+rightNum;
                }
            }
        </script>
        <div class="gender">
            <select class="selector_gender" name="gender" id="gender" onchange="">
                <option id="1" value="Male">Male</option>
                <option id="2" value="FeMale">FeMale</option>
                <option id="3" value="MtF">Male to Female (MtF)</option>
                <option id="4" value="FtM">Female to Male (FtM)</option>
                <option id="5" value="Binary">Binary</option>
                <option id="6" value="Non-Binary">Non-Binary</option>
                <option id="7" value="Trans Woman">Trans Woman</option>
                <option id="8" value="Trans Man">Trans Man</option>
            </select>
        </div>
    </div>
        <div class="submit">
            <input class="input_search" type="submit" name="submit" value="search">
            <p class="show_result">
                <?php echo " age: ".$_COOKIE['leftNum']." - ".$_COOKIE['rightNum']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; gender: ";
                    if(strcmp($_COOKIE['gender'],"E")==0){
                        echo " All";
                    }
                    else if (isset($_POST['gender'])){
                        echo $_POST['gender'];
                    }
                    else echo $_COOKIE['gender'];
                    echo "&nbsp;&nbsp;&nbsp;&nbsp; interest: ";
                    if (strcmp($_COOKIE['value'],"")==0)
                       echo " All";
                    else echo $_COOKIE['value'];
                    ?>
            </p>
        </div>
</form>

<div style="width: 100%" class="container">
    <div class="Note">
        <p class="Title">Results</p>
        <p style="font-family:Times New Roman ;text-align: center ;font-size: 20px ; color: grey ; margin-bottom: 10px" >
            <?php
            if ($num==1)
                echo "0 Result";
            else
                echo ($num)." Results";
            ?>
        </p>
    </div>
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
        <div class="previous">
            <?php
            if ($start > 0) {
                ?>
                <a href="search_keyword.php?start=<?php echo $start - PAGE_SIZE ?>" class="previous_circle">
                    <span class="glyphicon glyphicon-arrow-left previous_icon"></span>
                </a>
                <?php
            } ?>
        </div>
        <div class="result">
            <?php
            for ($i = 0; $i < $start; $i++) {
                $row = mysqli_fetch_assoc($result);
            }
            for (; $i <= $end; $i++) {
                $row = mysqli_fetch_assoc($result);
                if ($row != null) {
                    $str = $row['user_ID'];
                    $sql_photo = "select * from profile where user_ID = '$str'";
                    $result_photo = mysqli_query($con, $sql_photo);
                    $photo = $result_photo->fetch_assoc();
                    ?>
                    <?php echo '<img class="photo" src="data:image/jpeg;base64,' . base64_encode($photo['photo']) . '"  alt=""/></a>'; ?>
                    <a onclick="transfer()"  class="info">
                        <span class="glyphicon glyphicon-list info_icon"></span>
                    </a>
                    <a onclick="like()" class="like">
                        <span class="glyphicon glyphicon-heart like_icon"></span>
                    </a>
                    <script type="text/javascript">
                        function transfer() {
                            var user_profile_id = "<?php echo $str ?>";
                            document.cookie = "user_profile_id ="+user_profile_id;
                            // localStorage.setItem("user_profile_id",user_profile_id);
                            window.location.href="user_profile.php";
                        }

                        function like(){
                            var receiver_id = "<?php echo $str ?>";
                            var sender_id = "<?php echo $ID ?>";
                            var backpage = "search_keyword.php";
                            //if("<?php //echo $start?>//") {
                            //    var start = "<?php //echo $start ?>//";
                            //    document.cookie = "start ="+start;
                            //}
                            document.cookie = "backpage ="+ backpage;
                            document.cookie = "receiver_id ="+receiver_id;
                            document.cookie = "sender_id ="+sender_id;
                            window.location.href="like_saving.php";
                        }
                    </script>
                    <?php
                }
            }
            ?>
        </div>
        <div class="next">
            <?php
            if ($start + PAGE_SIZE < $num) {
                ?>
                <a href="search_keyword.php?start=<?php echo $start + PAGE_SIZE ?> " class="next_circle">
                    <span class="glyphicon glyphicon-arrow-right next_icon"></span>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="page">
        <br/><br/><br/>
        <div class="page_number">
            <?php
            $k = $num / 1;
            if ($num % 1 != 0)
                $k++;
            for ($l = 1; $l <= $k; $l++) { ?>
                <a href="search_keyword.php?start=<?php echo $start1 + ($l - 1) * PAGE_SIZE ?>"><?php echo $l ?>&nbsp;&nbsp;&nbsp;&nbsp;</a>
                <?php
            }
            if (!$con)
                echo "Could not connect:" . mysqli_connect_error();
            ?>
        </div>
    </div>
    <?php
    }
    ?>
</div>
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
<div class="footer">
    <div class="introduction"><p>Note: Search result - Show object results filtered by user's interest, age and gender<br/>
            Interests: Animal, Animation, Astronomy, Baking, Camping, Car, Church, Activities, Crafts, Dancing, Drawing, Exercise, Family, Time
            Food, Gaming, literature, Magic, Movie, Music, Photography, Puzzles, Shopping, Sleeping, Sports, Technology,
            Traveling, Volunteering, Writing</p></div>
    <div class="brand">
        <p class="p1">WeMate |</p>
    </div>
</div>
</body>
</html>