$("form").submit(function(e){
		e.preventDefault();
		var error = "";
		if($("#name").val()==""){
			error += "The Name Field is Required.<br>";
		}

		if($("#email").val()==""){
			error += "The Email is Required.<br>";
		}

		if($("#phone").val()==""){
			error += "The Contact Field is Required.<br>";
		}

		if($("#clg").val()==""){
			error += "The College Name Field is Required.<br>";
		}

		if($("#crs").val()==""){
			error += "The Course Name Field is Required.";
		}
		if(error != "")
		{
			$("#error").html('<div class="alert alert-danger" role="alert" ><p><strong>There were some error(s) in your form!</strong></p>' + error +'</div>');
	  	} else{
	  		$("form").unbind("submit").submit();
	  	}
	});