
<!--
Author: 
Author URL: 
License: 
License URL:
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Landing | IVR Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="icon"  type="image/x-icon" href="favicon.ico">
<!-- Custom Theme files -->
<link href="css/bikebootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/bikestyle.css" type="text/css" rel="stylesheet" media="all"> 
<link href="css/bikefont-awesome.css" rel="stylesheet"> <!-- font-awesome icons -->
<link rel="stylesheet" href="css/bikelightbox.css">
<!--//Custom Theme files-->
<!-- js -->
<script src="js/bikejquery-2.2.3.min.js"></script>  
<!-- //js -->
</head> 
<body>
<body> 
	<!-- banner -->
	<div id="home" class="banner">
		<div class="banner-agileinfo">
			<!-- header -->
			<div class="header">
				<div class="container">		
					<div class="logo">
						<h1>Item Verification Request Portal</h1>
						<h3><span style="color: red;">Your session has expired!</span></h3>
					</div> 
					<div class="menu">
						<a href="" id="menuToggle"> <span class="navClosed"></span> </a>
						<nav>  
							<a href="login.php?logadmin" class="active scroll">Amin</a> 
						</nav>
						<script>
						(function($){
							// Menu Functions
							$(document).ready(function(){
							$('#menuToggle').click(function(e){
								var $parent = $(this).parent('.menu');
							  $parent.toggleClass("open");
							  var navState = $parent.hasClass('open') ? "hide" : "show";
							  $(this).attr("title", navState + " navigation");
									// Set the timeout to the animation length in the CSS.
									setTimeout(function(){
										console.log("timeout set");
										$('#menuToggle > span').toggleClass("navClosed").toggleClass("navOpen");
									}, 200);
								e.preventDefault();
							});
						  });
						})(jQuery);
						</script>
		 
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<!-- //header -->
			<div class="banner-text">
				<div class="container">		
					<a href="login.php?login" class="buy btn-wayra scroll"> Login Here</a>
				</div> 
			</div>
		</div>
		
			<div class="footer-bottom">
				<p>&copy; <?php echo date('Y'); ?> Developed by Sikiru Shittu.</p>
			</div>
	     </div>

	<!-- //banner -->	  
	<!-- jarallax -->  
	<script src="js/SmoothScroll.min.js"></script> 
	<script src="js/jarallax.js"></script> 
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>  
	<!-- //jarallax -->   
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
</body>
</html>