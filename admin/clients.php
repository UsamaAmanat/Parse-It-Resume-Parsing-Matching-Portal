<?php

include "header.php";


?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <a href="newclient.php"> <button type="button" class="btn btn-secondary" style="float:right;">Add New
                Client</button></a>
        <br>

        <!-- table  -->
        <div class="mt-5 outerdiv">


            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 13%;">Company Name</th>
                        <th class="text-center" style="width: 13%;">Phone</th>
                        <th class="text-center" style="width: 13%;">Active Jobs</th>
                        <th class="text-center" style="width: 13%;">Completed Jobs</th>
                        <th class="text-center" style="width: 13%;">Email</th>
                        <th class="text-center" style="width: 13%;">Password</th>
                        <th class="text-center" style="width: 10%;">Status</th>
                        <th class="text-center" style="width: 10%;">View Client</th>
                        <th class="text-center" style="width: 10%;">Edit</th>


                    </tr>
                </thead>
                <tbody>


                    <?php

                    include("dbcon.php");
                    $sql = "SELECT * FROM clients";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $sql1 = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'completed' && jobs_cid = $row[client_id]";
                            $result1 = $conn->query($sql1)->fetch_array();

                            $sql2 = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'active' && jobs_cid = $row[client_id]";
                            $result2 = $conn->query($sql2)->fetch_array();
                    ?>

                    <?php
                            echo " <tr class='text-center'> ";
                            ?>

                    <td><?php echo $row["client_name"]  ?></td>
                    <td><?php echo $row["client_phone"]  ?></td>
                    <td><?php echo $result2[0]  ?></td>
                    <td><?php echo $result1[0]  ?></td>
                    <td><?php echo $row["client_email"]  ?></td>
                    <td><?php echo $row["client_pass"]  ?></td>
                    <td><?php echo $row["client_status"]  ?></td>
                    <td> <a href="sclient.php?id=<?php echo $row['client_id'] ?>"> View </a> </td>
                    <td> <a href="editclient.php?id=<?php echo $row['client_id'] ?>"> Edit </a> </td>


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

        <!-- table -->

    </div>
</div>
<!-- / Content -->

<?php
include "footer.php";
?>


<script>
$(".dashboard").removeClass("active");
$(".staff").removeClass("active");
$(".clients").addClass("active");
</script>