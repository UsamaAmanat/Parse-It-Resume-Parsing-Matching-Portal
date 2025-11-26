<?php
include 'dbcon.php';
session_start();
if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
	$jobId = $_POST['jobid'];
	$uploaderform = $_POST['uploaderform'];
	$formf = $_POST['flexRadioDefault1'];

	if ($formf == "on") {
		$formf = "Matching";
	} else {
		$formf = "NotMatching";
	}
	// $flexRadioDefault2 = $_POST['flexRadioDefault2'];
	// if (isset($_POST['flexRadioDefault1']) == "on") {
	// 	$formf = "Matching";
	// } else {
	// 	$formf = "Not Matching";
	// }
	$cdatee = date("Y-m-d h:i:sa");
	$vpb_file_name = strip_tags($_FILES['upload_file']['name']); //File Name
	$vpb_file_id = strip_tags($_POST['upload_file_ids']); // File id is gotten from the file name
	$vpb_file_size = $_FILES['upload_file']['size']; // File Size
	$vpb_uploaded_files_location = '../uploads/'; //This is the directory where uploaded files are saved on your server
	$rn = rand(10, 100);
	$vpb_final_location = $vpb_uploaded_files_location . $rn . $vpb_file_name; //Directory to save file plus the file to be saved
	//Without Validation and does not save filenames in the database
	if (move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $vpb_final_location)) {
		//Display the file id


		$queryforInsert = "INSERT INTO resumee(resume_jobid, resume_uploaderid, resume_filelink, uploadedform) VALUES ('$jobId', '$_SESSION[id]', '$vpb_final_location', '$formf' ) ";

	if ($conn->query($queryforInsert) === TRUE) {
			echo "New record created successfully";
			echo json_encode(array("statusCode" => '236'));
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		echo $vpb_file_id;
	} else {
		//Display general system error
		echo 'general_system_error';
	}
}