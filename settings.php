<?php

include 'header.php';
$id = $client_id;
// echo $id;
include 'dbcon.php';
?>
<?php

if (isset($_POST['submit'])) {



    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $sql = "SELECT client_pass from clients where client_id = $_SESSION[id]";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {


        while ($row = $result->fetch_assoc()) {
            // echo $row['client_pass'];
            if ($oldpass == $row['client_pass']) {
                $queryforInsert = "UPDATE clients SET client_pass = '$newpass' WHERE client_id =  '$_SESSION[id]'";
                if (mysqli_query($conn, $queryforInsert)) {
?><div class="container mt-2">
    <div class="alert alert-success" role="alert">
        Password Changed Succesfully!
    </div>
</div>



<?php
                } else {
                    echo $conn->error;
                }
            } else {
                ?>
<div class="container mt-2">
    <div class="alert alert-danger" role="alert">
        You have entered wrong password!
    </div>
</div>
<?php
            }
        }
    } else {
        echo "0 results";
    }






    ?>


<?php


}


?>



<style>
input {
    margin-top: -2px;
    margin-bottom: 20px;

}

.formdiv {
    background-color: white;
    border-radius: 5px;
    padding: 2%;
    box-shadow: rgba(17, 17, 26, 0.05) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;

}
</style>

<script>
function validateForm() {
    //collect form data in JavaScript variables
    var pw1 = document.getElementById("pswd1").value;
    var pw2 = document.getElementById("pswd2").value;


    //check empty password field
    if (pw1 == "") {
        document.getElementById("message1").innerHTML = "**Fill the password please!";
        return false;
    }

    //check empty confirm password field
    if (pw2 == "") {
        document.getElementById("message2").innerHTML = "**Enter the password please!";
        return false;
    }

    //minimum password length validation
    if (pw1.length < 8) {
        document.getElementById("message1").innerHTML = "**Password length must be atleast 8 characters";
        return false;
    }

    //maximum length of password validation
    if (pw1.length > 15) {
        document.getElementById("message1").innerHTML = "**Password length must not exceed 15 characters";
        return false;
    }

    if (pw1 != pw2) {
        document.getElementById("message2").innerHTML = "**Passwords are not same";
        return false;
    } else {

    }
}
</script>

<div class="container mt-4">
    <div class="formdiv">
        <div class="row ">
            <h1 class="h3 mb-3 font-weight-normal">Update Your Password</h1>

            <div class="col-md-6">



                <form class=" mt-5" onsubmit="return validateForm()" method="POST">

                    <!-- Create a new password -->
                    <td> Enter Current Password* </td>
                    <input class="form-control" type="password" name="oldpass" id="oldpass" value="" required />
                    <span id="oldpass" style="color:red"> </span>

                    <label> Create Password* </label>
                    <input style="margin:0px;" class="form-control" name="newpass" type="password" id="pswd1" required
                        value="" />
                    <span id="message1" style="display: block; color:red;"> </span>
                    <!-- <br> -->
                    <label> Confirm Password* </label>
                    <input class="form-control" style="margin:0px;" type="password" id="pswd2" value="" required />
                    <span id="message2" style="display: block; color:red;"> </span>

                    <input class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="submit" value="submit" />


                    <h5 id="success" class="text-success text-left animated fadeInUp"></h5>
                    <h5 id="error" class="text-danger text-left"></h5>

                </form>

                <!-- Click to verify valid password -->
                <!-- <input type="submit" value="Submit"> -->


                <!-- 
                <label class="">Enter Last Password</label>
                <input type="password" id="prepass" class="form-control" value="" name="prepass"
                    placeholder="Enter Last Password" required autofocus>


                <label class="">Enter New Password</label>
                <input type="password" id="prepass" class="form-control" value="" name="prepass"
                    placeholder="Enter Last Password" required autofocus>


                <label class="">Repeat New Password</label>
                <input type="password" id="prepass" class="form-control" value="" name="prepass"
                    placeholder="Enter Last Password" required autofocus> -->





            </div>
            <div class="col-md-6">


            </div>
        </div>

    </div>
</div>
<?php
include 'footer.php';

?>
<script>
$(".dashboard").removeClass("active");
$(".staff").removeClass("active");
$(".clients").addClass("active");
</script>