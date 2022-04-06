<?php
	/*		Includes file for cortlandcollegehousing.com
			writen by John Cowan
			Date:	Sept 2012
	*/


################################################################################
##
## database connection strings
## 
/*
From website: http://lotsofphp.com/tutorials/pear-package-db.html

Manual Installation:
To install the package manually, let's put the package in /includes/
Use the following code to tell PHP where to look for our package:

ini_set("include_path", '/var/www/www.example.com/includes/' . PATH_SEPARATOR . ini_get("include_path"));
Now we have set our include_path, we can simply require our package like this:
require_once 'DB.php';

*/

ini_set("include_path", '/home/corthou/public_html/includes/' . ':' . ini_get("include_path"));

require_once 'DB.php';
$db 		= "corthou_suites";
$host 		= "localhost";
$username 	= "corthou_webuser";
$password 	= "NY's#1:-)F@n";

  // Data Source Name: This is the universal connection string
$dsn = "mysql://$username:$password@$host/$db";
	
  // DB::connect will return a Pear DB object on success
  // or a Pear DB Error object on error
  // You can also set to TRUE the second param
  // if you want a persistent connection:
  // $db = DB::connect($dsn, true);
$globalMySqlConnect = DB::connect($dsn);
  // With DB::isError you can differentiate between an error or
  // a valid connection.
if ( DB::isError( $db ) ) {
	die ( $db->getMessage() );
}
// alter connection to mysql
// using above db variables.

	// connect to mysql
$connection = mysql_connect( $host, $username, $password ) or die ( mysql_error());
	// connect to the database in mysql
mysql_select_db($db) or die ( mysql_error() );

// set the path to the graphics folder when we are in the admins folder
$path = "";
if( preg_match( '/\/ccAdmins\//', $_SERVER['PHP_SELF']) ){
	$path="../";
}else{
	$path="";
}

######   show some errors on the page if we can      
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);



function printHeaders($params){
?>
 
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <!--
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-T5SXZ5H6D0"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-T5SXZ5H6D0');
      </script>
      -->

      <!-- Global site tag (gtag.js) - Google Analytics -->
      <!-- new tag added march 22, 2022                 -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-0Z3CECKQV0"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-0Z3CECKQV0');
      </script>

     	 <meta charset="utf-8" />
	     <meta http-equiv="x-ua-compatible" content="ie=edge">
	     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	     <title>
	         <?php print isset($params['pageTitle']) ? $params['pageTitle'] : "Cortland College Housing"; ?>
	     </title>
	     <meta name="description" content="<?php print $params['description'] ?>">
	     <meta name="keywords" content="<?php print $params['keywords'] ?>">
         
	     <!-- css code -->
     
     <link rel="stylesheet" href="http://www.cortlandcollegehousing.com/includes/css/foundation.css" type="text/css" />
     <link rel="stylesheet" href="http://www.cortlandcollegehousing.com/includes/css/app.css" type="text/css" />
     <link rel="stylesheet" href="http://www.cortlandcollegehousing.com/includes/main.css" type="text/css" />

     <!-- slick banner css -->
     <link rel="stylesheet" href="http://www.cortlandcollegehousing.com/includes/slick-master/slick/slick.css" />
     <link rel="stylesheet" href="http://www.cortlandcollegehousing.com/includes/slick-master/slick/slick-theme.css" />
     <!-- end slick css -->
     <!-- end  css code -->

     <!-- foundation js code -->
     <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
     <script type="text/javascript" src="http://www.cortlandcollegehousing.com/includes/js/vendor/jquery.js"></script>
     <script type="text/javascript" src="http://www.cortlandcollegehousing.com/includes/ckeditor/ckeditor.js"></script>
     <script type="text/javascript" src="http://www.cortlandcollegehousing.com/includes/slick-master/slick/slick.min.js"></script>

   </head>
        
        <!--  bgcolor="#F9F582" -->
        <body>
         <div id="body-container">
        <?php       
        printBanner();
        printTopNavs();
} # end printHeaders()
?>

<?php
function printTopNavs(){
	global $path;
	/*  if foundation 6 gets the active class working, we are ready                 */
	$home_active     = preg_match('/index/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$about_active    = preg_match('/about/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$locations_active = preg_match('/apartment-locations/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$describe_active   = preg_match('/apartment-descriptions/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$floorplan_active   = preg_match('/apartment-floorplans/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$application_active = preg_match('/apartment-application/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$lease_active   = preg_match('/lease/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$docs_active   = preg_match('/documents/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$contact_active  = preg_match('/contact-us/', $_SERVER['PHP_SELF']) ? 'active' : '';
  ?>

  <!-- accessibility role for navs -->
  <div class="row" role="navigation" aria-label="Top row navigation">
     <div class="medium-12 columns menu-centered full-width">
  
       <ul class="vertical medium-horizontal menu" style="list-style-type: none;">
           <li class="<?php print $home_active ?>"><a href="<?php print $path ?>index.html">Home</a></li>
           <li class="<?php print $about_active ?>"><a href="<?php print $path ?>about-cornerstone-properties.html" title="student housing Cortland NY">About Us</a></li>
           <li class="<?php print $describe_active ?>"><a href="<?php print $path ?>apartment-descriptions.html" title="student housing near Cortland College">Apartment Descriptions</a></li>
           <li class="<?php print $floorplan_active ?>"><a href="<?php print $path ?>apartment-floorplans.html" title="off-campus student housing Cortland NY">FloorPlans</a></li>
           <li class="<?php print $locations_active ?>"><a href="<?php print $path ?>apartment-locations.html" title="off-campus student housing near SUNY Cortland">Locations</a></li>
           <li class="<?php print $application_active ?>"><a href="<?php print $path ?>apartment-application.html" title="off-campus student housing near Cortland College">Application</a></li>
           <li class="<?php print $docs_active ?>"><a href="<?php print $path ?>documents.html" title="off-campus housing Cortland NY">Important Documents</a></li>
           <li class="<?php print $contact_active ?>"><a href="<?php print $path ?>contact-us.html" title="off-campus housing near SUNY Cortland">Contact Us</a></li>
        </ul>
      </div>
  </div> <!-- role=navigation -->

  <?php
}

function printBanner(){
	global $path;
  ?>
  <header role="banner"> <!-- aria accessibility -->

  <!-- text at the very top of page (all pages) -->
  <div class="row border-top-red">
    <div class="medium-12 columns text-center" style="font-size: 3em; color: #b31b1b; font-family: Georgia, Arial, Serif;">
     CORNERSTONE PROPERTIES
     </div>
  </div>
  <div class="row">
    <div class="medium-12 columns text-center" style="font-size:2em; color:#000;">
      Off-Campus Student Housing in Cortland, NY
    </div>
  </div>
  <div class="row">
    <div class="medium-1 column">&nbsp;</div>
    <div class="medium-5 columns text-left" style="font-size:1.5em; color:#b31b1b;">All-Inclusive Luxury Apartments</div>
    <div class="medium-5 columns text-right" style="font-size:1.5em; color:#b31b1b;">(607) 756-2921</div>
    <div class="medium-1 column">&nbsp;</div>
  </div>

   <!-- the sliding images -->
   <div class="row bg-white border-top-red">
	    <div class="medium-1">&nbsp;</div>
      <div class="medium-10 medium-centered columns">
        
        <div class="single-item">
          <div class="multiple">
  		      <img src="<?php print $path ?>images/off-campus-student-housing/cortland-ny/banner-images/7-woodruff-street-exterior-front-view-575.jpg" 
            alt="apartment 7 woodruff str cortland ny" title="off-campus student housing cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/off-campus-student-housing/cortland-ny/banner-images/100-tompkins-street-exterior-front-view-575.jpg" 
            alt="apartment 100 Tompkins str cortland ny" title="off-campus student housing cortland college" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/off-campus-student-housing/cortland-ny/banner-images/50-tompkins-street-exterior-front-view-575.jpg" 
            alt="apartment 50 Tompkins str cortland ny" title="off-campus housing cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/off-campus-student-housing/cortland-ny/banner-images/112-groton-ave-exterior-front-view-575.jpg" 
            alt="apartment 112 Groton Ave cortland ny" title="student housing cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/off-campus-student-housing/cortland-ny/banner-images/50-tompkins-street-exterior-street-view-575.jpg" 
            alt="apartment 50 Tompkins str cortland ny" title="off-campus student housing rental cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/off-campus-student-housing/cortland-ny/banner-images/52-tompkins-street-exterior-front-view-575.jpg" 
            alt="apartment 52 Tompkins str cortland ny" title="rentals off-campus student housing cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/off-campus-student-housing/cortland-ny/banner-images/91-lincoln-ave-exterior-front-view-575.jpg" 
            alt="apartment 91 lincoln cortland ny" title="off-campus student housing cortland" />
          </div>
        </div> <!-- single-item -->

      </div> <!-- medium-10 -->
      <div class="medium-1">&nbsp;</div>

   </div> <!-- row bg-white -->

   <!-- call to action row above top navs -->
   <div class="row full-width" style="font-size: 1.5em; 
                           color: #fff; 
                           background-color: #b31b1b;
                           font-family: Georgia, Arial, Serif;
                           margin: auto;">
    <div class="medium-1 columns text-center">&nbsp;</div>
    <div class="medium-4 columns text-center">
     Reserve Your Place Today!
     </div>
     <div class="medium-2 columns text-center">&nbsp;</div>
     <div class="medium-3 columns text-center">
     Call (607) 756-2921
     </div>
     <div class="medium-2 columns text-center">&nbsp;</div>
  </div>

  </header>
   <?php
}


function getNews($page){
  global $globalMySqlConnect;
  ?>
  <div class="row" role="alert">
    <div class="medium-12 columns callout alert text-center">
        <h2>Apartment News!</h2>
        <?php
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
          if(!empty($data['location_page']) && $page=='apartment-locations.html'){
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
        ?>
    </div>
  </div>
    
    <?php 
}

// record when someone comes to the site.  Should add this to Google Analytics 
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
	  ?>
	  <div class="row">
	    <div class="medium-12 columns callout alert text-center">
		  <p><?php print $data['cnt_hits'] ?> visitors to this site!</p>
		</div>
	  <div>
	  <?php
	} 
}


function printFooter(){
?>
  <!-- accessibility role -->
  <footer role="contentinfo">

    <div class="row">          
        <div class="medium-12 columns text-center">
          <hr style="width: 60%; color: #b31b1b;" />
        </div>        
    </div>

  	<div class="row">          
		    <div class="medium-12 columns text-center bg-white"> 
		        <p>Call us today for more information:<br />
		        607.756.2921<br />
		        <a href="contact-us.html">info@CortlandCollegeHousing.com</a><br /><br />
		        <a href="https://www.facebook.com/Cornerstone-Properties-Cortland-138759469505509/">
              <img src="images/off-campus-student-housing/cortland-ny/Logos/Facebook/facebook-f.gif" alt="facebook" />Visit our Facebook page for additional apartment photos!</a><br /><br /  

            <a href="https://www.instagram.com/propertiesbycornerstone/">
              <img src="images/off-campus-student-housing/cortland-ny/Logos/Instagram/instagram-30x30.gif" alt="the Instagram icon" title="follow us on instagram" />Follow Us On Instagram!</a>           
		    </div>        
		  </div> <!-- row -->

    </footer>

		</div><!-- body-container -->
		
		<!-- scripts that Foundation needs.  Must be placed here. -->
		<!-- foundation code -->
    <script src="http://www.cortlandcollegehousing.com/includes/js/vendor/jquery.js"></script>
    <script src="http://www.cortlandcollegehousing.com/includes/js/vendor/what-input.js"></script>
    <script src="http://www.cortlandcollegehousing.com/includes/js/vendor/foundation.js"></script>
    <script src="http://www.cortlandcollegehousing.com/includes/js/app.js"></script>
		<script>
      var $jq = jQuery.noConflict();
      $jq(document).ready( function(){
        //$jq(document).foundation();
        $('.single-item').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          speed: 300,
          dots: false,
          autoplay: true,
          infinite: true
        });
      })
    </script>
		
		
	</body></html>
<?php
}
?>

<?php
// Let the web guy know there was a database error 
function errorEmail($arrayIn){
    $to      = 'john@johndcowan.com';
    $cc      = 'mikereeners@hotmail.com';
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
    John Cowan and Mike Reeners have both been emailed about this.
    Page: $arrayIn[0]
    Error: $arrayIn[1]
    Error: $arrayIn[2]
END;
mail($to, $subject, $message, $headers);
}
?>



