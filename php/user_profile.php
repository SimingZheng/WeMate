<?php
include('register.php');
$ID = $_COOKIE['user_profile_id'];
$sql_profile = "select * from profile where user_ID = '$ID'";
$result_profile = mysqli_query($con, $sql_profile);
$row_profile = $result_profile->fetch_assoc();
$sql_users = "select * from users where user_ID = '$ID'";
$result_users = mysqli_query($con, $sql_users);
$row_user = $result_users->fetch_assoc();

$user_ID = $row_user['user_ID'];
$sql_interest = "select * from interests where user_ID = '$user_ID'";
$result_interest = mysqli_query($con, $sql_interest);
$row_interest = $result_interest->fetch_assoc();
$sql_num = "select * from interests where user_ID = '$user_ID'";
$result_num = mysqli_query($con, $sql_num);
$row_num = $result_num->fetch_assoc();
$num = 0;
while ($row_num = $result_num->fetch_assoc()) {
    $num++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/user_profile.css">
    <link rel="stylesheet" href="../css/nav_circle.css">
    <script type="text/javascript" src="../js/js_slider/jquery-1.7.2.min.js"></script>
</head>
<body>
<div class="top">
    <div class="middle">
        <?php
//        if (!empty($row_user['firstname'])) {
        echo '<a href="profile.php" >
            <img class="portrait" src="data:image/jpeg;base64,' . base64_encode($row_profile['photo']) . '"  alt=""/></a>';
        ?>
        <p class="name"><?php echo $row_user['firstname'] ?></p>
    </div>
    <div class="right">
        <nav class="top-right">
            <a href="homepage.php" class="disc l3">
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
        <!--        <a href="#" class="notification">-->
        <!--            <span class="glyphicon glyphicon-envelope notification_icon"></span>-->
        <!--        </a>-->
        <!--            <a class="sign_out" onclick="Delete()" href="../html/signin.html">Sign out</a>-->
    </div>
</div>
<div style="width: 100%" class="container">
    <div class="body">
        <p class="basic">Basic information</p>
        <ul class="basic_info">
            <li class="li_basic"><?php echo "First name: &nbsp; {$row_user['firstname']}" ?> </li>
            <li class="li_basic"><?php echo "Last name:  &nbsp;&nbsp; {$row_user['lastname']}" ?> </li>
            <li class="li_basic"><?php echo "E-mail:    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {$row_user['email']}" ?> </li>
            <li class="li_basic"><?php echo "Nickname:   &nbsp; {$row_user['handle']}" ?> </li>
        </ul>
        <p class="profile">Detail information</p>
        <ul class="profile_info">
            <li class="li_profile"><?php echo "Gender: &nbsp; {$row_profile['gender']}" ?> </li>
            <li class="li_profile"><?php echo "Age:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {$row_profile['age']}" ?> </li>
            <li class="li_profile">Smoker:&nbsp;&nbsp;&nbsp;<?php  if(!empty($row_profile['smoker'])) echo "Yes"; else echo "No"?> </li>
            <li class="li_profile">Drinker:&nbsp;&nbsp;&nbsp;<?php  if(!empty($row_profile['drinker'])) echo "Yes"; else echo "No"?> </li>
            <li class="li_profile"><?php echo "Seeking: &nbsp; {$row_profile['seeking']}" ?> </li>
            <li class="li_profile"><?php echo "Description:  </br></br> {$row_profile['description']}" ?> </li>
        </ul>
        <p class="profile">User Interests</p>
        <ul class="profile_info">
            <?php
            for ($i = 0; $i < $num; $i++) {
                $id = $row_interest['interest_ID'];
                $sql_type = "select * from interest_type where interest_ID = '$id'";
                $result_type = mysqli_query($con, $sql_type);
                $row_type = $result_type->fetch_assoc();
                if ($row_type['interest']) {
                    ?>
                    <li class="li_profile"><?php echo "&nbsp; {$row_type['interest']}" ?> </li>
                    <?php
                }
                $row_interest = $result_interest->fetch_assoc();
            }
            ?>
        </ul>
    </div>
</div>
<?php
//} else {
//    ?>
<!--    <a class="sign_in" href="../html/index.html">Sign in</a>-->
<!--    --><?php
//}
?>
<div class="footer">
    <div class="brand">
        <p class="p1">WeMate |</p>
    </div>
</div>
</html>