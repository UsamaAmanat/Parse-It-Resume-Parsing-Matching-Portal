<?php

include 'dbcon.php';
session_start();
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$cby = $_SESSION['adminid'];
$datee = date("Y-m-d");
function randomPassword()
{
    $alphabet = '!@#$%^&*()_abcdefghijklmnopqrstuvwxyz!@#$%^&*()_ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

$passs = randomPassword();

$duplicate = mysqli_query($conn, "select * from users where user_email='$email'");
if (mysqli_num_rows($duplicate) > 0) {
    echo json_encode(array("statusCode" => 201));
} else {

    $queryforInsert = "insert into users( user_firstName, user_lastName, user_email, user_password, user_role, user_status, user_createdAt , AddedByID) 
			values ('$firstname','$lastname', '$email', '$passs','Adminstaff', 'active', '$datee' ,'$cby' )";

   
    if ($conn->query($queryforInsert) === TRUE) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => $conn->error));
    }
}
mysqli_close($conn);
