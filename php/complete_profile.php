<?php
include('register.php');
if (!isset($_POST['submit'])) {
    exit("submit error");
}
$f = 0;
$ID = $_COOKIE['id'];
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check != false) {
    $image = $_FILES["image"]["tmp_name"];
    $imgContent = addslashes(file_get_contents($image));
}
$gender = $_POST['gender'];
$seeking = $_POST['seeking'];
$age = $_POST['age'];
if (!empty($_POST['smoker'])) {
    $smoker = $_POST['smoker'];
}
else{
    $smoker = "";
}
if(!empty($_POST['drinker'])) {
    $drinker = $_POST['drinker'];
}
else{
    $drinker = "";
}
$description = $_POST['description'];
$banned = 0;

if ($imgContent && $gender && $seeking && $age && $description){
$sql = "select * from profile where user_ID = '$ID' ";
$result = mysqli_query($con, $sql);
if (!$result) {
    printf("Error: error %s\n", mysqli_error($con));
    exit();
}
$rows = mysqli_num_rows($result);
if ($rows) {
?>
<!DOCTYPE html>
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
<p>Profile is complete<br/> please back to sign in !</p>
<h2>3 second return</h2>
</body>
<?php
echo "
                      <script>
                            setTimeout(function(){window.location.href='../html/complete_profile.html';},3000);
                      </script>";
}
else {
$q = "insert into profile(user_ID,gender,age,smoker,drinker,seeking,description,banned,photo) 
        values ('$ID','$gender','$age','$smoker','$drinker','$seeking','$description','$banned','$imgContent')";
$result = mysqli_query($con, $q);
$temp_x=$_POST['interests'];
for($i=0;$i<count($temp_x);$i++){
    if($temp_x[$i]!=""){
        $sql_interest = "select interest_ID from interest_type where interest = '$temp_x[$i]' ";
        $result_interest = mysqli_query($con, $sql_interest);
        $interest= $result_interest->fetch_assoc();
        $str = implode($interest);
        $q_interest = "insert into interests(user_ID,interest_ID) values ('$ID','$str')";
        $result2 = mysqli_query($con, $q_interest);
    }
}
if (!$result) {
        printf("Error:  error2 %s\n", mysqli_error($con));
    exit();
//    <!doctype html>
//<html lang="en">
//<head>
//    <meta charset="UTF-8">
//    <style>
//    body {
//        background-color: darkkhaki;
//        }
//
//        p {
//        color: #333333;
//        font-size: 60px;
//            font-weight: bolder;
//            margin-top: 200px;
//            text-align: center;
//        }
//
//        h2 {
//        text-align: center;
//        }
//    </style>
//</head>
//<body>
//<p> image size too big or invalid format<br/></p>
//<h2>3 second return</h2>
//</body>

//echo "
//                      <script>
//                            setTimeout(function(){window.location.href='complete_profile.php';},3000);
//                      </script>";
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

        .p1 {
            margin-top: 20%;
            text-align: center;
        }

        input {
            width: 20%;
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
<div>
    <p class="p1"><input type="button"
                         onclick=" window.location.href='homepage.php' "
                         value="Let's start !"/></p>
</div>
</body>
<?php
}
}
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
<p>Username information incomplete ! <br/>Or image size too big<br/></p>
<h2>3 second return</h2>
</body>
<?php
echo "
                      <script>
                            setTimeout(function(){window.location.href='../html/complete_profile.html';},3000);
                      </script>";
}
mysqli_close($con);
?>
