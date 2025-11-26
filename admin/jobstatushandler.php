<?php
include 'dbcon.php';
session_start();
$id = $_POST['jid'];
$cid = $_POST['cid'];
$jobstatdrop = $_POST['jobstatdrop'];

$queryforInsert = "UPDATE jobs SET jobs_status='$jobstatdrop' WHERE jobs_id='$id' ";


if (mysqli_query($conn, $queryforInsert)) {
    include 'dbcon.php';
    $sql1 = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'Lodged' && jobs_cid = $cid";
    $result1 = $conn->query($sql1)->fetch_array();


    $currentdate = date("Y-m-d");
    $sql2 = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'active' && jobs_cid = $cid";
    $result2 = $conn->query($sql2)->fetch_array();


    $currentdate = date("Y-m-d");
    $sql3 = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'completed' && jobs_cid = $cid";
    $result3 = $conn->query($sql3)->fetch_array();



    echo json_encode(array(
        "statusCode" => 200,
        "R1" => $result1[0],
        "R2" => $result2[0],
        "R3" => $result3[0]
    ));
    // echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 'stwr'));
    echo json_encode(array("errCheck" => $conn->error));
}