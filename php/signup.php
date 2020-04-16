<?php
include('register.php');
if (!isset($_POST['submit'])) {
    exit("submit error");
}
$f = 0;
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$handle = $_POST['handle'];
$ID = uniqid();
if ($firstname && $lastname && $password1 && $password2 && $email && $handle){
if (trim($password1) == trim($password2)) {
$sql = "select * from users where email = '$email' ";
$result = mysqli_query($con, $sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
$rows = mysqli_num_rows($result);
if ($rows) {
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
<p>User have exist !<br/></p>
<h2>3 second return</h2>
</body>
<?php
echo "
                      <script>
                            setTimeout(function(){window.location.href='../html/signup.html';},3000);
                      </script>";
}
else {
$q = "insert into users(user_ID,email,password,firstname,lastname,handle) values ('$ID','$email','$password1','$firstname','$lastname','$handle')";
$result = mysqli_query($con, $q);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
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
<p class="p">Succeed !</p>
<div>
    <p class="p1"><input type="button"
                         onclick=" window.location.href='../html/index.html' "
                         value="Back to sign in"/></p>
</div>
</body>
<?php
}
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
<p>Two Passwords are not same !<br/></p>
<h2>3 second return</h2>
</body>
<?php
echo "
                      <script>
                            setTimeout(function(){window.location.href='../html/signup.html';},3000);
                      </script>";
}
}
else
{
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
<p>Username,e-mail or Password<br/>should not be empty !<br/></p>
<h2>3 second return</h2>
</body>
<?php
echo "
                      <script>
                            setTimeout(function(){window.location.href='../html/signup.html';},3000);
                      </script>";
}
mysqli_close($con);
?>
