<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="de"><!-- use class="debug" here if you develope a template and want to check-->
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
			<link rel="stylesheet" href="css/flexslider.css" />
			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
            <link rel="shortcut icon" href="icon.png" />
            <link rel="apple-touch-icon-precomposed" href="img/icon.png" />
            
            <script src="js/respond-min.js" type="text/javascript"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
            <script>window.jQuery || document.write('<script src="scripts/jquery164min.js">\x3C/script>')</script><!--local fallback for JQuery-->
			<script src="js/jquery.flexslider-min.js" type="text/javascript"></script>		
			<!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script> -->
			<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
			<script src="js/beer-functions.js" type="text/javascript"></script>	
            
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
			
			<!-- QR Code Upload -->
			<script type="text/javascript" src="js/llqrcode.js"></script>
			<script type="text/javascript" src="js/webqr.js"></script>
			<!-- <script type="text/javascript" src="js/jquery-1.8.0.min.js"></script> -->
			<!-- <script>
				$(document).ready(function() {
					load();
					setimg();            
				});
			</script> -->
			<link rel="stylesheet" href="css/qr-code-styles.css" />
               
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

$login = new Login();

if ($login->isUserLoggedIn() == true) { // ************************************* logged in ******************************************************
?>
	<div class="wrapper">	
                    <a href="index.php" id="logo"><img src="img/logo.png" alt="something" />
                      <h1 class="accessibility">ResponseEve, a responsive template by SiGa</h1></a>
                   
                   <!--These are just samples, use your own icons. If you use larger ones, make sure too change the css-file to fit them in.
                       Dont´t forget to place your links -->
                    <div class="social">
                    <a href="http://www.facebook.com/profile.php?id=100001520859552" title="facebook"><img src="img/facebook.png" width="20" height="20" alt="facebook"></a>
                    <a href="http://twitter.com/#!/sg_layout" title="twitter"><img src="img/twitter.png" width="20" height="20" alt="twitter"></a>
                    <a href="#" title="linkedin"><img src="img/linkedin.png" width="20" height="20" alt="linkedin"></a>
					<a href="#" title="instagram"><img src="img/instagram.png" width="20" height="20" alt="instagram"></a>
					<a href="home.php?logout" title="logout">Logout</a>
                    </div>
                 
                    
                    <ul id="nav" class="main">
                        <li><a href="#" class="active">Home</a></li>
                        <li><a href="ales.php">Ales</a></li>
                        <li><a href="lagers.php">Lagers</a></li>
						<li><a href="stats.php">Stats</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                    
            
        </div><!--end of wrapper div-->    
	<div class="clear"></div>
    
<!--========================================================================== Intro and FlexSlider =====================================================================================-->    

	<div class="wrapper">
 		<div class="grids top">
                <div class="grid-6 grid intro">
                 <h2>WELCOME!</h2>
                       <p>SpartanBrew is a beer brewing system that is dedicated to helping our beginning and experienced brewers create consistent and delicious beers with
					   our pre-defined beer kits.
                       </p>
                                        
                 </div><!--end of slogan div-->
 
                <div class="grid-10 grid grey">
						<h2>Upload QR Code</h2>
						<p>
						<div id="main">
							<div id="mainbody">
								<div id="outdiv"></div>
								<div id="result"></div>
							</div>
						</div>           
						<canvas id="qr-canvas" width="99%" height="200"></canvas>
						</p>
          		</div><!--end of grid-10-->  
				
				<div id="brewing_session_data" style="display: none;"></div>
					
				<?php include 'confirmIngredientAdd.php';?>
				
		</div><!--end of div grids-->
		<!--<span class="slidershadow"></span>-->
				
	</div><!--end of div wrapper-->
            
<!--========================================================================== Content Part 1 =====================================================================================-->             

    <div class="wrapper">
    		<div class="grids">

                <div class="grid-10 grid"> 
                  
					<?php include 'slideshow.php'; ?>
				  
				</div><!--end of div grid-10-->
					
                <div class="grid-6 grid">
                            <h2>Enjoy it, it´s free!</h2>
                            <p>
                            ResponseEve is responsive, fresh, modern, bold and completly free.  
                            You may use it for both private and commercial projects. If you like it and if you want to show 
                            some respect for my work, consider not to remove the link in the footer - though it is not required.
                            Anyway, do me a favour and spread the word!</p>
                            
                            <p>Please understand that - due to the fact, that this is free - no service is provided.
                            But I am available for freelance jobs! ;-)</p>
                           
                            <a class="button" href="http://sg-layout.com/demo/Eve/ResponseEve.zip">Download me!</a>

          		</div><!--end of grid-10--> 
           
                
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
<?php } else { // ************************************* NOT logged in ******************************************************
header('Location: index.php');
exit();
}
?>
</body>
</html>