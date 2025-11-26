<?php

include 'header.php';
$id = $_GET['id'];
// echo $id;
include 'dbcon.php';
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
<?php
$sql = "SELECT * FROM clients where client_id =  $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
?>

        <div class="container">
            <form class="formdiv mt-5" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <?php

                    if (isset($_POST['submit'])) {
                        $cname = $_POST['cname'];
                        $cemail = addslashes($_POST['cemail']);
                        $cname = addslashes($_POST['cname']);
                        $cphone = addslashes($_POST['cphone']);
                        $cwebsite = addslashes($_POST['cwebsite']);
                        $caddress = addslashes($_POST['caddress']);
                        $cstate = addslashes($_POST['cstate']);
                        $ccity = addslashes($_POST['ccity']);
                        $cpostal = addslashes($_POST['cpostal']);
                        $ccountry = addslashes($_POST['ccountry']);
                        $cdatee = date("Y-m-d h:i:sa");

                        // Image
                        $filename = $_FILES["uploadfile"]["name"];
                        $tempname = $_FILES["uploadfile"]["tmp_name"];
                        $folder = "../image/" . $filename;
                        if (move_uploaded_file($tempname, $folder)) {
                        } else {
                            $filename = addslashes($_POST['oldimage']);
                        }


                        $queryforInsert = "UPDATE clients SET client_name = '$cname', client_Company_Name = '$cname', client_address ='$caddress', client_state = '$cstate', client_city = '$ccity' , client_postaalCode = '$cpostal', client_country = '$ccountry', client_phone = '$cphone',  client_status = 'active', client_url ='$cwebsite', client_logo = '$filename' ,client_email = '$cemail' WHERE client_id =  '$id'";

                        if (mysqli_query($conn, $queryforInsert)) {
                    ?>
                            <script>
                                location.replace("./editclient.php?id=<?php echo $id; ?>");
                            </script>
                            <!-- <div class="container"> -->
                            <div class="alert alert-success" role="alert">
                                Updated!
                            </div>
                            <!-- </div> -->
                    <?php
                        } else {
                            echo $conn->error;
                        }
                    }


                    ?>
                    <h1 class="h3 mb-3 font-weight-normal">Update client Info</h1>

                    <div class="col-md-6">


                        <label class="">Company Name</label>
                        <input type="text" id="companyName" class="form-control" value="<?php echo $row["client_Company_Name"] ?>" name="cname" placeholder="Company Name" required autofocus>

                        <label class=""> Email</label>
                        <input type="email" id="Email" class="form-control" value="<?php echo $row["client_email"] ?>" name="cemail" placeholder="Email" required autofocus>


                        <label class="">Phone</label>
                        <input type="text" id="Phone" class="form-control" value="<?php echo $row["client_phone"] ?>" name="cphone" placeholder="Phone" required autofocus>


                        <label class="">Website</label>
                        <input type="text" id="Website" class="form-control" value="<?php echo $row["client_url"] ?>" name="cwebsite" placeholder="Website" required autofocus>

                        <label class=""> Address</label>
                        <input type="text" id="Address" class="form-control" value="<?php echo $row["client_address"] ?>" name="caddress" placeholder="Address" required autofocus>



                    </div>
                    <div class="col-md-6">



                        <label class=""> State</label>
                        <input type="text" id="State" class="form-control" value="<?php echo $row["client_state"] ?>" name="cstate" placeholder="State" required autofocus>

                        <label class=""> City/Suburb</label>
                        <input type="text" id="City" class="form-control" value="<?php echo $row["client_city"] ?>" name="ccity" placeholder="City" required autofocus>

                        <label class=""> postal Code</label>
                        <input type="text" id="postal" class="form-control" value="<?php echo $row["client_postaalCode"] ?>" name="cpostal" placeholder="postal Code" required autofocus>

                        <label class="">Country</label>
                        <input type="text" id="Country" class="form-control" value="<?php echo $row["client_country"] ?>" name="ccountry" placeholder="Country" required autofocus>
                        <input type="hidden" value="<?php echo $row["client_logo"] ?>" name="oldimage" />

                        <img src="../image/<?php echo $row["client_logo"] ?>" class="img-fluid" width="150" alt="Company Logo" />
                        <div class="form-group">
                            <label class="">Update Logo</label>
                            <input class="form-control" type="file" name="uploadfile" accept="image/*" id="logofile" value="" />
                        </div>

                <?php
            }
        } else {
            echo "0 results";
        }
                ?>



                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Update Client
                        Information</button>
                    <h5 id="success" class="text-success text-left animated fadeInUp"></h5>
                    <h5 id="error" class="text-danger text-left"></h5>
                </div>
            </form>

        </div>

        <?php
        include 'footer.php';

        ?>
        <script>
            $(".dashboard").removeClass("active");
            $(".staff").removeClass("active");
            $(".clients").addClass("active");
        </script>