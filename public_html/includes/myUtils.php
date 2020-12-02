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
  <html>
    <head>
     	 <meta charset="utf-8" />
	     <meta http-equiv="x-ua-compatible" content="ie=edge">
	     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	     <title>
	         <?php print isset($params['pageTitle']) ? $params['pageTitle'] : "Cortland College Housing"; ?>
	     </title>
	     <meta name="description" content="<?php print $params['description'] ?>">
	     <meta name="keywords" content="<?php print $params['keywords'] ?>">
         
	     <!-- foundation css code -->
     <link rel="stylesheet" href="http://www.cortlandcollegehousing.com/includes/main.css" type="text/css">
     <link rel="stylesheet" href="http://www.cortlandcollegehousing.com/includes/css/foundation.css" type="text/css">
     <link rel="stylesheet" href="http://www.cortlandcollegehousing.com/includes/css/app.css" type="text/css">
     <!-- end foundation css code -->

     <!-- foundation js code -->
     <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
     <script type="text/javascript" src="http://www.cortlandcollegehousing.com/includes/js/vendor/jquery.js"></script>
     <script type="text/javascript" src="http://www.cortlandcollegehousing.com/includes/ckeditor/ckeditor.js"></script>
 
	     <script src="https://malsup.github.com/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script> 
 
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
	$floorplan_active   = preg_match('/floorplans/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$application_active = preg_match('/request-application/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$lease_active   = preg_match('/lease/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$docs_active   = preg_match('/documents/', $_SERVER['PHP_SELF']) ? 'active' : '';
	$contact_active  = preg_match('/contact-us/', $_SERVER['PHP_SELF']) ? 'active' : '';
  ?>
    <div class="row">
       <div class="medium-12 columns menu-centered full-width">
    
         <ul class="vertical medium-horizontal menu" style="list-style-type: none;">
             <li class="<?php print $home_active ?>"><a href="<?php print $path ?>index.html">Home</a></li>
             <li class="<?php print $about_active ?>"><a href="<?php print $path ?>about-cornerstone-properties.html">About Us</a></li>
             <li class="<?php print $describe_active ?>"><a href="<?php print $path ?>apartment-descriptions.html">Apartment Descriptions</a></li>
             <li class="<?php print $floorplan_active ?>"><a href="<?php print $path ?>floorplans.html">FloorPlans</a></li>
             <li class="<?php print $locations_active ?>"><a href="<?php print $path ?>apartment-locations.html">Locations</a></li>
             <li class="<?php print $application_active ?>"><a href="<?php print $path ?>request-application.html">Application</a></li>
             <li class="<?php print $docs_active ?>"><a href="<?php print $path ?>documents.html">Important Documents</a></li>
             <li class="<?php print $contact_active ?>"><a href="<?php print $path ?>contact-us.html">Contact Us</a></li>
          </ul>
      </div>
    </div>
  <?php
}

function printBanner(){
	global $path;
  ?>

   <div class="row">
	    <div class="medium-2">&nbsp;</div>
      <div class="medium-8 medium-centered text-center columns"><img src="graphics/cornerstone-properties.gif" /></div>
      <div class="medium-2">&nbsp;</div>
   </div>
   <div class="row bg-white border-bottom-red border-top-red">
	    <div class="medium-1">&nbsp;</div>
      <div class="medium-10 medium-centered columns">
		    <img src="<?php print $path ?>graphics/50-tompkins-920.jpg" />
      </div>
      <div class="medium-1">&nbsp;</div>
   </div>
   <?php
}


function getNews($page){
  global $globalMySqlConnect;
  ?>
  <div class="row">
    <div class="medium-12 columns callout alert text-center">
        <h3>Apartment News!</h3>
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
  	<div class="row">          
		    <div class="medium-12 columns text-center bg-white"> 
		        <p>Call us today for more information:<br />
		        607.756.2921<br />
		        <a href="contact-us.html">info@CortlandCollegeHousing.com</a><br /><br />
		        <a href="https://www.facebook.com/Cornerstone-Properties-Cortland-138759469505509/"><img src="graphics/facebook-f.gif" alt="facebook" />Visit our Facebook page for additional apartment photos!</a><br /><br />
            <a href="https://www.instagram.com/propertiesbycornerstone/">Follow us on Instagram</a></p>               
		    </div>        
		  </div> <!-- row -->

		</div><!-- body-container -->
		
		<!-- scripts that Foundation needs.  Must be placed here. -->
		<!-- foundation code -->
    <script src="http://www.cortlandcollegehousing.com/includes/js/vendor/jquery.js"></script>
    <script src="http://www.cortlandcollegehousing.com/includes/js/vendor/what-input.js"></script>
    <script src="http://www.cortlandcollegehousing.com/includes/js/vendor/foundation.js"></script>
    <script src="http://www.cortlandcollegehousing.com/includes/js/app.js"></script>
		<script>
      $(document).ready(funccortlandcollegehousin
        $(document).foundation();
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



