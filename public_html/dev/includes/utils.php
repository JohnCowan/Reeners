<?php
;

// set the path to the graphics folder when we are in the admins folder
$path = "";
if( preg_match( '/\/ccAdmins\//', $_SERVER['PHP_SELF']) ){
		$path="../";
	}else{
		$path="";
	}
	
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);
	ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
	error_reporting(E_ALL);

function printHeaders($params){
	global $path;
?>
 
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	   <html>
	   <head>
			<script>
			if (matchMedia && window.matchMedia('(min-device-width: 320px) and (max-device-width: 480px)').matches) {
			    document.cookie = 'small=1; path=/';
			}
			</script>
			<?php
			  $width="foo";
				if (isset($_COOKIE['small'])) {
				  $width="small";
				} else {
				  $width="large";
				}
				print "<p>Width is $width";
			?>
	   <meta http-equiv="Content-Type" content="text/html; charset=UTF8" />
	   <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1" />
		<title><?php print isset($params['pageTitle'])?$params['pageTitle']:"Cortland College Housing"; ?></title>
		<meta name="description" content="<?php print $params['description'] ?>">
		<meta name="keywords" content="<?php print $params['keywords'] ?>">	
		
     <!--  Media Queries for screen widths  -->
    
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		<script src="http://www.cortlandcollegehousing.com/includes/jquery.cycle.all.latest.js" type="text/javascript" charset="utf-8"></script>		
		<script type="text/javascript" src="<?php print $path; ?>includes/fckeditor/fckeditor.js"></script>
		<script type="text/javascript"> 
		$(document).ready(function() {
		    $('.slideshow').cycle({
				fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
			});
		});
		</script>
		
	</head>
	<!--  bgcolor="#F9F582" -->
	<body>
		<div id="banner"></div>
		<div id="header" class="slideshow">
				<?php
				if( isset($width) ){ print "<p>the screen_width is: $width</p>"; }
				if( isset($width) && $width <= 720 ){
					  ?>
					  <img src="<?php print $path ?>graphics/112-groton-300.jpg" width="300" height="96" />
						<img src="<?php print $path ?>graphics/50-tompkins-300.jpg" width="300" height="96" />
						<img src="<?php print $path ?>graphics/52-tompkins-300.jpg" width="300" height="96" />
					  <?php
				} else if( isset($width) && $width > 720 && $width <= 1200 ){
					  ?>
					  <img src="<?php print $path ?>graphics/112-groton-490.jpg" width="490" height="156" />
						<img src="<?php print $path ?>graphics/50-tompkins-490.jpg" width="490" height="156" />
						<img src="<?php print $path ?>graphics/52-tompkins-490.jpg" width="490" height="156" />
					  <?php
				} else {
						?>
						<img src="<?php print $path ?>graphics/112-groton-920.jpg" width="920" height="293" />
						<img src="<?php print $path ?>graphics/50-tompkins-920.jpg" width="920" height="293" />
						<img src="<?php print $path ?>graphics/52-tompkins-920.jpg" width="920" height="293" />
						<?php
			  }			  
			  ?>	      
		</div>
		
    <div id="body-container">	  
		  <div id="topNavs">
		    <?php printNavs(); ?>
		  </div>
<?php
}

function printNavs(){ 
	global $path;
  ?>
  <a href="index.html">Home</a>
  <a href="<?php print $path ?>apartment-descriptions.html">Descriptions</a>
	<a href="<?php print $path ?>floorplans.html">Floorplans</a>
	<a href="<?php print $path ?>locations.html">Locations</a>
	<a href="<?php print $path ?>request-application.html">Application</a>
	<a href="<?php print $path ?>lease.html">Our Lease</a>
	<a href="<?php print $path ?>contact-us.html">Contact Us</a>
	<a href="http://www.facebook.com/home.php#!/pages/Cortland-NY/Cornerstone-Properties-Cortland/138759469505509"><img src="graphics/facebook-f.gif" alt="facebook" /></a>
	<?php
}

function printHeader($header){
   ?>
   <div class="header">
        <?php print $header ?>
   </div>
   <?php
}

function printSubHeader($header){
   ?>
   <div class="header">
        <?php print $header ?>
   </div>
   <?php
}


function logHits($item){
   global $globalMySqlConnect;
  
   $item = strtoupper($item);
   $today = date('Y-m-d',time());
   $referrer = !empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'NONE';
   $item = !empty($item) ? $item : 'Not Sent';   
    $sql = "insert into hits 
	              ( page_hit, referrer, date_hit )
	          values
	              ( ?, ?, ? )";
    $sqlParams = array( $item, $referrer, $today );
    $result = $globalMySqlConnect->query($sql, $sqlParams);
    if(DB::isError( $result )){
	    die("Problem inserting into hits " .$result->toString());
    }
}

function getHits(){
	global $globalMySqlConnect;
	$sql="select count(*) as cnt_hits from hits where page_hit = upper(?)";
	$result=$globalMySqlConnect->query($sql, array('HOME-PAGE'));
	if(DB::isError( $result )){
    die("Problem inserting into hits " .$result->toString());
		errorEmail(array($page,$result->toString(), $result->toString()));
  }
	if($data=$result->fetchRow(DB_FETCHMODE_ASSOC)){
		return $data['cnt_hits'];
	}
	return 'N/A';
}

function getNews($page){
  global $globalMySqlConnect;
  
  print "<div id='news'>";

  $sql="select * from news";
  $results = $globalMySqlConnect->query($sql);
  if(DB::isError($results)){
     die("cannot get news. ".$results->toString());
  }
  while($data=$results->fetchRow(DB_FETCHMODE_ASSOC)){
      if(!empty($data['home_page']) && $page=='index.html'){
          print $data['content'];
      }
      if(!empty($data['description_page']) && $page=='apartment-description.html'){
          print $data['content'];
      }
      if(!empty($data['floorplans_page']) && $page=='floorplans.html'){
          print $data['content'];
      }
      if(!empty($data['location_page']) && $page=='locations.html'){
          print $data['content'];
      }
      if(!empty($data['request_page']) && $page=='request-application.html'){
          print $data['content'];
      }
      if(!empty($data['lease_page']) && $page=='lease.html'){
          print $data['content'];
      }
      if(!empty($data['contact_page']) && $page=='contact-us.html'){
          print $data['content'];
      }
  }
print '</div>';
  
}

function errorEmail($arrayIn){
    $to      = 'john@johndcowan.com';
    $cc      = 'john@johndcowan.com';
    $from    = "infor@cortlandcollegehousing.com";    
    $subject = "Error on Website";

    $headers  = "To: John Cowan <$to>\r\n";
    $headers .= "CC: Webmaster: <$cc>\r\n";
    $headers .= "From: 'Cortland College Housing' <$from>\r\n";
    $headers .= "Reply-To: 'CornerStone Properties' <$from>\r\n";
    $headers .= "Return-Path: $from\r\n";

    $today = date('m/d/Y', time());
$message = <<<END
    There was a problem on the following web page.  An error occured.
    Page: $arrayIn[0]
    Error: $arrayIn[1]
    Error: $arrayIn[2]
END;
mail($to, $subject, $message, $headers);
}


function printFooter(){
?>
   
  <div id="footer">
	 <p>Call us today for more information:<br />
	 607.756.2921<br />
	 <a href="contact-us.html">info@CortlandCollegeHousing.com</a><br /><br />
	<a href="http://www.facebook.com/home.php#!/pages/Cortland-NY/Cornerstone-Properties-Cortland/138759469505509"><img src="graphics/facebook-f.gif" alt="facebook" /> Like our Facebook today!</a></p>
   </div>
	
	</div><!-- header -->
	</body></html>
<?php
}
?>

