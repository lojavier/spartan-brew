<!DOCTYPE html>
<html lang="de"><!-- use class="debug" here if you develop a template and want to check-->
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
   	<!-- some meta tags, important for SEO"--> 
    <meta name="description" content="put a short description in here" />
    <meta name="keywords" content="put your important keywords in here" />
    <meta name="revisit-after" content="7 days" />
    <meta name="robots" content="index,follow" />
	
	<title>SpartanBrew</title>
            
            <link rel="stylesheet" href="css/inuit.css" />
            <link rel="stylesheet" href="css/fluid-grid16-1100px.css" />
            <link rel="stylesheet" href="css/eve-styles.css" />
            <link rel="shortcut icon" href="icon.png" />
            <link rel="apple-touch-icon-precomposed" href="img/icon.png" />
            
            <script src="js/respond-min.js" type="text/javascript"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
            <script>window.jQuery || document.write('<script src="scripts/jquery164min.js">\x3C/script>')</script><!--local fallback for JQuery-->
			<script src="js/jquery.flexslider-min.js" type="text/javascript"></script>
            <link rel="stylesheet" href="css/flexslider.css" />
			<script src="js/passwordmatch.js" type="text/javascript"></script> <!-- Password match -->
            
            <script type="text/javascript">
				  $(window).load(function() {
					$('.flexslider').flexslider({
						  animation: "slide",<!--you can also choose fade here-->
						  directionNav: true,<!--Attention: if you choose true here, the nav-buttons will also appear in the ticker! -->
						  keyboardNav: true,
						  mousewheel: true
					});
				  });
				</script>
               
                    <!--Hide the hr img because of ugly borders in IE7. You can change the color of border-top to display a line -->
                    <!--[if lte IE 7]>

                        <style>
                    		hr { display:block; height:1px; border:0; border-top:1px solid #fff; margin:1em 0; padding:0; }
                            .grid-4{ width:22% }
                        </style>
                    <![endif]-->

</head>
<!--===============================================================  Logo, social and menu =====================================================================================--> 
<body>
<?php
require_once("config/spartanbrewdb.php");
require_once("classes/Login.php");
require_once("classes/Registration.php");

$login = new Login();
$registration = new Registration();

if ($login->isUserLoggedIn() == true) { // ************************************* logged in ******************************************************
	// show potential errors / feedback (from login object)
	if (isset($login)) {
		if ($login->errors) {
			foreach ($login->errors as $error) {
				echo "<script>";
				echo "alert ('$error')";
				echo "</script>";
			}
		}
		if ($login->messages) {
			foreach ($login->messages as $message) {
				echo "<script>";
				echo "alert ('$message')";
				echo "</script>";
			}
		}
	}
	if (isset($registration)) {
		if ($registration->errors) {
			foreach ($registration->errors as $error) {
				echo "<script>";
				echo "alert ('$error')";
				echo "</script>";
			}
		}
		if ($registration->messages) {
			foreach ($registration->messages as $message) {
				echo "<script>";
				echo "alert ('$message')";
				echo "</script>";
			}
		}
	}
	header('Location: home.php');
} else { // ************************************* NOT logged in ******************************************************
?>
	<div class="wrapper">	
                    <a href="index.php" id="logo"><img src="img/logo.png" alt="something" />
                      <h1 class="accessibility">SpartanBrew</h1></a>
                   
                   <!--These are just samples, use your own icons. If you use larger ones, make sure too change the css-file to fit them in.
                       Dont´t forget to place your links -->
                    <div class="social">
                    <a href="http://www.facebook.com/profile.php?id=100001520859552" title="facebook"><img src="img/facebook.png" width="20" height="20" alt="facebook"></a>
                    <a href="http://twitter.com/#!/sg_layout" title="twitter"><img src="img/twitter.png" width="20" height="20" alt="twitter"></a>
                    <a href="#" title="linkedin"><img src="img/linkedin.png" width="20" height="20" alt="linkedin"></a>
                    <a href="#" title="instagram"><img src="img/instagram.png" width="20" height="20" alt="instagram"></a>
					</div>
                    
                    <ul id="nav" class="main">
                        <li><a href="index.php">Login</a></li>
                        <li><a href="#" class="active">Register</a></li>
						<li><a href="contact.php">Contact</a></li>
                    </ul>
					   
        </div><!--end of wrapper div-->    
	<div class="clear"></div> 
    
<!--========================================================================== Intro and FlexSlider =====================================================================================-->    

	<div class="wrapper">
 		<div class="grids top">
                <div class="grid-6 grid intro">
                 <h2>Register</h2>
					<form method="post" action="index.php" name="loginform">
						<input id="" type="text" pattern="[a-zA-Z\-]{2,50}" name="brewer_first_name" placeholder="First name" tabindex="1" required autocomplete="on"/>
						<br>
						<input id="" type="text" pattern="[a-zA-Z\-]{2,50}" name="brewer_last_name" placeholder="Last name" tabindex="2" required autocomplete="on"/>
						<br>
						<input id="" type="email" name="brewer_email" placeholder="Email address" tabindex="3" required autocomplete="on"/>
						<br>
						<input id="brewer_password_new" type="password" name="brewer_password_new" pattern=".{6,}" placeholder="Password (6 or more characters)" 
							tabindex="4" required autocomplete="off" />
						<br>
						<input id="brewer_password_repeat" type="password" name="brewer_password_repeat" pattern=".{6,}"  placeholder="Repeat password" 
							tabindex="5" required autocomplete="off" onkeyup="checkPass(); return false;"/> <br>
						<span id="confirmMessage" class="confirmMessage"></span><br>
						
						<input id="" type="text" pattern="[0-9]{6}" name="spartanbrew_id" placeholder="SpartanBrew ID" title="6-digit SpartanBrew ID number" tabindex="6" required autocomplete="on"/>
						</br>
						<input id="register_button" type="submit"  name="register" value="Register" tabindex="7" />
					</form> <br>
					
					<p>Register today to become an official SpartanBrew brewer. Access our database of beer and begin tracking your brewing sessions.</p>
                                        
                 </div><!--end of slogan div-->
 
                <div class="grid-10 grid"> 
                
					<?php include 'slideshow.php'; ?>
				
				</div><!--end of div grid-10-->
        </div><!--end of div grids-->
        <!--<span class="slidershadow"></span>-->
				
    </div><!--end of div wrapper-->
            
<!--========================================================================== Content Part 1 =====================================================================================-->             

    <div class="wrapper">
    
    		<div class="grids">

                  <div class="grid-10 grid">
                            <h2>Header</h2>
                            <p>Still in progress.</p>
                            
                            <p>Still in progress.</p>
                           
                            <a class="button" href="#">Download me!</a>

          		</div><!--end of grid-10--> 
                
                
                <div class="grid-6 grid grey">
                            <h2>This is a quote</h2>
                            <p class="quote">"Still in progress."
                            <span>SpartanBrew</span></p>
            
                </div>
           
                
			</div><!--end of grids-->
           
		</div><!--end of wrapper-->
<hr /> 		

<!--========================================================================== Content Part 2 =====================================================================================-->         

	<?php include 'middlecontent.php'; ?>	
 
	<hr /> 
 
<!--========================================================================== Bottom Content =====================================================================================-->       
	
	<?php include 'bottomcontent.php'; ?>

<!--========================================================================== Footer =====================================================================================-->     
		<div class="wrapper">
					<div id="footer">
            	
						<?php include 'footer.php';?>
				
                   </div><!--end of footer-->
		   </div><!--end of wrapper-->
    
    
        				<script type="text/javascript"> <!--Outdated browsers warning/message and link to Browser-Update. Comment or delete it if you don´t want to use it-->
						var $buoop = {} 
						$buoop.ol = window.onload; 
						window.onload=function(){ 
						 try {if ($buoop.ol) $buoop.ol();}catch (e) {} 
						 var e = document.createElement("script"); 
						 e.setAttribute("type", "text/javascript"); 
						 e.setAttribute("src", "http://browser-update.org/update.js"); 
						 document.body.appendChild(e); 
						} 
						</script> 
<?php
	// show potential errors / feedback (from login object)
	if (isset($login)) {
		if ($login->errors) {
			foreach ($login->errors as $error) {
				echo "<script>";
				echo "alert ('$error')";
				echo "</script>";
			}
		}
		if ($login->messages) {
			foreach ($login->messages as $message) {
				echo "<script>";
				echo "alert ('$message')";
				echo "</script>";
			}
		}
	}
	if (isset($registration)) {
		if ($registration->errors) {
			foreach ($registration->errors as $error) {
				echo "<script>";
				echo "alert ('$error')";
				echo "</script>";
			}
		}
		if ($registration->messages) {
			foreach ($registration->messages as $message) {
				echo "<script>";
				echo "alert ('$message')";
				echo "</script>";
			}
		}
	}
}
?>
</body>
</html>