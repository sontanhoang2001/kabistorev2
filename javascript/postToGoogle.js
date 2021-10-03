function postToGoogle() {
                var field1 = $("#nameField").val();
                var field2 = $("#emailField").val();
                var field3 = $("#mobField").val();
                var field4 = $("#cinema option:selected").text();
 				
				if(field1 == ""){
					alert('Please Fill Your Name');
					document.getElementById("nameField").focus();
					return false;
				}
				if(field2 == ""){
					alert('Please Fill Your Email');
					document.getElementById("emailField").focus();
					return false;
				}
				if(field3 == "" || field3.length > 10 || field3.length < 10){
					alert('Please Fill Your Mobile Number');
					document.getElementById("mobField").focus();
					return false;
				}

	
                $.ajax({
                    url: "https://docs.google.com/forms/d/e/1FAIpQLScvX_rQCdSoZF4PLPUTIDs3cGmnxq2XAjS3gwZjSyDKfkL9zg/viewform?",
					data: {"entry.1172714939": field1, "entry.941236719": field2, "entry.177916505": field3, "entry.2130549573": field4},
                    type: "POST",
                    dataType: "xml",
                    success: function(d)
					{
					},
					error: function(x, y, z)
						{

							$('#success-msg').show();
							$('#form').hide();
							
						}
                });
				return false;
			}