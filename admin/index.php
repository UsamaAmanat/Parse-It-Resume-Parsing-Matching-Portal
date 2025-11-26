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
                        <span class="fw-semibold d-block mb-1">New Jobs</span>
                        <?php
                        include 'dbcon.php';
                        $sql = "SELECT COUNT(jobs_id) as total FROM jobs";
                        $result = $conn->query($sql)->fetch_array();
                        // var_dump($result[0]);
                        echo "<h3 class='card-title mb-2'>$result[0]</h3>";
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
                        <span class="fw-semibold d-block mb-1">Last 24 Hour</span>
                        <?php
                        include 'dbcon.php';
                        $currentdate = date("Y-m-d");
                        $sql = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_date = '$currentdate'";
                        $result = $conn->query($sql)->fetch_array();
                        // var_dump($result[0]);
                        echo "<h3 class='card-title mb-2'>$result[0]</h3>";
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
                        <span class="fw-semibold d-block mb-1">Last 7 Days</span>
                        <?php
                        include 'dbcon.php';
                        $currentdate = date("Y-m-d");
                        $sql = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_date > current_date - interval 7 day";
                        $result = $conn->query($sql)->fetch_array();
                        // var_dump($result[0]);
                        echo "<h3 class='card-title mb-2'>$result[0]</h3>";
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
                        <span class="fw-semibold d-block mb-1">Last 30 Days</span>
                        <?php
                        include 'dbcon.php';
                        $currentdate = date("Y-m-d");
                        $sql = "SELECT COUNT(jobs_id) as total FROM jobs where jobs_date > current_date - interval 30 day";
                        $result = $conn->query($sql)->fetch_array();
                        // var_dump($result[0]);
                        echo "<h3 class='card-title mb-2'>$result[0]</h3>";
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- table  -->
        <div class="outerdiv mt-5">
            <table id="table_idd" class="display">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">Id</th>
                        <th class="text-center" style="width: 13%;">Date</th>
                        <th class="text-center" style="width: 13%;">Client Name</th>
                        <th class="text-center" style="width: 13%;">Recruiter Name</th>
                        <th class="text-center" style="width: 13%;">Job Title</th>
                        <th class="text-center" style="width: 13%;">Status</th>
                        <th class="text-center" style="width: 13%;">View</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    include("dbcon.php");
                    $sql = "SELECT * FROM jobs";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>

                    <?php
                            echo " <tr class='text-center'>";
                            ?>

                    <td><?php echo $row["jobs_id"]  ?></td>
                    <td><?php echo $row["jobs_date"]  ?></td>
                    <td><?php echo $row["jobs_clientName"]  ?></td>
                    <td><?php echo $row["jobs_recruterName"]  ?></td>
                    <td><?php echo $row["jobs_title"]  ?></td>
                    <td><?php echo $row["jobs_status"]  ?></td>
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