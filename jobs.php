<?php

include "header.php";

?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <a href="newjob.php"> <button type="button" class="btn btn-secondary" style="float:right;">Add New
                Job</button></a>
        <br>

        <!-- table  -->

        <div class="outerdiv mt-5">

            <table id="table_idd" class="display">
                <thead>
                    <tr class="text-center">
                        <th class="">ID</th>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Recruiter </th>
                        <th>Status</th>
                        <th>Candidates</th>
                        <th>Edit Job</th>
                        <th>View Job</th>
                    </tr>
                </thead>
                <tbody>


                    <?php

                    include("dbcon.php");
                    $sql = "SELECT * FROM jobs WHERE jobs_cid = $_SESSION[id] ORDER BY jobs_id DESC";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $sqlcount = "SELECT COUNT(resume_jobid) as total FROM resumee WHERE resume_jobid  = $row[jobs_id] and uploadedform = 'cupload'";
                            $resultcount = $conn->query($sqlcount)->fetch_array();
                    ?>

                            <?php
                            echo " <tr class='text-center'> ";
                            ?>

                            <td><?php echo $row["jobs_id"]  ?></td>
                            <td><?php echo $row["jobs_title"]  ?></td>
                            <td><?php echo $row["jobs_clientName"]  ?></td>
                            <td><?php echo $row["jobs_recruterName"]  ?></td>
                            <td><?php echo $row["jobs_status"]  ?></td>

                            <td><?php echo $resultcount[0]  ?></td>
                            <td> <a href="editjob.php?id=<?php echo $row["jobs_id"]; ?>"> Edit </a> </td>
                            <td> <a href="sjob.php?id=<?php echo $row["jobs_id"]; ?>"> View </a> </td>


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
    $(document).ready(function() {
        document.getElementById('table_idd').style.display = "none";

        let timeout;

        function myFunction() {
            timeout = setTimeout(setTable, 500);
        }

        function setTable() {
            document.getElementById('table_idd').style.display = "table";
            $('#table_idd').DataTable({
                order: [
                    [0, 'desc']
                ]
            });

        }
        myFunction();
    });
</script>
<!-- <script>
    $(document).ready(function() {
        $('#table_idd').DataTable({
            order: [
                [0, 'desc']
            ]
        });
    });
</script> -->
<script>
    $(".dashboard").removeClass("active");
    $(".staff").removeClass("active");
    $(".jobs").addClass("active");
</script>