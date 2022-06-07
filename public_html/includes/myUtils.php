<?php
  /*    Includes file for cortlandcollegehousing.com
      writen by John Cowan
      Date: Sept 2012
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
$db     = "corthou_suites";
$host     = "localhost";
$username   = "corthou_webuser";
$password   = "NY's#1:-)F@n";

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
}else if( preg_match( '/\/cortland-ny\/suny-cortland\/off-campus-student-housing\/apartments\//', $_SERVER['PHP_SELF']) ){ 
  $path="../../../../";
}else if( preg_match( '/\/cortland-ny\/suny-cortland\/off-campus-student-housing\//', $_SERVER['PHP_SELF']) ){ 
  $path="../../../";
}else{
  $path="";
}

######   show some errors on the page if we can      
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);



function printHeaders($params){
  global $path;
?>
 
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
       <!-- don't need this anymore? <meta http-equiv="x-ua-compatible" content="ie=edge"> -->
       <meta name="viewport" content="width=device-width, initial-scale=1.0" />
       <title><?php print getPageTitle($params['title']); ?></title>

       <!-- favicon icon -->
       <link rel="shortcut icon" type="image/jpg" href="<?= $path ?>images/cortland-ny/suny-cortland/off-campus-student-housing/Logos/favicon.ico" />

       <!-- canonical tag to site home page -->
       <link rel=“canonical” href=“https://www.cortlandcollegehousing.com/index.html” />

       <meta name="description" content="<?php print $params['description'] ?>">
       <meta name="keywords" content="<?php print $params['keywords'] ?>">

       <meta property="og:title" content="social media sharing buttons php onlinecode.org"/>
       <meta property="og:image" content="<?php print $path; ?>images/cortland-ny/suny-cortland/off-campus-student-housing/Logos/Facebook/facebook-f.gif"/>
       <meta property="og:url" content="onlinecode.org"/>
       <meta property="og:description" content="social media sharing buttons php onlinecode.org"/>
         
       <!-- css code -->
     
     <link rel="stylesheet" href="https://www.cortlandcollegehousing.com/includes/css/foundation.css" type="text/css" />
     
     <link rel="stylesheet" href="https://www.cortlandcollegehousing.com/includes/main.css" type="text/css" />

     <!-- slick banner css -->
     <link rel="stylesheet" href="https://www.cortlandcollegehousing.com/includes/slick-master/slick/slick.css" />
     <link rel="stylesheet" href="https://www.cortlandcollegehousing.com/includes/slick-master/slick/slick-theme.css" />
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" />
     <!-- end slick css -->
     <!-- end  css code -->

     <!-- foundation js code -->
     <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
     <script type="text/javascript" src="https://www.cortlandcollegehousing.com/includes/js/vendor/jquery.js"></script>
     <script type="text/javascript" src="https://www.cortlandcollegehousing.com/includes/ckeditor/ckeditor.js"></script>
     <script type="text/javascript" src="https://www.cortlandcollegehousing.com/includes/slick-master/slick/slick.min.js"></script>
     <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

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
function getPageTitle($title) {
  if( !empty($title) ){
    return $title;
  }
  if( !empty($_SERVER['PHP_SELF']) ) {
    # home page:
    if( preg_match('/^\/index/', $_SERVER['PHP_SELF']) )
      {return 'Best SUNY Cortland off campus housing in Cortland NY';}

    if( preg_match('/about/', $_SERVER['PHP_SELF']) )
      {return 'About Cornerstone Properties Off Campus Housing Rentals';}

    if( preg_match('/contact-us/', $_SERVER['PHP_SELF']) )
      {return 'Contact Information for Cornerstone Properties';}

    if( preg_match('/apartment-descriptions/', $_SERVER['PHP_SELF']) )
      {return 'Student Apartment Descriptions Cortland College Housing';}

    if( preg_match('/apartment-locations/', $_SERVER['PHP_SELF']) )
      {return 'SUNY Cortland Off Campus Student Housing Locations';}

    if( preg_match('/apartment-floorplans/', $_SERVER['PHP_SELF']) )
      {return 'Floor Plans of Student Apartments in Cortland NY';}

    if( preg_match('/apartment-rental-application/', $_SERVER['PHP_SELF']) )
      {return 'Student Apartment Rental Application for Cortland, NY';}

    if( preg_match('/documents/', $_SERVER['PHP_SELF']) )
      {return 'Lease and Student Rental Guarantee Agreement Documents';}

    if( preg_match('/apartments\/index/', $_SERVER['PHP_SELF']) )
      {return 'SUNY Cortland Student Apartment Locations';}

    if( preg_match('/apartments\/50-tompkins-str/', $_SERVER['PHP_SELF']) )
      {return '50 Tompkins Str Cortland Ny | Luxury student apartments';}

    if( preg_match('/apartments\/52-tompkins-str/', $_SERVER['PHP_SELF']) )
      {return '52 Tompkins Str Cortland NY | SUNY Cortland Housing';}

    if( preg_match('/apartments\/100-tompkins-str/', $_SERVER['PHP_SELF']) )
      {return '100 Tompkins Str Cortland NY | Student Apartments';}

    if( preg_match('/apartments\/112-groton-ave/', $_SERVER['PHP_SELF']) )
      {return '112 Groton Ave Cortland NY | Housing Near SUNY Cortland';}

    if( preg_match('/apartments\/7-woodruff-str/', $_SERVER['PHP_SELF']) )
      {return '7 Woodruff Str Cortland Ny | off campus student housing';}

    if( preg_match('/apartments\/91-lincoln-ave/', $_SERVER['PHP_SELF']) )
      {return '91 Lincoln Ave Cortland NY | College Apartments';}
  }
}

?>

<?php
  ### TOP MENU NAVS ###
  #
function printTopNavs(){
  global $path;

  ### variables to help show which link is currently active
  #
  /*  if foundation 6 gets the active class working, we are ready                 */
  $home_active     = preg_match('/^\/index/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $about_active    = preg_match('/about/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $locations_active = preg_match('/apartment-locations/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $describe_active   = preg_match('/apartment-descriptions/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $floorplan_active   = preg_match('/apartment-floorplans/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $application_active = preg_match('/apartment-rental-application/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $lease_active   = preg_match('/lease/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $docs_active   = preg_match('/documents/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $contact_active  = preg_match('/contact-us/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $apartments_active  = preg_match('/apartments/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $tompkins_50_active  = preg_match('/apartments\/50-tompkins-str/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $tompkins_52_active  = preg_match('/apartments\/52-tompkins-str/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $tompkins_100_active  = preg_match('/apartments\/100-tompkins-str/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $groton_active  = preg_match('/apartments\/112-groton-ave/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $woodruff_active  = preg_match('/apartments\/7-woodruff-str/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $lincoln_active  = preg_match('/apartments\/91-lincoln-ave/', $_SERVER['PHP_SELF']) ? 'active' : '';
  ?>

  <!-- accessibility role for navs -->
  <div class="row" role="navigation" aria-label="Top row navigation" title="cortland properties">
     <div class="medium-12 columns menu-centered full-width">
  
       <ul class="dropdown menu" data-dropdown-menu style="list-style-type: none;">
           <li class="<?php print $home_active ?>"><a href="<?php print $path ?>index.html">Home</a></li>

           <li class="<?php print $about_active ?>"><a href="<?php print $path ?>about-cornerstone-properties.html" title="student housing cortland ny">About Us</a></li>

           <li class="<?php print $apartments_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartments/index.html" title="off-campus housing suny cortland">Apartments</a>

              <ul class="data-dropdown-menu">
                 <li class="<?php print $tompkins_50_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartments/50-tompkins-str.html">50 Tompkins Str</a></li>
                 <li class="<?php print $tompkins_52_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartments/52-tompkins-str.html">52 Tompkins Str</a></li>
                 <li class="<?php print $tompkins_100_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartments/100-tompkins-str.html">100 Tompkins Str</a></li>
                 <li class="<?php print $groton_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartments/112-groton-ave.html">112 Groton Ave</a></li>
                 <li class="<?php print $woodruff_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartments/7-woodruff-str.html">7 Woodruff Str</a></li>
                 <li class="<?php print $lincoln_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartments/91-lincoln-ave.html">91 Lincoln Ave</a></li>
              </ul>

           </li>

           <li class="<?php print $describe_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartment-descriptions.html" title="off-campus student housing cortland">Descriptions</a></li>

           <li class="<?php print $floorplan_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartment-floorplans.html" title="suny cortland student housing">FloorPlans</a></li>

           <li class="<?php print $locations_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartment-locations.html" title="cortland student housing off campus">Locations</a></li>

           <li class="<?php print $application_active ?>"><a href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartment-rental-application.html" title="suny cortland off-campus housing">Application</a></li>

           <li class="<?php print $docs_active ?>"><a href="<?php print $path ?>documents.html" title="college off-campus student housing cortland">Important Documents</a></li>

           <li class="<?php print $contact_active ?>"><a href="<?php print $path ?>contact-us.html" title="cortland college rentals">Contact Us</a></li>
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
  
  <!-- mobile small screens -->
  <div class="row border-top-red mobile-screen">
    <div class="medium-12 small-12 columns text-center" 
         style="font-size: 1.3em; color: 
         #b31b1b; font-family: Georgia, Arial, Serif;">
     CORNERSTONE PROPERTIES
     </div>
  </div>
  <div class="row mobile-screen">
    <div class="medium-12 small-12 columns text-center" style="font-size:1.1em; color:#000;">
      Off-Campus Student Housing
      <br />Cortland, NY
    </div>
  </div>
  <div class="row mobile-screen">
    <div class="medium-12 small-12 columns text-center" 
         style="font-size:1.5em; color:#b31b1b;">All-Inclusive Luxury Apartments
    </div>
  </div>


  <!-- large screens -->
  <div class="row border-top-red large-screen">
    <div class="medium-12 small-12 columns text-center" 
         style="font-size: 3em; color: 
         #b31b1b; font-family: Georgia, Arial, Serif;">
     CORNERSTONE PROPERTIES
     </div>
  </div>
  <div class="row large-screen">
    <div class="medium-12 small-12 columns text-center" style="font-size:2em; color:#000;">
      Off-Campus Student Housing in Cortland, NY
    </div>
  </div>
  <div class="row large-screen">
    <div class="medium-1 small-1 column">&nbsp;</div>
    <div class="medium-5 small-5 columns text-left" 
         style="font-size:1.5em; color:#b31b1b;">All-Inclusive Luxury Apartments</div>
    <div class="medium-5 small-5 columns text-right" style="font-size:1.5em; color:#b31b1b;">(607) 756-2921</div>
    <div class="medium-1 small-1 column">&nbsp;</div>
  </div>

   <!-- the sliding images -->
   <div class="row bg-white border-top-red large-screen">
      <div class="medium-1">&nbsp;</div>
      <div class="medium-10 medium-centered columns">
        
        <div class="single-item">
          <div class="multiple">
            <img src="<?php print $path ?>images/cortland-ny/suny-cortland/off-campus-student-housing/banner-images/7-woodruff-street-exterior-front-view-575.jpg" 
            alt="apartment 7 woodruff str cortland ny" title="off campus student housing suny cortland" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/cortland-ny/suny-cortland/off-campus-student-housing/banner-images/100-tompkins-street-exterior-front-view-575.jpg" 
            alt="apartment 100 Tompkins str cortland ny" title="student housing suny cortland" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/cortland-ny/suny-cortland/off-campus-student-housing/banner-images/50-tompkins-street-exterior-front-view-575.jpg" 
            alt="apartment 50 Tompkins str cortland ny" title="cortland off campus housing" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/cortland-ny/suny-cortland/off-campus-student-housing/banner-images/112-groton-ave-exterior-front-view-575.jpg" 
            alt="apartment 112 Groton Ave cortland ny" title="cortland college student housing" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/cortland-ny/suny-cortland/off-campus-student-housing/banner-images/50-tompkins-street-exterior-street-view-575.jpg" 
            alt="apartment 50 Tompkins str cortland ny" title="suny cortland off campus properties" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/cortland-ny/suny-cortland/off-campus-student-housing/banner-images/52-tompkins-street-exterior-front-view-575.jpg" 
            alt="apartment 52 Tompkins str cortland ny" title="college rentals cortland" />
          </div>
          <div class="multiple">
            <img src="<?php print $path ?>images/cortland-ny/suny-cortland/off-campus-student-housing/banner-images/91-lincoln-ave-exterior-front-view-575.jpg" 
            alt="apartment 91 lincoln cortland ny" title="suny cortland college rentals" />
          </div>
        </div> <!-- single-item -->

      </div> <!-- medium-10 -->
      <div class="medium-1">&nbsp;</div>

   </div> <!-- row bg-white -->

   <!-- call to action row above top navs -->

   <!-- large screens -->
   <div class="row full-width large-screen" style="font-size: 1.5em; 
                           color: #fff; 
                           background-color: #b31b1b;
                           font-family: Georgia, Arial, Serif;">
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

   <!-- mobile screens -->
   <div class="row full-width mobile-screen" style="font-size: 1.2em; 
                           color: #fff; 
                           background-color: #b31b1b;
                           font-family: Georgia, Arial, Serif;">
    <div class="small-12 columns text-center">
     Reserve Your Place Today!
     </div>
   </div>
    <div class="row mobile-screen">
       <div class="medium-12 columns text-center" style="font-size: 1.2em; 
                           color: #fff; 
                           background-color: #b31b1b;
                           font-family: Georgia, Arial, Serif;">Call (607) 756-2921</div>
    </div>

  </header>
   <?php
}


function printApartmentNavs(){
  ?>
   <div class="text-center" id="breadcrumbs" role="navigation" aria-label="Student Housing Navigation" title="cortland student housing">
  <?php
 if( preg_match('/apartments\/index\.html/', $_SERVER['PHP_SELF']) ){
    print "Apartments Home";
  }else{
    print '<a href="index.html" tabindex="0" title="student apartments home page">Apartments Home</a>';
  }
  print " | ";
  if( preg_match('/50-tompkins-str\.html/',$_SERVER['PHP_SELF'])){
    print "50 Tompkins Str";
  }else{
    print '<a href="50-tompkins-str.html" tabindex="0" title="suny cortland off campus student housing">50 Tompkins Str</a>';
  }
  print " | ";

  if( preg_match('/52-tompkins-str\.html/',$_SERVER['PHP_SELF'])){
    print "52 Tompkins Str";
  }else{
    print '<a href="52-tompkins-str.html" tabindex="0" title="cortland state student housing">52 Tompkins Str</a>';
  }
  print " | ";

  if( preg_match('/100-tompkins-str\.html/',$_SERVER['PHP_SELF'])){
    print "100 Tompkins Str";
  }else{
    print '<a href="100-tompkins-str.html" tabindex="0" title="cortland ny student housing">100 Tompkins Str</a>';
  }
  print " | ";

  if( preg_match('/112-groton-ave\.html/',$_SERVER['PHP_SELF'])){
    print "112 Groton Ave";
  }else{
    print '<a href="112-groton-ave.html" tabindex="0" title="student rentals suny cortland">112 Goton Ave</a>';
  }
  print " | ";

  if( preg_match('/7-woodruff-str\.html/',$_SERVER['PHP_SELF'])){
    print "7 Woodruff Str";
  }else{
    print '<a href="7-woodruff-str.html" tabindex="0" title="cortland university student housing">7 Woodruff Str</a>';
  }
  print " | ";

  if( preg_match('/91-lincoln-ave\.html/',$_SERVER['PHP_SELF'])){
    print "91 Lincoln Ave";
  }else{
    print '<a href="91-lincoln-ave.html" tabindex="0" title="suny cortland college housing">91 Lincoln Ave</a>';
  }
  print " | ";

  ?>
</div>
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
  global $path;
?>

  </div><!-- body-container -->




  <!-- accessibility role -->
  <footer>

    <div class="row">          
      <div class="medium-12 columns text-center">
        <hr style="height:2px; background-color: #b31b1b;" />
      </div>        
    </div>

    <div class="row">          
      <div class="medium-12 columns text-center bg-white"> 
        <p>Call us today for more information:<br />
        607.756.2921<br />
        <a href="<?php print $path; ?>contact-us.html">Contact Us Form</a>
        </p>

        <!-- facebook -->
        <a href="https://www.facebook.com/Cornerstone-Properties-Cortland-138759469505509/">
          <img src="<?php print $path; ?>images/cortland-ny/suny-cortland/off-campus-student-housing/Logos/Facebook/facebook-f.gif" alt="facebook" /> Follow Us On Facebook!</a> |  

        <!-- Instagram -->
        <a href="https://www.instagram.com/propertiesbycornerstone/">
          <img src="<?php print $path; ?>images/cortland-ny/suny-cortland/off-campus-student-housing/Logos/Instagram/instagram-30x30.gif" alt="the Instagram icon" title="follow us on instagram" /> Follow Us On Instagram!</a>  |  
          <?php
          ##### Share code found on:  https://onlinecode.org/social-media-sharing-buttons-php/  #####
          #
          $site_url = "https://ww.cortlandcollegehousing.com/";
          $site_title = "CornerStone Properties";
          ?>

          <!-- Facebook Social Media -->
        <a href="http://www.facebook.com/sharer.php?u=<?=$site_url?>" target="_blank">
          <img src="<?php print $path; ?>images/cortland-ny/suny-cortland/off-campus-student-housing/Logos/Facebook/facebook-share.png" alt="facebook" /> Share us on Facebook!
        </a>
        </div>        
      </div> <!-- row -->

      <div class="row">          
      <div class="medium-12 columns text-center">
        <hr style="height:2px; background-color: #b31b1b;" />
      </div>        
    </div>

      <p>&nbsp;</p>

    </footer>

  
    
    <!-- scripts that Foundation needs.  Must be placed here. -->
    <!-- foundation code -->
    <script src="https://www.cortlandcollegehousing.com/includes/js/vendor/jquery.js"></script>
    <script src="https://www.cortlandcollegehousing.com/includes/js/vendor/what-input.js"></script>
    <script src="https://www.cortlandcollegehousing.com/includes/js/vendor/foundation.js"></script>
    <script src="https://www.cortlandcollegehousing.com/includes/js/app.js"></script>
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



