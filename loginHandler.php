<?php
include 'dbcon.php';
session_start();

if ($_POST['type'] == 2) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $checkforClient = mysqli_query($conn, "select * from clients where client_email='$email'");
    $checkforStaff = mysqli_query($conn, "select * from users where user_email='$email'");

    $queryforClient = "select * from clients where client_email='$email' and client_pass='$password'";
    $queryforStaff = "select * from users where user_email='$email' and user_password='$password'";

    if (mysqli_num_rows($checkforClient) > 0) {

        $result = mysqli_query($conn, $queryforClient);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_array($result)) {
                $uid = $row['client_id'];
                $uname = $row['client_name'];
                $logo = $row['client_logo'];
            }
            $_SESSION['Clientname'] = $uname;
            $_SESSION['id'] = $uid;
            $_SESSION['role'] = "client";
            if ($logo == "") {
                $_SESSION['logo'] = "nologo";
            } else {

                $_SESSION['logo'] = $logo;
            }
            echo json_encode(array("statusCode" => 200));
        } else {
            echo json_encode(array("statusCode" => 201));
        }
    } else {
        // staff check
        if (mysqli_num_rows($checkforStaff) > 0) {
            $resultStaff = mysqli_query($conn, $queryforStaff);

            if (mysqli_num_rows($resultStaff) > 0) {

                $idstaff = '';

                while ($row = mysqli_fetch_array($resultStaff)) {

                    $idstaff = $row['AddedByID'];
                    $role = $row['user_role'];
                }
                $_SESSION['role'] = $role;
                $queryforCC = "select * from clients where client_id='$idstaff' ";
                $resultForAddedBy = mysqli_query($conn, $queryforCC);

                while ($row = mysqli_fetch_array($resultForAddedBy)) {
                    $uid = $row['client_id'];
                    $uname = $row['client_name'];
                    $logo = $row['client_logo'];
                }
                $_SESSION['Clientname'] = $uname;
                $_SESSION['id'] = $uid;
                if ($logo == "") {
                    $_SESSION['logo'] = "nologo";
                } else {

                    $_SESSION['logo'] = $logo;
                }

                echo json_encode(array("statusCode" => 200));
            } else {
                echo json_encode(array("statusCode" => 201));
            }
        } else {
            echo json_encode(array("statusCode" => 202));
        }
    }
    mysqli_close($conn);
}
