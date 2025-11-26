	// Start of Login Ajax */*
$('#loginn').on('click', function(e) {
        e.preventDefault();
		var email = $('#inputEmail').val();
		var password = $('#inputPassword').val();
		if(email!="" && password!="" ){
			$.ajax({
				url: "loginHandler.php",
				type: "POST",
				data: {
					type:2,
					email: email,
					password: password						
				},
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						console.log("fdsf");
                        $('#success').html('Logged In!');
                        $("#error").hide().fadeOut("slow");
                         location.href = "index.php";	


					}
					else if(dataResult.statusCode==202){
						$("#error").show().fadeIn("slow");
						$("#success").hide().fadeOut("slow");

                        $('#error').html('No account found with this email !');
					}
					else if(dataResult.statusCode==201){
						$("#error").show().fadeIn("slow");
						$("#success").hide().fadeOut("slow");

                        $('#error').html('Invalid EmailId or Password !');
					}
					
				}
			});
		}
		else{
            $('#error').html('Please fill all the fields !');
		}
	});
	// End of Login Ajax */*

	// Start of Client Ajax */*

$('#clientdataform').on('submit', function(e) {
        e.preventDefault();
		var dataa = $('#clientdataform').serialize();
		
		if(dataa!=""){
			$.ajax({
				url: "jobsHandler.php.php",
				type: "POST",
				data: dataa,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
                        $('#success').html('A New Client Added Successfully!');
                        $("#error").hide().fadeOut("slow");

					}
					else if(dataResult.statusCode=="stwr"){
						$("#error").show().fadeIn("slow");
						$("#success").hide().fadeOut("slow");

                        $('#error').html('Something went wrong inserting the data please try again!');
					}
					else if(dataResult.statusCode==201){
						$("#error").show().fadeIn("slow");
						$("#success").hide().fadeOut("slow");

                        $('#error').html('Email already exist!');
					}
					
				}
			});
		}
		else{
            $('#error').html('Please fill all the fields !');
		}
	});

	// End of Client Ajax */*



	// Start of Staff Ajax */*
	
$('#staffdataform').on('submit', function(e) {
        e.preventDefault();
		var dataa = $('#staffdataform').serialize();
		
		if(dataa!=""){
			$.ajax({
				url: "staffHandler.php",
				type: "POST",
				data: dataa,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
                        $('#success').html('A New Staff Added Successfully!');
                        $("#error").hide().fadeOut("slow");
                         location.href = "staff.php";	



					}
					else if(dataResult.statusCode=="stwr"){
						$("#error").show().fadeIn("slow");
						$("#success").hide().fadeOut("slow");

                        $('#error').html('Something went wrong inserting the data please try again!');
					}
					else if(dataResult.statusCode==201){
						$("#error").show().fadeIn("slow");
						$("#success").hide().fadeOut("slow");

                        $('#error').html('Email already exist!');
					}
					
				}
			});
		}
		else{
            $('#error').html('Please fill all the fields !');
		}
	});

	// End of Staff Ajax */*

		// Start of Job Ajax */*
	
$('#submitJob').on('click', function(e) {
        e.preventDefault();
		
		const tags = $('#tagsValue').val();
		var dataa = $('#jobdataform').serialize() + '&tags=' + tags;
		
		if(dataa!=""){
			$.ajax({
				url: "jobsHandler.php",
				type: "POST",
				data: dataa,
				success: function(dataResult){
					
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
                        $('#success').html('A New Job Posted Successfully!');
                        $("#error").hide().fadeOut("slow");
                         location.href = "sjob.php?id="+dataResult.lastid;	
				
					}
					
					else if(dataResult.statusCode=="stwr"){
						$("#error").show().fadeIn("slow");
						$("#success").hide().fadeOut("slow");

                        $('#error').html('Something went wrong inserting the data please try again!');
					}
					
				}
			});
		}
		else{
            $('#error').html('Please fill all the fields !');
		}
	});
// End of Job Ajax */*

// edit job ajax
$('#submiteditJob').on('click', function(e) {
        e.preventDefault();
		
		const tags = $('#tagsValue').val();
		var dataa = $('#jobdataform').serialize() + '&tags=' + tags;
		
		if(dataa!=""){
			$.ajax({
				url: "editjobHandler.php",
				type: "POST",
				data: dataa,
				success: function(dataResult){
					
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
                        $('#success').html('Job Edited!');
                        $("#error").hide().fadeOut("slow");
                         location.href = "sjob.php?id="+dataResult.lastid;	
				
					}
					
					else if(dataResult.statusCode=="stwr"){
						$("#error").show().fadeIn("slow");
						$("#success").hide().fadeOut("slow");

                        $('#error').html('Something went wrong inserting the data please try again!');
					}
					
				}
			});
		}
		else{
            $('#error').html('Please fill all the fields !');
		}
	});
	// edit job 
	
	
	
	$('#submita').prop("disabled", true);
	$('#submitb').prop("disabled", true);
	$('#submitc').prop("disabled", true);
	
	
		selectorofchecboxes('checkAll','chk','submita');
		selectorofchecboxes('checkallmatch','chkm','submitb');
		selectorofchecboxes('checkallNotmatch','chknm','submitc');
		
		
	$("#checkAll").click(function(){
		selectorofchecboxes('checkAll','chk','submita');
	})
	$("#checkallmatch").click(function(){
		selectorofchecboxes('checkallmatch','chkm','submitb');
	})
	$("#checkallNotmatch").click(function(){
		selectorofchecboxes('checkallNotmatch','chknm','submitc');
	})



function selectorofchecboxes(selectorId, checboxClass, btnID) {
	
		$('#'+btnID).prop("disabled", true);

$("#"+selectorId).change(function () {
      $("."+checboxClass+":checkbox").prop('checked', $(this).prop("checked"));
	  $("#"+btnID).prop("disabled", false);
	  if ($('.'+checboxClass).filter(':checked').length < 1){
			$('#'+btnID).attr('disabled',true);}
});

$('.'+checboxClass+':checkbox').click(function() {
        if ($(this).is(':checked')) {
			$('#'+btnID).prop("disabled", false);
        } else {
		if ($('.'+checboxClass).filter(':checked').length < 1){
			$('#'+btnID).attr('disabled',true);}
		}
});

}

