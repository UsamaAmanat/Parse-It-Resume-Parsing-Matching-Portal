<?php
include 'header.php';
if ($_SESSION['role'] == 'Adminstaff') {
    echo "<script> location.href = 'index.php';	</script> ";
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
<div class="container">
    <div class="">
        <form class="form-signin" id="staffdataform">
            <div class="row my-5 outerdiv ">
                <h1 class="h3 mb-3 font-weight-normal">Add a new staff</h1>

                <div class="col-md-6  ">


                    <label class="">User First Name</label>
                    <input type="text" id="firstname" class="form-control" name="firstname" placeholder="First Name" required autofocus>

                    <label class="">User Last Name</label>
                    <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Last Name" required autofocus>

                    <label class=""> Email</label>
                    <input type="email" id="Email" class="form-control" name="email" placeholder="Email" required autofocus>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">+ Add a new staff</button>
                </div>
                <div class="col-md-6"></div>
                <h5 id="success" class="text-success text-left"></h5>
                <h5 id="error" class="text-danger text-left"></h5>
            </div>
        </form>
    </div>








    <div class="tablediv outerdiv">
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Date</th>

                </tr>
            </thead>
            <tbody>


                <?php

                include("dbcon.php");
                $cny =  $_SESSION['adminid'];
                $sql = "SELECT * FROM users WHERE user_role='Adminstaff' && AddedByID= $cny ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                ?>

                        <?php
                        echo " <tr class='text-left'> ";
                        ?>

                        <td><?php echo $row["user_firstName"]  ?></td>
                        <td><?php echo $row["user_lastName"]  ?></td>
                        <td><?php echo $row["user_email"]  ?></td>
                        <td><?php echo $row["user_password"]  ?></td>
                        <td><?php echo $row["user_role"]  ?></td>
                        <td><?php echo $row["user_status"]  ?></td>
                        <td><?php echo $row["user_createdAt"]  ?></td>



                        <?php
                        echo " </tr>";
                        ?>
                <?php

                    }
                } else {
                    echo "0 results";
                }
                $conn->close();

                ?>


            </tbody>
        </table>
    </div>









</div>

<?php
include 'footer.php';

?>
<script>
    $(".dashboard").removeClass("active");
    $(".clients").removeClass("active");
    $(".staff").addClass("active");
</script>