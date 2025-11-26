<?php

include 'dbcon.php';

$cname = $_POST['cname'];
$cemail = $_POST['cemail'];
$cname = $_POST['cname'];
$cphone = $_POST['cphone'];
$cwebsite = $_POST['cwebsite'];
$caddress = $_POST['caddress'];
$cstate = $_POST['cstate'];
$ccity = $_POST['ccity'];
$cpostal = $_POST['cpostal'];
$ccountry = $_POST['ccountry'];
$cdatee = date("Y-m-d");

function randomPassword() {
    $alphabet = '!@#$%^&*()_abcdefghijklmnopqrstuvwxyz!@#$%^&*()_ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "../image/" . $filename;
move_uploaded_file($tempname, $folder);

$passs = randomPassword();
$duplicate = mysqli_query($conn, "select * from clients where client_email='$cemail'");
if (mysqli_num_rows($duplicate) > 0) {
    echo json_encode(array("statusCode" => 201));
} else {

    $queryforInsert = "INSERT INTO clients(client_name, client_Company_Name, client_address, client_state, client_city, client_postaalCode, client_country, client_phone, client_status,
    client_logo, client_url, client_email, client_pass, client_dateCreated) VALUES ('$cname', '$cname', '$caddress', '$cstate', '$ccity', '$cpostal', '$ccountry', '$cphone', 'active',
    '$filename', '$cwebsite', '$cemail', '$passs', '$cdatee' ) ";



    if ($conn->query($queryforInsert) === TRUE) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => $conn->error));
    }
}
mysqli_close($conn);