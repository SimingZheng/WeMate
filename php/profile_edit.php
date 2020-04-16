<?php
include('register.php');
$ID = $_COOKIE['id'];
$sql_profile = "select * from profile where user_ID = '$ID'";
$result_profile = mysqli_query($con, $sql_profile);
$row_profile = $result_profile->fetch_assoc();
$sql_users = "select * from users where user_ID = '$ID'";
$result_users = mysqli_query($con, $sql_users);
$row_user = $result_users->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/profile_edit.css">
    <link rel="stylesheet" href="../css/nav_circle.css">
    <script type="text/javascript" src="../js/js_slider/jquery-1.7.2.min.js"></script>
</head>
<body>
<div class="top">
    <div class="middle">
        <?php
        if (isset($_COOKIE['firstname'])) {
        echo '<a href="profile.php" >
            <img class="portrait" src="data:image/jpeg;base64,' . base64_encode($row_profile['photo']) . '"  alt=""/></a>';
        ?>
        <p class="name"><?php echo $_COOKIE['firstname'] ?></p>
    </div>
    <div class="right">
        <nav class="top-right">
            <a href="homepage.php" class="disc l3">
                <div>Homepage</div>
            </a>
            <a href="profile.php" class="disc l4">
                <div>Profile</div>
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
        <form action="../php/edit_saving.php" method="post" enctype="multipart/form-data">
            <div class="photo_edit">
                <!-- only jpg，gif,png -->
                    <?php
                    echo '<p></p><img class="portrait_edit" id="upload" src="data:image/jpeg;base64,' . base64_encode($row_profile['photo']) . '"  alt=""/>';
                    ?>
                <p class="p_click">Click below to choose photo </br> (jpg, gif ,png &nbsp;&nbsp; 400px * 300px  size<400KB)</br></br>
                <span style="font-size: 20px ; color: #F0610E">You must have to choose a image !</span></p>
                    <div class="choose_photo_p"><input style="opacity: 0;" class="choose_photo" name="image" id="upload-input" onchange="showImg(this)"
                                                       type="file"  value="Click"/></div>
                <script type="text/javascript">

                    $('input[type=file]').each(function()
                    {
                        var max_size=409600;
                        $(this).change(function(evt)
                        {
                            var finput = $(this);
                            var files = evt.target.files;
                            var output = [];
                            for (var i = 0, f; f = files[i]; i++)
                            {
                                if(f.size > max_size)
                                {
                                    alert("image cannot bigger than 400KB!");
                                    $(this).val('');
                                }
                            }
                        });
                    });

                    function showImg(input) {
                        var file = input.files[0];
                        var reader = new FileReader()
                        reader.onload = function(e) {
                            document.getElementById('upload').src=e.target.result
                        }
                        reader.readAsDataURL(file)
                    }
                </script>
            </div>
            <p class="basic">Basic information</p>
            <ul class="basic_info">
                <li class="li_basic">First name:&nbsp;&nbsp;&nbsp;<input maxlength="30" class="input" type="text" name="firstname" onchange="firstname(this)"
                    placeholder="<?php echo "  {$row_user['firstname']}" ?> " value="<?php echo "{$row_user['firstname']}" ?>"></li>
                <script type="text/javascript">
                    function firstname(obj){
                        $(obj).attr("value",$(obj).val());
                    })
                </script>
                <li class="li_basic">Last name:  &nbsp;&nbsp;<input maxlength="30"  class="input" type="text" name="lastname"
                    placeholder="<?php echo " {$row_user['lastname']}" ?>" value="<?php echo "{$row_user['lastname']}" ?>"> </li>
                <li class="li_basic">E-mail: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input maxlength="50"  type="email" required class="input" type="text" name="email"
                    placeholder=" <?php echo " {$row_user['email']}" ?>" value="<?php echo "{$row_user['email']}" ?>"> </li>
                <li class="li_basic">Nickname: &nbsp; <input maxlength="30"  class="input" type="text" name="handle"
                    placeholder="<?php echo "{$row_user['handle']}" ?>" value="<?php echo "{$row_user['handle']}" ?>"> </li>
                <li class="li_basic">Password: &nbsp; &nbsp;&nbsp;<input maxlength="30"  class="input" type="text" name="password"
                    placeholder="new password"  value="<?php echo "{$row_user['password']}" ?>"> </li>
            </ul>
            <p class="profile">Detail Information</p>
            <ul class="profile_info">
                <li class="li_profile">Gender &nbsp; &nbsp; &nbsp; &nbsp; <select class="gender" name="gender" id="gender">
                            <option id="1" value ="Male">Male</option><option id="2" value ="FeMale">FeMale</option><option id="3" value="MtF">Male to Female (MtF)</option>
                            <option id="4" value="FtM">Female to Male (FtM)</option><option id="5" value="Binary">Binary</option><option id="6" value="Non-Binary">Non-Binary</option>
                            <option id="7" value="Trans Woman">Trans Woman</option><option id="8" value="Trans Man">Trans Man</option></select>
                    <script>
                            var gender = "<?php echo $row_profile['gender'] ?>";
                            var option = document.getElementById('gender');
                            for (var i = 0, j = 0; i = option.options[j]; j++) {
                                if (i.value == gender) {
                                    option.selectedIndex = j;
                                    break;
                                }
                            }
                    </script>
                    </li>
                <li class="li_profile">Seeking: &nbsp;&nbsp; &nbsp; &nbsp;  <select class="seeking" name="seeking" id="seeking">
                        <option id="1" value ="Male">Male</option><option id="2" value ="FeMale">FeMale</option><option id="3" value="MtF">Male to Female (MtF)</option>
                        <option id="4" value="FtM">Female to Male (FtM)</option><option id="5" value="Binary">Binary</option><option id="6" value="Non-Binary">Non-Binary</option>
                        <option id="7" value="Trans Woman">Trans Woman</option><option id="8" value="Trans Man">Trans Man</option></select>
                    <script>
                        var seeking = "<?php echo $row_profile['seeking'] ?>";
                        var option = document.getElementById('seeking');
                        for (var i = 0, j = 0; i = option.options[j]; j++) {
                            if (i.value == seeking) {
                                option.selectedIndex = j;
                                break;
                            }
                        }
                    </script></li>
                <li class="li_profile" >Age: &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input pattern="/1[89]|[2-9][0-9]|100/" required maxlength="3" class="input" type="text" name="age" value="<?php echo "{$row_profile['age']}" ?>"
                                                            placeholder="<?php echo "{$row_profile['age']}" ?>"> </li>
                <li class="li_profile">
                    Smoker:&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <input class="smoker" type="checkbox" name="smoker" value="smoker" />
                    <script>
                        var check1 = "<?php $row_profile['smoker']?>";
                        if(check1) {
                            document.getElementsByName("smoker")[0].checked = true;
                        }
                    </script></li>
                <li class="li_profile">
                    Drinker:&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <input class="drinker" type="checkbox" name="drinker" value="drinker"/>
                    <script>
                        var check2 = "<?php $row_profile['drinker']?>";
                        if(check2) {
                            document.getElementsByName("drinker")[0].checked = true;
                        }
                    </script></li>
                <li class="li_profile">Description:  </br></br> <textarea class="description" type="text" name="description"
                                                                placeholder="<?php echo $row_profile['description'] ?>"
                                                            ><?php echo $row_profile['description'] ?></textarea> </li>
            </ul>
            <p class="p_click"><input class="input_store" type="submit" name="submit" value="Store"></p>
        </form>
    </div>
</div>
<?php
} else {
    ?>
    <a class="sign_in" href="../html/index.html">Sign in</a>
    <?php
}
?>
<div class="footer">
    <div class="brand">
        <p class="p1">WeMate</p>
    </div>
</div>
</html>