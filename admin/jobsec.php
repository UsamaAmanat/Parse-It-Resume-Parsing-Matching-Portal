<?php
include 'dbcon.php';
$sql1 = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'Lodged' && jobs_cid = $_GET[id]";
$result1 = $conn->query($sql1)->fetch_array();


$currentdate = date("Y-m-d");
$sql2 = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'active' && jobs_cid = $_GET[id]";
$result2 = $conn->query($sql2)->fetch_array();


$currentdate = date("Y-m-d");
$sql3 = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'completed' && jobs_cid = $_GET[id]";
$result3 = $conn->query($sql3)->fetch_array();



echo json_encode(array("statusCode" => 200, "R1" => $result1[0], "R2" => $result2[0], "R3" => $result3[0]));