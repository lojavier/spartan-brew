<!DOCTYPE html>
<html lang="de"><!-- use class="debug" here if you develope a template and want to check-->
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="put a short description in here" />
    <meta name="keywords" content="put your important keywords in here" />
    <meta name="revisit-after" content="7 days" />
    <meta name="robots" content="index,follow" />
	
	<title>SpartanBrew</title>
			
            <link rel="stylesheet" href="css/inuit.css" />
            <link rel="stylesheet" href="css/fluid-grid16-1100px.css" />
            <link rel="stylesheet" href="css/eve-styles.css" />
            <link rel="stylesheet" href="css/formalize.css" /><!--include that only on pages with forms-->
			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
            <link rel="shortcut icon" href="icon.png" />
            <link rel="apple-touch-icon-precomposed" href="img/icon.png" />
            
            <script src="js/respond-min.js" type="text/javascript"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
            <script>window.jQuery || document.write('<script src="scripts/jquery164min.js">\x3C/script>')</script><!--local fallback for JQuery-->
            <script src="js/jquery.formalize.min.js" type="text/javascript"></script><!--include that only on pages with forms-->
			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
			<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
			<script src="js/beer-functions.js" type="text/javascript"></script>
			
			<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
			<script>
				var myCenter=new google.maps.LatLng(37.335000,-121.881056);
				var marker;
				function initialize() {
					var mapProp = {
					  center:myCenter,
					  zoom:15,
					  mapTypeId:google.maps.MapTypeId.ROADMAP
					  };
					var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
					marker=new google.maps.Marker({
					  position:myCenter,
					  icon:'beer.png',
					  animation:google.maps.Animation.BOUNCE
					  });

					marker.setMap(map);
				}
				google.maps.event.addDomListener(window, 'load', initialize);
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
	<div class="wrapper">	
		<a href="index.php" id="logo"><img src="img/logo.png" alt="something" />
		<h1 class="accessibility">SpartanBrew</h1></a>

		<!--These are just samples, use your own icons. If you use larger ones, make sure too change the css-file to fit them in-->
		<div class="social">
		<a href="#" title="facebook"><img src="img/facebook.png" width="20" height="20" alt="facebook"></a>
		<a href="#" title="twitter"><img src="img/twitter.png" width="20" height="20" alt="twitter"></a>
		<a href="#" title="linkedin"><img src="img/linkedin.png" width="20" height="20" alt="linkedin"></a>
		<a href="#" title="instagram"><img src="img/instagram.png" width="20" height="20" alt="instagram"></a>
		
<?php
require_once("config/spartanbrewdb.php");
require_once("classes/Login.php");
$login = new Login();

if ($login->isUserLoggedIn() == true) { // ************************************* logged in ******************************************************
?>   
		<a href="home.php?logout" title="logout">Logout</a>
		</div>
		
		<ul id="nav" class="main">
			<li><a href="home.php">Home</a></li>
			<li><a href="ales.php">Ales</a></li>
			<li><a href="lagers.php">Lagers</a></li>
			<li><a href="stats.php">Stats</a></li>
			<li><a href="#" class="active">Contact</a></li>
		</ul>
		
		<div id="brewing_session_data" style="display: none;"></div>
					
		<?php include 'confirmIngredientAdd.php';?>
		
<?php } else { // ************************************* NOT logged in ******************************************************
?>
		</div>
		
		<ul id="nav" class="main">
			<li><a href="index.php">Login</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="#" class="active">Contact</a></li>
		</ul>
<?php
}
?>
					
    </div><!--end of wrapper div--> 
           
	<div class="clear"></div>
	
	<div id="send_email_flag"></div>
		
	<div id="confirm-email-sent" style="display: none;" title="CONTACT US">
	  <p><span class="ui-icon ui-icon-alert" style="float:left;"></span>
		E-mail sent successfully! Please allow 48-72 hours for a response.<br/><br/></p>
	</div>

<!--===============================================================  Left content, address =====================================================================================-->    
     <div class="wrapper">
    
    		<div class="grids">

                <div class="grid-6 grid">
					
					<h2>Address</h2>
					 <div>   
						<p class="bottom">
						<b>Charles W. Davidson <br>
						College of Engineering -</b><br/>
						<strong>Computer Engineering</strong><br />
						San Jose State University <br/>
						One Washington Square<br />
						San Jose, CA 95192<br />
						Phone: 408-924-4150<br />
						Fax: 408-924-4153<br />
						Email: contact@spartanbrew.net
					  </p>
					 </div>
				
					<div class="bottom" id="googleMap" style="width:98%; height:300px;"></div>
					 
					 <!-- <div class="green bottom">   
						<h3>Info</h3>
						<p>
							Still in progress.
						</p>
					 </div>    -->
					  
				</div> 		
                
<!--===============================================================  Contact form =====================================================================================-->                 
                <div class="grid-10 grid">
                        <h2>Contact us</h2>

					<!--An example for a contact form from formalize.me, table in use.</h6>-->
                                  
                       <form  name="sendemailform" action="sendemail.php" method="post" enctype="multipart/form-data" onsubmit="return true">
                              <table class="form">
                                <tr>
                                  <th>
                                    <label for="name">
                                      Name
                                    </label>
                                  </th>
                                  <td>
                                    <input class="input_full" type="text" id="name" name="name" value="<?php echo $_SESSION['BREWER_FIRST_NAME']." ".$_SESSION['BREWER_LAST_NAME']; ?>" required="required" />
                        
                                  </td>
                                </tr>
                                <tr>
                                  <th>
                                    <label for="email">
                                      Email
                                    </label>
                                  </th>
                                  <td>
                        
                                    <input class="input_full" type="email" id="email" name="email" value="<?php echo $_SESSION['BREWER_EMAIL']; ?>" required="required" />
                                  </td>
                                </tr>
                               
                                <tr>
                                  <th>
                                    <label for="tel">
                                      Phone
                                    </label>
                                  </th>
                                  <td>
                                    <input class="input_full" type="tel" id="tel" name="tel" />
                                  </td>
                                </tr>
								
                                <tr>
                                  <th>
                                    <label for="subject">
                                      Subject
                                    </label>
                                  </th>
                                  <td>
                                    <select class="input_full" id="subject" name="subject">
                        
                                      <option value="">Choose subject...</option>
                                      
                                        <option value="Question">Question</option>
                                        <option value="Project">Project</option>
                                        <option value="Feedback">Feedback</option>
                                        <option value="Other">Other</option>
                        
                                    </select>
                                  </td>
                                </tr>
								
                                <tr>
                                  <th>
                                    <label for="message">
                                      Your<br />
                                      message
                                    </label>
                                  </th>
                                  <td>
                                    <textarea id="message" name="message" rows="8" required="required" placeholder="Please write your message here."></textarea>
                                  </td>
                        
                                <!-- </tr>
                                 <tr>
                                  <th>
                                    <label for="cc">
                                      <abbr title="Courtesy Copy">CC</abbr>
                                    </label>
                                  </th>
                                  <td>
                                    <input type="checkbox" id="cc" name="cc" value="1" />
                                    <label for="cc">
                                      Send me a copy of this email
                                    </label>
                                  </td>
                                </tr> -->
								
								<tr>
									<th> <label for="submit"> </label> </th>
									<td>
										<a class='button' href="javascript:submitEmail()" >Submit</a> 
										<!-- <input type="submit" value="Send" class="float_left" /> -->
									</td>
								</tr>
                              </table>
							  
                            </form>
							
					<!-- <div>   
						<p class="message warning bottom">
							<b>Note:</b> Still in progress.
						</p>
					</div>  -->
                           
                </div><!--end of grid-10--> 
			</div><!--end of grids-->
           
	</div><!--end of wrapper-->
    
<!--===============================================================  Footer =====================================================================================-->     
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
                        
</body>
</html>