<?php
include "header.php";
$jid = $_GET['id'];
foreach (glob("*.zip") as $filename) {
     if(unlink($filename)){}
 }
if (isset($_POST['createzip'])) {
if (isset($_POST['files'])) {
    $post = $_POST;
        $zip = new ZipArchive();
        $zip_name = "File" . time() . ".zip";
        $file_folder = "../uploads/";
        // Create a zip target
        if ($zip->open($zip_name, ZipArchive::CREATE) !== TRUE) {
        }
        if (isset($post['files']) and count($post['files']) > 0) {
        foreach ($post['files'] as $file) {
                $zip->addFile($file_folder.$file);
                }
        }
        $zip->close();
}
if (file_exists($zip_name)) {
       header('Pragma: public');
	header('Cache-Control: must-revalidate, post-check=0');
	header('Content-type: application/download');
	header('Content-type: application/zip');
	header('Content-Type: application/force-download');
	header('Content-Disposition: attachment; filename='.basename($zip_name).';');
	header('Content-Length:' . filesize($zip_name));
	header('Content-Transfer-Encoding: binary');
	session_write_close();
	while (ob_get_level()) 
    {
     ob_end_clean();
     }
    readfile($zip_name);   
    exit;
    ob_start ();
        }
}
?>

<style>
  thead {
    background: white !important;
  }
</style>
<style>
    .progress-wrapper {
        width: 100%;
    }

    .progress-wrapper .progress {
        background-color: green;
        width: 0%;
        padding: 5px 0px 5px 0px;
    }
</style>
<style>
    .progress-area .row .content {
        width: 61%;
        /* margin-left: 15px; */
    }

    .progress-area .details {
        display: flex;
        align-items: center;
        margin-bottom: 7px;
        justify-content: space-between;
    }

    .progress-area .content .progress-bar {
        height: 6px;
        width: 100%;
        margin-bottom: 4px;
        background: #fff;
        border-radius: 30px;
    }

    .content .progress-bar .progress {
        height: 100%;
        width: 0%;
        background: #6990F2;
        border-radius: inherit;
    }
</style>

<?php
// if (isset($_POST['files'])) {
//   $error = ""; //error holder
//   if (isset($_POST['createzip'])) {
//     $post = $_POST;
//     $file_folder = "../uploads/"; // folder to load files
//     if (extension_loaded('zip')) {
//       // Checking ZIP extension is available
//       if (isset($post['files']) and count($post['files']) > 0) {
//         // Checking files are selected
//         $zip = new ZipArchive(); // Load zip library 
//         $zip_name = time() . ".zip"; // Zip name
//         if ($zip->open($zip_name, ZIPARCHIVE::CREATE) !== TRUE) {
//           // Opening zip file to load files
//           $error .= "* Sorry ZIP creation failed at this time";
//         }
//         foreach ($post['files'] as $file) {
//           $zip->addFile($file_folder . $file); // Adding files into zip
//         }
//         $zip->close();
//         if (file_exists($zip_name)) {
//           // push to download the zip
//           header('Content-type: application/zip');
//           header('Content-Disposition: attachment; filename="' . $zip_name . '"');
//           readfile($zip_name);
//           // remove zip file is exists in temp path
//           unlink($zip_name);
//         }
//       } else
//         $error .= "* Please select file to zip ";
//     } else
//       $error .= "* You dont have ZIP extension";
//   }
// }
?>

<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>
<script type="text/javascript" src="js/jquery_1.5.2.js"></script>
<script type="text/javascript" src="js/vpb_uploader.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    // Call the main function
    new vpb_multiple_file_uploader
      ({
        vpb_form_id: "form_id", // Form ID
        autoSubmit: true,
        vpb_server_url: "upload.php"
      });
  });
</script>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<style>
  .flexx {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    justify-items: center;
    align-items: center;
  }

  .outerdiv {
    margin: 0%;
    background: white;
    padding: 2%;
    border-radius: 0.5rem;
  }

  span.textfdd {
    height: 25px;
    display: inline-flex;
    align-items: center;
    margin: 0 5px 10px 0;
    padding: 0 10px;
    /* color: black; */
    background-color: #ebe9e9;
    border-radius: 12px;
    /* font-size: 12px; */
    line-height: 1;
  }

  .btn-danger {

    background: #40BEAE !important;
    border: none !important;
    box-shadow: none !important;

  }

  .btn-primary {
    border: none;
    box-shadow: none;
  }

  .btn-primary:hover {
    background: grey;
  }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <?php
    include("dbcon.php");
    $sqll = "SELECT COUNT(resume_jobid) as total FROM resumee WHERE resume_jobid  = $jid and uploadedform = 'cupload'";
    $resultt = $conn->query($sqll)->fetch_array();
    include("dbcon.php");
    $sql = "SELECT * FROM jobs WHERE jobs_id = $jid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
    ?>



        <div class="row outerdiv">
          <div class="col-md-6 " style="
    border-right: 1px solid #adadadde;
">
            <div class=" ">


              <p class="ttte" style="padding: 10px; background: #ff7c58; border-radius: 6px; color: white; ">Job Details:</p>
              <p class="ttte">Job Title: <span class="textfd"> <?php echo $row["jobs_title"] ?> </span></p>
              <p class="ttte">Recruiter Name: <span class="textfd"> <?php echo $row["jobs_recruterName"] ?> </span></p>
              <p class="ttte">Company:<span class="textfd"> <?php echo $row["cname"] ?> </span></p>
              <p class="ttte">Candidates:<span class="textfd"> <?php echo $resultt[0] ?> </span></p>

              <p class="ttte">Required Services:<span class="textfd"> <?php echo $row["jobtype"] ?> </span></p>
              <?php
              if ($row["jobtype"] == "Resume Parsing") {
              ?>
                <p class="ttte">First Name:<span class="textfd"> <?php echo $row["fname"] ?> </span></p>
                <p class="ttte">Last Name:<span class="textfd"> <?php echo $row["lname"] ?> </span></p>
                <p class="ttte">Email:<span class="textfd"> <?php echo $row["email"] ?> </span></p>
                <p class="ttte">Mobile:<span class="textfd"> <?php echo $row["phone"] ?> </span></p>
                <p class="ttte">Date Of Birth:<span class="textfd"> <?php echo $row["addresss"] ?> </span></p>

              <?php
              }
              if ($row["jobtype"] == "Resume Matching") {


              ?>
                <p class="ttte">Matching Keyword:<span id="textfdd"> </span></p>
                <input id="mak" type="hidden" value="<?php echo $row["jobs_matchingKeywords"] ?>" />
                <script>
                  const str = document.getElementById('mak').value;
                  arr = str.split(',');
                  arr.forEach(function(entry) {
                    document.getElementById("textfdd").innerHTML += "<span class='textfdd' id='textfdd'>" + entry + "</span>";
                    console.log(entry);
                  });
                  // console.log(arr);
                </script>

              <?php
              }
              if ($row["jobtype"] == "Both Parsing and Matching") {
              ?>
                <p class="ttte">Matching Keyword:<span id="textfdd"> </span></p>
                <input id="mak" type="hidden" value="<?php echo $row["jobs_matchingKeywords"] ?>" />
                <script>
                  const str = document.getElementById('mak').value;
                  arr = str.split(',');
                  arr.forEach(function(entry) {
                    document.getElementById("textfdd").innerHTML += "<span class='textfdd' id='textfdd'>" + entry + "</span>";
                    console.log(entry);
                  });
                  // console.log(arr);
                </script>
                <p class="ttte">First Name:<span class="textfd"> <?php echo $row["fname"] ?> </span></p>
                <p class="ttte">Last Name:<span class="textfd"> <?php echo $row["lname"] ?> </span></p>
                <p class="ttte">Email:<span class="textfd"> <?php echo $row["email"] ?> </span></p>
                <p class="ttte">Mobile:<span class="textfd"> <?php echo $row["phone"] ?> </span></p>
                <p class="ttte">Date Of Birth:<span class="textfd"> <?php echo $row["addresss"] ?> </span></p>

              <?php
              }
              ?>

            </div>
          </div>
          <div class="col-md-6 ">
            <div class="  ">

              <?php
              $sql = "SELECT resume_filelink FROM resumee WHERE resume_jobid  = $jid && uploadedform = 'cupload'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                // output data of each row
              ?>
                <form name="zips" action="" method="post">
                  <p class="ttte" style="padding: 10px; background: #ff7c58; border-radius: 6px; color: white; ">Resumes</p>
                  <div style="height: 350px; overflow: auto">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th style="color:#ff7c58; text-align:center;">Check</th>
                          <th style="color:#ff7c58; text-align:center;">File Name</th>

                        <tr>
                      </thead>
                      <tbody>


                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                          <tr>
                            <td>
                              <input class="chk" type="checkbox" name="files[]" value="<?php echo substr($row['resume_filelink'], 8)  ?>" />

                            </td>
                            <td>
                              <?php echo substr($row['resume_filelink'], 10) ?>

                            </td>


                          </tr>

                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>



                  <div style="display: flex;flex-direction: row;justify-content: space-between;">
                    <div>
                      <!-- Select -->
                      <div>
                        <label>
                          <input type="checkbox" id="checkAll" />
                          Select All

                        </label>
                        <input type="submit" id="submita" class="btn btn-secondary my-2" name="createzip" value="Download All Seleted Files"> <br />

                      </div>
                    </div>
                    <div>
                      <form method="POST">
                        <input type="submit" name="delbut" value="Delete all Resumes" class="btn btn-danger my-2 p-2" style="padding:5px;" />
                      </form>
                    </div>
                  </div>





                </form>
              <?php
              } else {
                // echo "0 results";
              }
              ?>

              <!-- <form method="POST">
                                <input type="submit" name="delbut" value="Delete all Resumes" class="btn btn-danger my-2 p-2" style="padding:5px;" />
                            </form> -->


            </div>
          </div>
        </div>




    <?php
      }
    }
    ?>



    <?php


    if (isset($_POST['delbut'])) {
      $sqlfordel = "SELECT * FROM resumee WHERE resume_jobid  = $jid && uploadedform ='cupload'";
      $resultfordel = $conn->query($sqlfordel);
      if ($resultfordel->num_rows > 0) {
        // output data of each row
        while ($row = $resultfordel->fetch_assoc()) {
          $filename = '../' . $row["resume_filelink"];
          unlink($filename);
        }
        $sql = "DELETE FROM resumee WHERE resume_jobid  = $jid && uploadedform ='cupload'";
        if ($conn->query($sql) === TRUE) {
          echo "<script>location.reload();</script>";
        } else {
          echo "Error deleting record: " . $conn->error;
        }
      } else {
        // echo "Error Occured";
      }
    }
    if (isset($_POST['delbutpk'])) {
      $sqlfordel = "SELECT * FROM resumee WHERE resume_jobid  = $jid && uploadedform ='Matching'";
      $resultfordel = $conn->query($sqlfordel);
      if ($resultfordel->num_rows > 0) {
        // output data of each row
        while ($row = $resultfordel->fetch_assoc()) {
          $filename = $row["resume_filelink"];
          unlink($filename);
        }
        $sql = "DELETE FROM resumee WHERE resume_jobid  = $jid && uploadedform ='Matching'";
        if ($conn->query($sql) === TRUE) {
          echo "<script>location.reload();</script>";
        } else {
          echo "Error deleting record: " . $conn->error;
        }
      } else {
        // echo "Error Occured";
      }
    }
    if (isset($_POST['delbutpkn'])) {
      $sqlfordel = "SELECT * FROM resumee WHERE resume_jobid  = $jid && uploadedform ='NotMatching'";
      $resultfordel = $conn->query($sqlfordel);
      if ($resultfordel->num_rows > 0) {
        // output data of each row
        while ($row = $resultfordel->fetch_assoc()) {
          $filename = $row["resume_filelink"];
          unlink($filename);
        }
        $sql = "DELETE FROM resumee WHERE resume_jobid  = $jid && uploadedform ='NotMatching'";
        if ($conn->query($sql) === TRUE) {
          echo "<script>location.reload();</script>";
        } else {
          echo "Error deleting record: " . $conn->error;
        }
      } else {
        // echo "Error Occured";
      }
    }
    ?>



    <div class="matchingresume" style="background-color: white; padding:15px; border-radius:10px; margin:2% 0%">

      <p class="ttte" style="padding: 10px; background: #ff7c58; border-radius: 6px; color: white; ">Upload Resumes</p>

      <form name="form_id" id="form_id" action="javascript:void(0);" enctype="multipart/form-data" style="width:800px; margin-top:20px;">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
          <label class="form-check-label" for="flexRadioDefault1">
            Matched
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
          <label class="form-check-label" for="flexRadioDefault2">
            Not Matched
          </label>
        </div>
        <input type="file" name="vasplus_multiple_files" id="vasplus_multiple_files" multiple="multiple" style="padding:5px;" />
        <input type="hidden" id="jobid" name="jobid" value="<?php echo $jid; ?>">
        <input type="hidden" id="uploadedform" name="jobid" value="matching">

        <input type="submit" value="Upload Resumes" class="btn btn-primary my-2 p-2" style="padding:5px;" />

<section class="progress-area"></section>

      </form>
      <div style="height: 150px; overflow: auto">

        <table class="table table-striped table-bordered" id="add_files">
          <thead>
            <tr>
              <th style="color:#ff7c58; text-align:center;">File Name</th>
              <th style="color:#ff7c58; text-align:center;">Status</th>
              <th style="color:#ff7c58; text-align:center;">File Size</th>
              <th style="color:#ff7c58; text-align:center;">Action</th>
            <tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>


    <!-- nichy 2 table -->
    <div class="row matchingresume" style="background-color: white; padding:15px; border-radius:10px; margin:2% 0%">
      <div class="col-md-6" style="
    border-right: 1px solid #adadadde;
">
        <div class="  ">

          <?php
          $sql = "SELECT resume_filelink FROM resumee WHERE resume_jobid  = $jid && uploadedform ='Matching'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
          ?>
            <form name="zips" action="" method="post">
              <p class="ttte" style="padding: 10px; background: green; border-radius: 6px; color: white; ">Matching Resumes</p>
              <div style="height: 350px; overflow: auto">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="color:#ff7c58; text-align:center;">Check</th>
                      <th style="color:#ff7c58; text-align:center;">File Name</th>

                    <tr>
                  </thead>
                  <tbody>



                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td>
                          <input class="chkm" type="checkbox" name="files[]" value="<?php echo $row['resume_filelink'] ?>" />

                        </td>
                        <td>
                          <label><?php echo substr($row['resume_filelink'], 13) ?></label>

                        </td>


                      </tr>

                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>



              <div style="display: flex;flex-direction: row;justify-content: space-between;">
                <div>
                  <!-- Select -->
                  <div>
                    <label>
                      <input type="checkbox" id="checkallmatch" />
                      Select All

                    </label>
                    <input type="submit" id="submitb" class="btn btn-secondary my-2" name="createzip" value="Download All Seleted Files"> <br />

                  </div>
                </div>
                <div>
                  <form method="POST">
                    <input type="submit" name="delbutpk" value="Delete all Resumes" class="btn btn-danger my-2 p-2" style="padding:5px;" />
                  </form>
                </div>
              </div>





            </form>
          <?php
          } else {
            // echo "0 results";
          }
          ?>

          <!-- <form method="POST">
                                <input type="submit" name="delbut" value="Delete all Resumes" class="btn btn-danger my-2 p-2" style="padding:5px;" />
                            </form> -->


        </div>

      </div>
      <div class="col-md-6">
        <div class="  ">

          <?php
          $sql = "SELECT resume_filelink FROM resumee WHERE resume_jobid  = $jid && uploadedform ='NotMatching'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
          ?>
            <form name="zips" action="" method="post">
              <p class="ttte" style="padding: 10px; background: red; border-radius: 6px; color: white; ">Not Matching Resumes</p>
              <div style="height: 350px; overflow: auto">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="color:#ff7c58; text-align:center;">Check</th>
                      <th style="color:#ff7c58; text-align:center;">File Name</th>

                    <tr>
                  </thead>
                  <tbody>



                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td>
                          <input class="chknm" type="checkbox" name="files[]" value="<?php echo $row['resume_filelink'] ?>" />

                        </td>
                        <td>
                          <label><?php echo substr($row['resume_filelink'], 13) ?></label>

                        </td>


                      </tr>

                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>



              <div style="display: flex;flex-direction: row;justify-content: space-between;">
                <div>
                  <!-- Select -->
                  <div>
                    <label>
                      <input type="checkbox" id="checkallNotmatch" />
                      Select All

                    </label>
                    <input type="submit" id="submitc" class="btn btn-secondary my-2" name="createzip" value="Download All Seleted Files"> <br />

                  </div>
                </div>
                <div>
                  <form method="POST">
                    <input type="submit" name="delbutpkn" value="Delete all Resumes" class="btn btn-danger my-2 p-2" style="padding:5px;" />
                  </form>
                </div>
              </div>





            </form>
          <?php
          } else {
            // echo "0 results";
          }
          ?>

          <!-- <form method="POST">
                                <input type="submit" name="delbut" value="Delete all Resumes" class="btn btn-danger my-2 p-2" style="padding:5px;" />
                            </form> -->


        </div>

      </div>
    </div>
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