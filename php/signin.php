<?php
include('register.php');
if (!isset($_POST["submit"])) {
    exit("submit error");
}
$email = $_POST['email'];
$password = $_POST['password'];
setcookie('email', $email, time() + 3600);
if ($email && $password) {
$sql_role = "select type from roles where email = '$email'";
$result_role = mysqli_query($con, $sql_role);
$role = $result_role->fetch_assoc();
$str = implode($role);
$rows = mysqli_num_rows($result_role);
if ($rows) {
if (strcmp($str, "admin") == 0){
$sql = "select * from admin where email = '$email' and password='$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
if ($row) {
    setcookie('firstname', $row[3], time() + 3600);
    setcookie('lastname', $row[4], time() + 3600);
    setcookie('handle', $row[5], time() + 3600);
    header("refresh:0;url=admin_user.php");
    exit;
}
else {
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            background-color: darkkhaki;
        }

        p {
            color: #333333;
            font-size: 60px;
            font-weight: bolder;
            margin-top: 200px;
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<p>Email or Password error !<br/><br/></p>
<h2>3 second return</h2>
</body>
<?php
echo "
                    <script>
                            setTimeout(function(){window.location.href='../html/index.html';},3000);
                    </script>
                ";
}
} else{
$sql = "select * from users where email = '$email' and password='$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
if ($row) {
    $sql_profile = "select * from profile where user_ID = '$row[0]'";
    $result_profile = mysqli_query($con, $sql_profile);
    $user = $result_profile->fetch_assoc();
    $rows_profile = mysqli_num_rows($result_profile);
    if($user['banned']!='1') {
        setcookie('leftNum', 19);
        setcookie('rightNum', 70);
        setcookie('id', $row[0], time() + 3600);
        setcookie('firstname', $row[3], time() + 3600);
        setcookie('lastname', $row[4], time() + 3600);
        if ($rows_profile)
            header("refresh:0;url=homepage.php");
        else
            header("refresh:0;url=../html/complete_profile.html");
        exit;
    }
    else{
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            background-color: darkkhaki;
        }

        p {
            color: #333333;
            font-size: 60px;
            font-weight: bolder;
            margin-top: 200px;
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<p>You have be banned by administrator !<br/><br/></p>
<h2>3 second return</h2>
</body>
<?php
echo "
                    <script>
                            setTimeout(function(){window.location.href='../html/index.html';},3000);
                    </script>
                ";
    }
}
else {
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            background-color: darkkhaki;
        }

        p {
            color: #333333;
            font-size: 60px;
            font-weight: bolder;
            margin-top: 200px;
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<p>Email or Password error !<br/><br/></p>
<h2>3 second return</h2>
</body>
<?php
echo "
                    <script>
                            setTimeout(function(){window.location.href='../html/index.html';},3000);
                    </script>
                ";
}
}
}else {
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            background-color: darkkhaki;
        }

        p {
            color: #333333;
            font-size: 60px;
            font-weight: bolder;
            margin-top: 200px;
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<p>Email or Password error !<br/><br/></p>
<h2>3 second return</h2>
</body>
<?php
echo "
                    <script>
                            setTimeout(function(){window.location.href='../html/index.html';},3000);
                    </script>
                ";
}
}
else{
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            background-color: darkkhaki;
        }

        p {
            color: #333333;
            font-size: 60px;
            font-weight: bolder;
            margin-top: 200px;
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<p>Email or Username<br/> should not be empty !<br/></p>
<h2>3 second return</h2>
</body>
<?php
echo "
                      <script>
                            setTimeout(function(){window.location.href='../html/index.html';},3000);
                      </script>";
}
?>
