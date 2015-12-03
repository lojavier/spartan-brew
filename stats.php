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
			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
            <link rel="shortcut icon" href="icon.png" />
            <link rel="apple-touch-icon-precomposed" href="img/icon.png" />
            
            <script src="js/respond-min.js" type="text/javascript"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
            <script>window.jQuery || document.write('<script src="scripts/jquery164min.js">\x3C/script>')</script><!--local fallback for JQuery-->
			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
			<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
			<script src="js/beer-functions.js" type="text/javascript"></script>
				  
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

		<!--These are just samples, use your own icons. If you use larger ones, make sure too change the css-file to fit them in-->
		<div class="social">
		<a href="#" title="facebook"><img src="img/facebook.png" width="20" height="20" alt="facebook"></a>
		<a href="#" title="twitter"><img src="img/twitter.png" width="20" height="20" alt="twitter"></a>
		<a href="#" title="linkedin"><img src="img/linkedin.png" width="20" height="20" alt="linkedin"></a>
		<a href="#" title="instagram"><img src="img/instagram.png" width="20" height="20" alt="instagram"></a>
		<a href="home.php?logout" title="logout">Logout</a>
		</div>

		<ul id="nav" class="main">
		<li><a href="home.php">Home<!--<span>Die Startseite</span>--></a></li>
		<li><a href="ales.php">Ales</a></li>
		<li><a href="lagers.php">Lagers</a></li>
		<li><a href="#" class="active">Stats</a></li>
		<li><a href="contact.php">Contact</a></li>
		</ul>
                        
    </div><!--end of wrapper div--> 
           
	<div class="clear"></div>

<!--===============================================================  Green box (sidebar) =====================================================================================-->     
      
     <div class="wrapper">
    
    		<div class="grids">
					
                <div class="grid-6 grid">
				
					<div id="brewing_session_flag">
						<?php if($_POST['beer_id']) { ?>
							<script>beginBrewingSession(<?php echo intval($_POST['beer_id']); ?>);</script>
						<?php } ?>
					</div>
					<div id="cancel_brewing_session">
						<?php if($_POST['brewing_session_id']) { ?>
							<script>cancelBrewingSession(<?php echo intval($_POST['brewing_session_id']); ?>);</script>
						<?php } ?>
					</div>
					
					<h3>Brewing Session Data</h3>
					<div id="brewing_session_data"></div>
					
					<?php include 'confirmIngredientAdd.php';?>
					
                </div>
                
<!--===============================================================  Style playground =====================================================================================-->                 
                
                <div class="grid-10 grid">

					<h2>Search Brewing History</h2>
					
					<?php 
					$past_brewing_session_id = $_POST['past_brewing_session_id'] ? intval($_POST['past_brewing_session_id']) : false;
					if($past_brewing_session_id && ($past_brewing_session_id != -1)) {
						$sql = "SELECT * FROM spartanbrewdb.brewing_history WHERE BREWER_ID=".$_SESSION['BREWER_ID']." AND BREWING_SESSION_ID=".$past_brewing_session_id;
						$result = mysqli_query($con,$sql);
					}
					?>
					
					<b>Select previous brewing session:</b>
					<form action="stats.php" method="POST">
						<select name="past_brewing_session_id" onchange="this.form.submit()">
							<option value="-1">Select one:</option>
						<?php
							$sql = "SELECT * FROM spartanbrewdb.brewing_history WHERE BREWER_ID=".$_SESSION['BREWER_ID']." ORDER BY BREWING_DATE ASC";
							$result = mysqli_query($con,$sql);
							while ($row=mysqli_fetch_array($result))
							{
								if($past_brewing_session_id == $row['BREWING_SESSION_ID']) {
									echo "<option value='".$row['BREWING_SESSION_ID']."' selected>".$row['BREWING_DATE'] - $row['BEER_NAME']."</option>";
								} else {
									echo "<option value='".$row['BREWING_SESSION_ID']."'>".$row['BREWING_DATE'] - $row['BEER_NAME']."</option>";
								}
							}
							// Example of brewing history
							$brewing_list = array
							(
								array(10000,"09/01/2014","Blonde Ale"),
								array(10001,"10/01/2014","California IPA"),
								array(10002,"11/01/2014","Scotch Ale")
							);
							
							for($i = 0; $i < sizeof($brewing_list); $i++) {
								if($past_brewing_session_id == $brewing_list[$i][0]) {
									echo "<option value='".$brewing_list[$i][0]."' selected>".$brewing_list[$i][1]." - ".$brewing_list[$i][2]."</option>";
								} else {
									echo "<option value='".$brewing_list[$i][0]."'>".$brewing_list[$i][1]." - ".$brewing_list[$i][2]."</option>";
								}
							}
						?>
						</select>
					</form>
					<br>
					
					<ul class="tabs">
						<li><a href="#tab1">Tab 1</a></li>
						<li><a href="#tab2">Tab 2</a></li>
						<li><a href="#tab3">Tab 3</a></li>
					</ul>
					
					<div class="tab_container">
					<div id="brewing_history">
						<div id="tab1" class="tab_content">
							<p>
							<?php
							echo "Brewing Session ID: " . $past_brewing_session_id;
							?>
							</p>
						</div>
						<div id="tab2" class="tab_content">
							<p>
							Tab 2 info
							</p>
						</div>
						 <div id="tab3" class="tab_content">
						   <p>
							Tab 3 info
							</p> 
						</div>
					</div>
					</div>
                                
                    <hr/>
                                
                                <h2>Images</h2>
                                <p>The following are examples of image formats:</p>
                                <p><img class="left" src="img/small-img4.jpg" width="200" height="150" alt="demo-pic"> <strong>A left aligned 
                                image</strong>. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed viverra tortor non dolor. 
                                Donec nulla libero, ullamcorper sed, consequat dignissim, luctus blandit, sapien. 
                                In ante. Proin aliquam odio ut sem. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Consequat dignissim, 
                                luctus blandit, sapien. In ante. Proin aliquam odio ut sem consequat dignissim, luctus blandit, sapien. 
                                In ante. Proin aliquam odio ut sem. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                <p><img class="right" src="img/small-img2.jpg" width="200" height="150" alt="demo-pic"> <strong>A right 
                                aligned image</strong>. Lorem ipsum dolor sit amet, 
                                consectetuer adipiscing elit. Sed viverra tortor non dolor. Donec nulla libero, ullamcorper sed, consequat 
                                dignissim, luctus blandit, sapien. 
                                In ante. Proin aliquam odio ut sem. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                <p><a href="#"><img class="left" src="img/small-img1.jpg" width="200" height="150" alt="demo-pic"></a> <strong>A left 
                                aligned, linked image</strong>. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed viverra tortor 
                                non dolor. Donec nulla libero, ullamcorper sed, consequat dignissim, luctus 
                                blandit, sapien. In ante. Proin aliquam odio ut sem. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </p>
								 
                </div><!--end of grid-10--> 
			</div><!--end of grids-->
           
		<hr>     
	</div><!--end of wrapper-->
    
<!--===============================================================  Bottom content =====================================================================================-->     
		
	<?php include 'bottomcontent2.php'; ?>	
        
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
                        
			 <script type="text/javascript">  <!--Javascript for Tabs by Sohtanaka, include it on pages where you use tabs, else delete it-->                                    
				 $(document).ready(function() {
							
					 //When page loads...
					 $(".tab_content").hide(); //Hide all content
					 $("ul.tabs li:first").addClass("active").show(); //Activate first tab
					 $(".tab_content:first").show(); //Show first tab content
					
					 //On Click Event
					 $("ul.tabs li").click(function() {
					
					  $("ul.tabs li").removeClass("active"); //Remove any "active" class
					  $(this).addClass("active"); //Add "active" class to selected tab
					  $(".tab_content").hide(); //Hide all tab content
					
					  var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
					  $(activeTab).fadeIn(); //Fade in the active ID content
					  return false;
					 });
					
					});
			</script>
<?php } else { // ************************************* NOT logged in ******************************************************
header('Location: index.php');
exit();
}
?>
</body>
</html>