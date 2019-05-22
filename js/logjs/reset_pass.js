
	function reset_registration() 
{
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var email = $("#email").val();
	var passwd1 = $("#resetpasswd1").val();
	var passwd2 = $("#resetpasswd2").val();
	
	if(email == "")
	{
		$("#signup_status").html('<div class="info">Please enter your email address to proceed.</div>');
		$("#email").focus();
	}
	else if(reg.test(email) == false)
	{
		$("#signup_status").html('<div class="info">Please enter a valid email address to proceed.</div>');
		$("#email").focus();
	}
	else if(passwd1 == "")
	{
		$("#signup_status").html('<div class="info">Please enter Old password to go.</div>');
		$("#resetpasswd1").focus();
	}
	else if(passwd2 == "")
	{
		$("#signup_status").html('<div class="info">Please enter New password to proceed.</div>');
		$("#resetpasswd2").focus();
	}
	else
	{
		var dataString = 'email=' + email + '&resetpasswd1=' + passwd1 + '&resetpasswd2=' + passwd2 + '&page=reset_registration';
		$.ajax({
			type: "POST",
			url: "reset.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#signup_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var response_brought = response.indexOf('reset_successfully=yes');
				if (response_brought != -1) 
				{
					$("#signup_status").html('');
					window.location.replace(response);
				}
				else
				{
					$("#signup_status").fadeIn(1000).html(response);
				}
			}
		});
	}
}
