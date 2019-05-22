	function user_log() 
{
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var email = $("#email").val();
	var passwd = $("#passwd").val();
	
	if(email == "")
	{
		$("#login_status").html('<div class="info">Please enter your account email address to proceed.</div>');
		$("#email").focus();
	}
	else if(reg.test(email) == false)
	{
		$("#login_status").html('<div class="info">Please enter a valid email address to proceed.</div>');
		$("#email").focus();
	}
	else if(passwd == "")
	{
		$("#login_status").html('<div class="info">Please enter your account password to go.</div>');
		$("#passwd").focus();
	}
	else
	{
		var dataString = 'email=' + email + '&passwd=' + passwd + '&page=user_log';
		$.ajax({
			type: "POST",
			url: "form.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#login_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var response_brought = response.indexOf('login_process_completed_successfully=yes');
				if (response_brought != -1) 
				{
					$("#login_status").html('');
					window.location.replace(response);
				}
				else
				{
					$("#login_status").fadeIn(1000).html(response);
				}
			}
		});
	}
}

function admn_log() 
{
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var email = $("#ademail").val();
	var passwd = $("#adpasswd").val();
	
	if(email == "")
	{
		$("#adm_status").html('<div class="info">Please enter your account email address to proceed.</div>');
		$("#ademail").focus();
	}
	else if(reg.test(email) == false)
	{
		$("#adm_status").html('<div class="info">Please enter a valid email address to proceed.</div>');
		$("#ademail").focus();
	}
	else if(passwd == "")
	{
		$("#adm_status").html('<div class="info">Please enter your account password to go.</div>');
		$("#adpasswd").focus();
	}
	else
	{
		var dataString = 'ademail=' + email + '&adpasswd=' + passwd + '&page=admn_log';
		$.ajax({
			type: "POST",
			url: "form.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#adm_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var response_brought = response.indexOf('login_process_completed_successfully=yes');
				if (response_brought != -1) 
				{
					$("#adm_status").html('');
					window.location.replace(response);
				}
				else
				{
					$("#adm_status").fadeIn(1000).html(response);
				}
			}
		});
	}
}

function pas_log() 
{
	var passwd = $("#passwd").val();
	
	if(passwd == "")
	{
		$("#pas_status").html('<div class="info">Please enter your account password to go.</div>');
		$("#passwd").focus();
	}
	else
	{
		var dataString = '&passwd=' + passwd + '&page=pas_log';
		$.ajax({
			type: "POST",
			url: "form.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#pas_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var response_brought = response.indexOf('login_process_completed_successfully=yes');
				if (response_brought != -1) 
				{
					$("#pas_status").html('');
					window.location.replace(response);
				}
				else
				{
					$("#pas_status").fadeIn(1000).html(response);
				}
			}
		});
	}
}