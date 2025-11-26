//Job Dropdown upadte
function updateDb(cid) {
  // alert('function trigger');
  var dataa = $("#jobstat" + cid).serialize();
  // console.log(dataa);

  if (dataa != "") {
    $.ajax({
      url: "jobstatushandler.php",
      type: "POST",
      data: dataa,
      success: function (dataResult) {
        var dataResult = JSON.parse(dataResult);
        if (dataResult.statusCode == 200) {
          alert("Job Status Succesfully Changed!");
          document.getElementById("jlodged").innerHTML = dataResult.R1;
          document.getElementById("jactive").innerHTML = dataResult.R2;
          document.getElementById("jcompleted").innerHTML = dataResult.R3;
        } else if (dataResult.statusCode == "stwr") {
          $("#error").show().fadeIn("slow");
          $("#success").hide().fadeOut("slow");

          $("#error").html(
            "Something went wrong inserting the data please try again!"
          );
        } else if (dataResult.statusCode == 201) {
          $("#error").show().fadeIn("slow");
          $("#success").hide().fadeOut("slow");

          $("#error").html("Email already exist!");
        }
      },
    });
  } else {
    $("#error").html("Please fill all the fields !");
  }
}

// Start of Login Ajax */*
$("#loginn").on("click", function (e) {
  e.preventDefault();
  var email = $("#inputEmail").val();
  var password = $("#inputPassword").val();
  if (email != "" && password != "") {
    $.ajax({
      url: "loginHandler.php",
      type: "POST",
      data: {
        type: 2,
        email: email,
        password: password,
      },
      success: function (dataResult) {
        var dataResult = JSON.parse(dataResult);
        if (dataResult.statusCode == 200) {
          $("#success").html("Logged In!");
          $("#error").hide().fadeOut("slow");
          location.href = "index.php";
        } else if (dataResult.statusCode == 201) {
          $("#error").show().fadeIn("slow");
          $("#success").hide().fadeOut("slow");

          $("#error").html("Invalid EmailId or Password !");
        }
      },
    });
  } else {
    $("#error").html("Please fill all the fields !");
  }
});
// End of Login Ajax */*

// Start of Client Ajax */*

$("#clientdataform").on("submit", function (e) {
  e.preventDefault();
  // var fd = new FormData();
  // var files = $('#logofile')[0].files;

  // // Check file selected or not
  // if(files.length > 0 ){
  //    fd.append('uploadfile',files[0]);
  // }
  // var dataa = $('#clientdataform').serialize();
  // var fileval = $("input[type='file']").val();

  // var imageSelecter = $("#logofile"),
  // file = imageSelecter.files;
  // dataa.append("uploadfile", file);
  var fd = "sad";
  if (fd != "") {
    $.ajax({
      url: "clientHandler.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function (dataResult) {
        var dataResult = JSON.parse(dataResult);
        if (dataResult.statusCode == 200) {
          $("#success").html("A New Client Added Successfully!");
          $("#error").hide().fadeOut("slow");
          location.href = "clients.php";
        } else if (dataResult.statusCode == "stwr") {
          $("#error").show().fadeIn("slow");
          $("#success").hide().fadeOut("slow");

          $("#error").html(
            "Something went wrong inserting the data please try again!"
          );
        } else if (dataResult.statusCode == 201) {
          $("#error").show().fadeIn("slow");
          $("#success").hide().fadeOut("slow");

          $("#error").html("Email already exist!");
        }
      },
    });
  } else {
    $("#error").html("Please fill all the fields !");
  }
});

// End of Client Ajax */*

// Start of Staff Ajax */*

$("#staffdataform").on("submit", function (e) {
  e.preventDefault();
  var dataa = $("#staffdataform").serialize();

  if (dataa != "") {
    $.ajax({
      url: "staffHandler.php",
      type: "POST",
      data: dataa,
      success: function (dataResult) {
        var dataResult = JSON.parse(dataResult);
        if (dataResult.statusCode == 200) {
          $("#success").html("A New Staff Added Successfully!");
          $("#error").hide().fadeOut("slow");
          location.href = "staff.php";
        } else if (dataResult.statusCode == "stwr") {
          $("#error").show().fadeIn("slow");
          $("#success").hide().fadeOut("slow");

          $("#error").html(
            "Something went wrong inserting the data please try again!"
          );
        } else if (dataResult.statusCode == 201) {
          $("#error").show().fadeIn("slow");
          $("#success").hide().fadeOut("slow");

          $("#error").html("Email already exist!");
        }
      },
    });
  } else {
    $("#error").html("Please fill all the fields !");
  }
});

// End of Staff Ajax */*

	
// 	$('#submitb').prop("disabled", true);
// 	$('#submitc').prop("disabled", true);
// 	$('#submita').prop("disabled", true);
	
	
		selectorofchecboxes('checkallmatch','chkm','submitb');
		selectorofchecboxes('checkallNotmatch','chknm','submitc');
		selectorofchecboxes('checkAll','chk','submita');
		
		
	$("#checkallmatch").click(function(){
		console.log('kaamkiya');
		selectorofchecboxes('checkallmatch','chkm','submitb');
	})
	$("#checkallNotmatch").click(function(){
		console.log('kaamkiya');
		selectorofchecboxes('checkallNotmatch','chknm','submitc');
	})
	$("#checkAll").click(function(){
	    console.log('kaamkiya');
		selectorofchecboxes('checkAll','chk','submita');
	})



function selectorofchecboxes(selectorId, checboxClass, btnID) {
    console.log('Fucnionchala');
	
		$('#'+btnID).prop("disabled", true);

$("#"+selectorId).change(function () {
      $("."+checboxClass+":checkbox").prop('checked', $(this).prop("checked"));
	  $("#"+btnID).prop("disabled", false);
	  if ($('.'+checboxClass).filter(':checked').length < 1){
			$('#'+btnID).attr('disabled',true);}
});

$('.'+checboxClass+':checkbox').click(function() {
        if ($(this).is(':checked')) {
            console.log("Work");
			$('#'+btnID).prop("disabled", false);
        } else {
		if ($('.'+checboxClass).filter(':checked').length < 1){
			$('#'+btnID).attr('disabled',true);}
		}
});

}
