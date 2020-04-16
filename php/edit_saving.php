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
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$handle = $_POST['handle'];
$email = $_POST['email'];
$password = $_POST['password'];
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
setcookie('firstname', $firstname, time() + 3600);
setcookie('lastname', $lastname, time() + 3600);
setcookie('handle', $handle, time() + 3600);
$sql = "select * from profile where user_ID = '$ID' ";
$result = mysqli_query($con, $sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
$rows = mysqli_num_rows($result);

$q_profile = "UPDATE profile SET user_ID ='$ID',gender='$gender',age='$age',smoker='$smoker',
        drinker='$drinker',seeking='$seeking',description='$description',banned='$banned',photo='$imgContent'
        WHERE user_ID = '$ID'";
$result_profile = mysqli_query($con, $q_profile);

$q_users = "UPDATE users SET  email = '$email', password = '$password', firstname = '$firstname' , lastname = '$lastname',
                handle = '$handle' WHERE user_ID = '$ID'";
$result_users = mysqli_query($con, $q_users);
//$temp_x=$_POST['interests'];
//for($i=0;$i<count($temp_x);$i++){
//    if($temp_x[$i]!=""){
//        $sql_interest = "select interest_ID from interest_type where interest = '$temp_x[$i]' ";
//        $result_interest = mysqli_query($con, $sql_interest);
//        $interest= $result_interest->fetch_assoc();
//        $str = implode($interest);
//        $q_interest = "insert into interests(user_ID,interest_ID) values ('$ID','$str')";
//        $result2 = mysqli_query($con, $q_interest);
//    }
//}
if (!$result_profile&&!$result_users) {
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
                         onclick=" window.location.href='profile.php' "
                         value="Success !"/></p>
</div>
</body>
<?php
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
<p>Username information<br/>incomplete !<br/></p>
<h2>3 second return</h2>
</body>
<?php
echo "
                      <script>
                            setTimeout(function(){window.location.href='profile_edit.php';},3000);
                      </script>";
}
mysqli_close($con);
?>
