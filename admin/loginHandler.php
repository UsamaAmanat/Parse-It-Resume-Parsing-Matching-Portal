<?php

include 'dbcon.php';
session_start();

if ($_POST['type'] == 2) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $check = mysqli_query($conn, "select * from users where user_email='$email' and user_password='$password' and user_role='Adminstaff' or user_role='Superadmin' ");

    $query = "select * from users where user_email='$email' and 
    user_password='$password'";

    if (mysqli_num_rows($check) > 0) {

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['email'] = $email;

            while ($row = mysqli_fetch_array($result)) {
                $uid = $row['user_id'];
                $uname = $row['user_firstName'];
                $urole = $row['user_role'];
            }
            $_SESSION['name'] = $uname;
            $_SESSION['adminid'] = $uid;
            if ($urole == "Superadmin") {
                $_SESSION['role'] = 'Superadmin';
            } else {
                $_SESSION['role'] = 'Adminstaff';
            }
            $_SESSION['role'] = $urole;

            echo json_encode(array("statusCode" => 200));
        }
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
