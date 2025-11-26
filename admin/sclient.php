<?php

include "header.php";


?>


<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="./assets/img/img/img_453949.png" alt="chart success" class="rounded" />
                            </div>

                        </div>
                        <span class="fw-semibold d-block mb-1">Lodged Jobs</span>
                        <?php
                        include 'dbcon.php';
                        $currentdate = date("Y-m-d");
                        $sql = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'Lodged' && jobs_cid = $_GET[id]";
                        $result = $conn->query($sql)->fetch_array();
                        // var_dump($result[0]);
                        echo "<h3 id='jlodged' class='card-title mb-2'>$result[0]</h3>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="./assets/img/icons/unicons/chart-success.png" alt="chart success"
                                    class="rounded" />
                            </div>

                        </div>
                        <span class="fw-semibold d-block mb-1">Active Jobs</span>
                        <?php
                        include 'dbcon.php';
                        $currentdate = date("Y-m-d");
                        $sql = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'active' && jobs_cid = $_GET[id]";
                        $result = $conn->query($sql)->fetch_array();
                        // var_dump($result[0]);
                        echo "<h3 id='jactive' class='card-title mb-2'>$result[0]</h3>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="./assets/img/icons/unicons/chart-success.png" alt="chart success"
                                    class="rounded" />
                            </div>

                        </div>
                        <span class="fw-semibold d-block mb-1">Completed Jobs</span>
                        <?php
                        include 'dbcon.php';
                        $currentdate = date("Y-m-d");
                        $sql = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_status = 'completed' && jobs_cid = $_GET[id]";
                        $result = $conn->query($sql)->fetch_array();
                        // var_dump($result[0]);
                        echo "<h3 id='jcompleted' class='card-title mb-2'>$result[0]</h3>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>

        <!-- table  -->

        <div class="outerdiv mt-5">


            <table id="table_idd" class="display ">
                <thead>
                    <tr>
                        <th class="">ID</th>
                        <th>Job Title</th>
                        <th>Client Name</th>
                        <th>Recruiter Name</th>
                        <th>Status</th>
                        <th>Candidates</th>
                        <th>View Job</th>


                    </tr>
                </thead>
                <tbody>
                    <?php

                    include("dbcon.php");
                    $sql = "SELECT * FROM jobs WHERE jobs_cid = $_GET[id]";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $sqlcount = "SELECT COUNT(resume_jobid) as total FROM resumee WHERE resume_jobid  = $row[jobs_id] AND uploadedform ='cupload'";
                            $resultcount = $conn->query($sqlcount)->fetch_array();
                    ?>

                    <?php
                            echo " <tr class='text-center'> ";
                            ?>

                    <td><?php echo $row["jobs_id"]  ?></td>
                    <td><?php echo $row["jobs_title"]  ?></td>
                    <td><?php echo $row["jobs_clientName"]  ?></td>
                    <td><?php echo $row["jobs_recruterName"]  ?></td>
                    <!-- <td><?php
                                        //  echo $row["jobs_status"] 
                                        ?></td> -->
                    <td>
                        <form id="jobstat<?php echo $row["jobs_id"] ?>" class="<?php echo $row["jobs_id"] ?>"
                            method="POST">
                            <input type="hidden" value="<?php echo $row["jobs_id"] ?>" name="jid" />
                            <input type="hidden" value="<?php echo $_GET['id']; ?>" name="cid" />
                            <select class="form-control" id="jobstatdrop" name="jobstatdrop"
                                onChange="updateDb(<?php echo $row["jobs_id"] ?>)">
                                <option <?php if ($row["jobs_status"] == 'Lodged') {
                                                    echo 'selected';
                                                } ?> value="Lodged">Lodged</option>
                                <option <?php if ($row["jobs_status"] == 'Active') {
                                                    echo 'selected';
                                                } ?> value="Active">Active</option>
                                <option <?php if ($row["jobs_status"] == 'Completed') {
                                                    echo 'selected';
                                                } ?> value="Completed">Completed</option>
                            </select>
                        </form>
                    </td>
                    <td><?php echo $resultcount[0]  ?></td>
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

<script>
$(".dashboard").removeClass("active");
$(".staff").removeClass("active");
$(".clients").addClass("active");
</script>