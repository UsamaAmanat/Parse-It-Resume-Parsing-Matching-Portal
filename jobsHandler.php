<?php

include 'dbcon.php';
session_start();
$JobType = "";


$ClientId = $_SESSION['id'];
$name = $_SESSION['Clientname'];
$Title = $_POST['Title'];
$Recruiter = $_POST['Recruiter'];
$cname = $_POST['cname'];
// Tags Field
$tags = $_POST['tags'];
$Keywords = addslashes($tags);
// Candidates Data
// $fname = $_POST['CFirstName'];
// $lname = $_POST['CFLastName'];
// $Email = $_POST['Email'];
// $Phone = $_POST['Phone'];
// $Addresss = $_POST['Address'];
$jobtypedd = $_POST['jobtypedd'];

$cdatee = date("Y-m-d");

if (!isset($_POST['isfname'])) {
    $fname = "No";
} else if (isset($_POST['isfname'])) {
    $fname = "Yes";
}

if (!isset($_POST['islname'])) {
    $lname = "No";
} else if (isset($_POST['islname'])) {
    $lname = "Yes";
}

if (!isset($_POST['isemail'])) {
    $Email = "No";
} else if (isset($_POST['isemail'])) {
    $Email = "Yes";
}

if (!isset($_POST['isphone'])) {
    $Phone = "No";
} else if (isset($_POST['isphone'])) {
    $Phone = "Yes";
}

if (!isset($_POST['isaddress'])) {
    $Addresss = "No";
} else if (isset($_POST['isaddress'])) {
    $Addresss = "Yes";
}

// if ($tags == "" && $fname != "") {
//     $JobType = "Parsing Resume";
// } else if ($tags != "" && $fname == "") {
//     $JobType = "Matching Resume";
// } else if ($tags != "" && $fname != "") {
//     $JobType = "Parsing and Matching Both Resume";
// }

if ($Recruiter) {

    $queryforInsert = "INSERT INTO jobs(jobs_clientName, jobs_recruterName, jobs_title, jobs_status, jobs_matchingKeywords,jobs_date, jobs_totalResume, jobs_cid,   fname, lname, email, phone, addresss, jobtype, cname) VALUES ('$name', '$Recruiter', '$Title', 'Lodged',  '$Keywords', '$cdatee', 'none', '$ClientId', '$fname', '$lname', '$Email', '$Phone', '$Addresss', '$jobtypedd','$cname') ";

    if (mysqli_query($conn, $queryforInsert)) {
        echo json_encode(array("statusCode" => 200, "lastid" => $conn->insert_id));
    } else {
        echo json_encode(array("statusCode" => 'stwr'));
        echo json_encode(array("errCheck" => $conn->error));
    }
} else {
    echo json_encode(array("statusCode" => 'stwr'));
    echo json_encode(array("errCheck" => $conn->error));
}
mysqli_close($conn);
