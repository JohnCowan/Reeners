<?php
  /*    Includes file for cortlandcollegehousing.com
      writen by John Cowan
      Date: Sept 2012
  */


################################################################################
##
## database connection
require_once "database/db_connect.php";

// true when running on the local dev site (php -S ... see start-dev-site.sh)
$is_dev = ( php_sapi_name() === 'cli-server' );



// set the path to the graphics folder when we are in the admins folder
//
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



function printHeaders($params){
  global $path, $is_dev;
?>
 
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php if( !$is_dev ){ /* no analytics on the local dev site */ ?>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <!-- new tag added march 22, 2022                 -->
      <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-0Z3CECKQV0"></script> -->
      <script async src="https://www.googletagmanager.com/gtm.js?id=G-5SW8V8PJ6Z"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
      </script>
<?php } ?>

       <meta charset="utf-8" />
       <!-- don't need this anymore? <meta http-equiv="x-ua-compatible" content="ie=edge"> -->
       <meta name="viewport" content="width=device-width, initial-scale=1.0" />
       <title><?php print getPageTitle($params['title']); ?></title>

       <!-- favicon icon -->
       <link rel="shortcut icon" type="image/jpg" href="<?= $path ?>images/cortland-ny/suny-cortland/off-campus-student-housing/Logos/favicon.ico" />

       <!-- canonical tag to site home page -->
       <link rel="canonical" href=“https://www.cortlandcollegehousing.com/index.html” />

       <meta name="description" content="<?php print $params['description'] ?>">
       <meta name="keywords" content="<?php print $params['keywords'] ?>">

       <meta property="og:title" content="social media sharing buttons php onlinecode.org"/>
       <meta property="og:image" content="<?php print $path; ?>images/cortland-ny/suny-cortland/off-campus-student-housing/Logos/Facebook/facebook-f.gif"/>
       <meta property="og:url" content="onlinecode.org"/>
       <meta property="og:description" content="social media sharing buttons php onlinecode.org"/>
      

        <!-- Compressed CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.8.1/dist/css/foundation.min.css" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.8.1/dist/css/foundation-float.min.css" crossorigin="anonymous">
      

      <!-- Foundation's JavaScript is loaded at the bottom of the page (see printFooter), after jQuery -->
     
     <!-- ?v= changes whenever main.css changes, so browsers fetch the new copy instead of a cached one -->
     <link rel="stylesheet" href="<?= $path ?>includes/main.css?v=<?= filemtime(__DIR__ . '/main.css') ?>" type="text/css" />

     <!-- slick banner css -->
     <link rel="stylesheet" href="<?= $path ?>includes/slick-master/slick/slick.css" />
     <link rel="stylesheet" href="<?= $path ?>includes/slick-master/slick/slick-theme.css" />
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" />
     <!-- end slick css -->
     <!-- end  css code -->

     <!-- js code: jQuery is loaded once, here.  (jquery-latest 1.11 removed; it was replaced by this one anyway) -->
     <script type="text/javascript" src="<?= $path ?>includes/js/vendor/jquery.js"></script>
     <script type="text/javascript" src="<?= $path ?>includes/ckeditor/ckeditor.js"></script>
     <script type="text/javascript" src="<?= $path ?>includes/slick-master/slick/slick.min.js"></script>
     <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

   </head>
        
        <!--  bgcolor="#F9F582" -->
        <body>
        <a class="show-on-focus skip-link" href="#body-container">Skip to main content</a>
        <?php
        printTopNavs();   // sticky navigation bar, very top of page
        printBanner();    // photo slider + tagline
        ?>
         <div id="body-container">
        <?php
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
  $home_active     = preg_match('/^\/index/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $about_active    = preg_match('/about/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $locations_active = preg_match('/apartment-locations/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $describe_active   = preg_match('/apartment-descriptions/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $floorplan_active   = preg_match('/apartment-floorplans/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $application_active = preg_match('/apartment-rental-application/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $lease_active   = preg_match('/lease/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $docs_active   = preg_match('/documents/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $contact_active  = preg_match('/contact-us/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $apartments_active  = preg_match('/apartments\/|apartment-(descriptions|floorplans|locations)/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $tompkins_50_active  = preg_match('/apartments\/50-tompkins-str/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $tompkins_52_active  = preg_match('/apartments\/52-tompkins-str/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $tompkins_100_active  = preg_match('/apartments\/100-tompkins-str/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $groton_active  = preg_match('/apartments\/112-groton-ave/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $woodruff_active  = preg_match('/apartments\/7-woodruff-str/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $lincoln_active  = preg_match('/apartments\/91-lincoln-ave/', $_SERVER['PHP_SELF']) ? 'active' : '';
  $checklist_active = preg_match('/college-apartment-checklist/', $_SERVER['PHP_SELF']) ? 'active' : '';
  // the application page lives under "Important Documents"
  if( $application_active ){ $docs_active = 'active'; }

  $apts = $path."cortland-ny/suny-cortland/off-campus-student-housing/";
  ?>

  <!-- sticky top navigation.  Small/medium screens: "Menu" button opens an accordion.
       Large screens (1024px+): horizontal bar with drop-downs.  Uses Foundation 6.8 (see printFooter) -->
  <div id="site-nav" role="navigation" aria-label="Main navigation">

    <!-- small + medium screens -->
    <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="large">
      <a class="brand" href="<?php print $path ?>index.html">CORNERSTONE PROPERTIES</a>
      <button class="menu-toggle" type="button" data-toggle="main-menu" aria-controls="main-menu" aria-label="Menu">
        <span class="menu-icon"></span><span class="menu-toggle-text">Menu</span>
      </button>
    </div>

    <div class="top-bar" id="main-menu">
      <div class="top-bar-left">
        <a class="brand show-for-large" href="<?php print $path ?>index.html">CORNERSTONE PROPERTIES</a>

        <ul class="vertical large-horizontal menu" data-responsive-menu="accordion large-dropdown">
           <li class="<?php print $home_active ?>"><a href="<?php print $path ?>index.html">Home</a></li>

           <li class="<?php print $about_active ?>"><a href="<?php print $path ?>about-us.html">About Us</a></li>

           <li class="<?php print $apartments_active ?>"><a href="<?php print $apts ?>apartments/index.html">Apartments</a>
              <ul class="vertical menu nested">
                <li><a href="<?php print $apts ?>apartments/index.html">All Apartments</a></li>
                <li class="<?php print $describe_active ?>"><a href="<?php print $apts ?>apartment-descriptions.html">Descriptions</a></li>
                <li class="<?php print $floorplan_active ?>"><a href="<?php print $apts ?>apartment-floorplans.html">FloorPlans</a></li>
                <li class="<?php print $locations_active ?>"><a href="<?php print $apts ?>apartment-locations.html">Locations</a></li>
                <li class="<?php print $tompkins_50_active ?>"><a href="<?php print $apts ?>apartments/50-tompkins-str.html">50 Tompkins Str</a></li>
                <li class="<?php print $tompkins_52_active ?>"><a href="<?php print $apts ?>apartments/52-tompkins-str.html">52 Tompkins Str</a></li>
                <li class="<?php print $tompkins_100_active ?>"><a href="<?php print $apts ?>apartments/100-tompkins-str.html">100 Tompkins Str</a></li>
                <li class="<?php print $groton_active ?>"><a href="<?php print $apts ?>apartments/112-groton-ave.html">112 Groton Ave</a></li>
                <li class="<?php print $woodruff_active ?>"><a href="<?php print $apts ?>apartments/7-woodruff-str.html">7 Woodruff Str</a></li>
                <li class="<?php print $lincoln_active ?>"><a href="<?php print $apts ?>apartments/91-lincoln-ave.html">91 Lincoln Ave</a></li>
              </ul>
           </li>

           <li class="<?php print $docs_active ?>"><a href="<?php print $path ?>documents.html"><span class="nav-wide">Important </span>Documents</a>
              <ul class="vertical menu nested">
                <li class="<?php print preg_match('/documents/', $_SERVER['PHP_SELF']) ? 'active' : '' ?>"><a href="<?php print $path ?>documents.html">Documents</a></li>
                <li class="<?php print $application_active ?>"><a href="<?php print $apts ?>apartment-rental-application.html">Application</a></li>
              </ul>
           </li>

           <li class="<?php print $contact_active ?>"><a href="<?php print $path ?>contact-us.html">Contact Us</a></li>

           <li class="<?php print $checklist_active ?>"><a href="<?php print $path ?>college-apartment-checklist.html"><span class="nav-wide">College Apartment </span>Checklist</a></li>
        </ul>
      </div>

      <div class="top-bar-right">
        <a class="nav-phone" href="tel:+16077562921">&#9742; (607) 756-2921</a>
      </div>
    </div>
  </div> <!-- #site-nav -->

  <?php
}

function printBanner(){
  global $path;
  $img = $path."images/cortland-ny/suny-cortland/off-campus-student-housing/banner-images/";
  ?>
  <header role="banner" class="site-hero"> <!-- aria accessibility -->

   <!-- the sliding images.  .hero-backdrop holds a blurred copy of the current photo
        so the band fills the full browser width (the photos are only 1000px wide) -->
   <div class="hero-photos">
      <div class="hero-backdrop" aria-hidden="true"></div>
      <div class="hero-backdrop" aria-hidden="true"></div>

      <div class="hero-slider single-item">
          <div class="multiple">
            <img src="<?php print $img ?>7-woodruff-street-exterior-front-view-575.jpg" 
            alt="apartment 7 woodruff str cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $img ?>100-tompkins-street-exterior-front-view-575.jpg" 
            alt="apartment 100 Tompkins str cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $img ?>50-tompkins-street-exterior-front-view-575.jpg" 
            alt="apartment 50 Tompkins str cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $img ?>112-groton-ave-exterior-front-view-575.jpg" 
            alt="apartment 112 Groton Ave cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $img ?>50-tompkins-street-exterior-street-view-575.jpg" 
            alt="apartment 50 Tompkins str cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $img ?>52-tompkins-street-exterior-front-view-575.jpg" 
            alt="apartment 52 Tompkins str cortland ny" />
          </div>
          <div class="multiple">
            <img src="<?php print $img ?>91-lincoln-ave-exterior-front-view-575.jpg" 
            alt="apartment 91 lincoln cortland ny" />
          </div>
      </div> <!-- hero-slider -->
   </div> <!-- hero-photos -->

   <!-- tagline strip (replaces the old text rows and the "Reserve Your Place Today" row) -->
   <div class="hero-tagline">
     <div class="row">
       <div class="small-12 columns">
         <span class="tagline-where">Off-Campus Student Housing in Cortland, NY</span>
         <span class="tagline-sep" aria-hidden="true">&#9670;</span>
         <span class="tagline-what">All-Inclusive Luxury Apartments</span>
         <a class="tagline-button" href="<?php print $path ?>cortland-ny/suny-cortland/off-campus-student-housing/apartment-rental-application.html">Reserve Your Place Today</a>
       </div>
     </div>
   </div>

  </header>
   <?php
}


function printApartmentNavs(){
  ?>
   <div class="text-center" id="breadcrumbs" role="navigation" aria-label="Student Housing Navigation">
  <?php
 if( preg_match('/apartments\/index\.html/', $_SERVER['PHP_SELF']) ){
    print "Apartments Home";
  }else{
    print '<a href="index.html" tabindex="0">Apartments Home</a>';
  }
  print " | ";
  if( preg_match('/50-tompkins-str\.html/',$_SERVER['PHP_SELF'])){
    print "50 Tompkins Str";
  }else{
    print '<a href="50-tompkins-str.html" tabindex="0">50 Tompkins Str</a>';
  }
  print " | ";

  if( preg_match('/52-tompkins-str\.html/',$_SERVER['PHP_SELF'])){
    print "52 Tompkins Str";
  }else{
    print '<a href="52-tompkins-str.html" tabindex="0">52 Tompkins Str</a>';
  }
  print " | ";

  if( preg_match('/100-tompkins-str\.html/',$_SERVER['PHP_SELF'])){
    print "100 Tompkins Str";
  }else{
    print '<a href="100-tompkins-str.html" tabindex="0">100 Tompkins Str</a>';
  }
  print " | ";

  if( preg_match('/112-groton-ave\.html/',$_SERVER['PHP_SELF'])){
    print "112 Groton Ave";
  }else{
    print '<a href="112-groton-ave.html" tabindex="0">112 Goton Ave</a>';
  }
  print " | ";

  if( preg_match('/7-woodruff-str\.html/',$_SERVER['PHP_SELF'])){
    print "7 Woodruff Str";
  }else{
    print '<a href="7-woodruff-str.html" tabindex="0">7 Woodruff Str</a>';
  }
  print " | ";

  if( preg_match('/91-lincoln-ave\.html/',$_SERVER['PHP_SELF'])){
    print "91 Lincoln Ave";
  }else{
    print '<a href="91-lincoln-ave.html" tabindex="0">91 Lincoln Ave</a>';
  }
  print " | ";

  ?>
</div>
<?php

}


function getNews($page){
  global $dbh;
  if( !$dbh ){ return; }  // no database (e.g. local dev site)
  ?>
  <div class="row" role="alert">
    <div class="medium-12 columns callout alert text-center">
        <h2>Apartment News!</h2>
        <?php
        $sql="select * from news";
        $sth=$dbh->prepare($sql);
        $sth->execute();
        if( !$sth ){
         error_log("MYUTILS.PHP cannot get news.");

        }
        $results = $sth->fetchAll();
        
        foreach( $results as $data ){

          // print the news on these pages:
          //
          if(!empty($data['home_page']) && $page=='index.html'){
              print "<p>".$data['content']."</p>";

          }
          if(!empty($data['description_page']) && $page=='apartment-description.html'){
              print "<p>".$data['content']."</p>";
          }
          if(!empty($data['floorplans_page']) && $page=='floorplans.html'){
              print "<p>".$data['content']."</p>";
          }
          if(!empty($data['location_page']) && $page=='apartment-locations.html'){
              print "<p>".$data['content']."</p>";
          }
          if(!empty($data['request_page']) && $page=='request-application.html'){
              print "<p>".$data['content']."</p>";
          }
          if(!empty($data['lease_page']) && $page=='lease.html'){
              print "<p>".$data['content']."</p>";
          }
          if( $data['contact_page']==1 && $page=='contact-us.html'){
              print "<p>".$data['content']."</p>";
          }
        }
        ?>
    </div>
  </div>
    
    <?php 
}

// record when someone comes to the site.  Should add this to Google Analytics 
function logHits($item){
   global $dbh, $is_dev;
   if( !$dbh || $is_dev ){ return; }  // don't count local dev visits
  
   $item = strtoupper($item);
   $today = date('Y-m-d',time());
   $referrer = !empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'NONE';
   $item = !empty($item) ? $item : 'Not Sent';   
   $sql = "insert into hits 
                ( page_hit, referrer, date_hit )
            values
                ( ?, ?, ? )";
    $sqlParams = array( $item, $referrer, $today );
    $sth=$dbh->prepare($sql);
    $sth->execute($sqlParams);
    if( !$sth ){
      error_log("######## MYUTILS.PHP cannot insert into hits");
    }
}

function getHits(){
  global $dbh;
  if( !$dbh ){ return; }
  $sql="select count(*) as cnt_hits from hits where page_hit = upper(?)";
  $sth=$dbh->prepare($sql);
  $sth->execute( ['HOME-PAGE'] );
  if( !$sth ){
      error_log("######## MYUTILS.PHP problem querying hits");
  }
  // single row expected, use fetch()
  if( $data=$sth->fetch() ){
    ?>
    <div class="row">
      <div class="medium-12 columns callout alert text-center">
      <p><?php print $data['cnt_hits'] ?> visitors to this site!</p>
      </div>
    </div>
    <?php
  } 
}


function printFooter(){
  global $path;
?>

  </div><!-- body-container -->




  <!-- accessibility role -->
  <!-- full-width red footer (styles in main.scss: footer.site-footer) -->
  <footer class="site-footer">

    <div class="row">          
      <div class="medium-12 columns text-center"> 
        <p class="footer-call">Call us today for more information:<br />
        <a class="footer-phone" href="tel:+16077562921">607.756.2921</a><br />
        <a href="<?php print $path; ?>contact-us.html">Contact Us Form</a>
        </p>

        <p class="footer-social">
        <!-- facebook -->
        <a href="https://www.facebook.com/Cornerstone-Properties-Cortland-138759469505509/">
          <img src="<?php print $path; ?>images/cortland-ny/suny-cortland/off-campus-student-housing/Logos/Facebook/facebook-f.gif" alt="" /> Follow Us On Facebook!</a>
        <span class="footer-sep" aria-hidden="true">|</span>

        <!-- Instagram -->
        <a href="https://www.instagram.com/propertiesbycornerstone/">
          <img src="<?php print $path; ?>images/cortland-ny/suny-cortland/off-campus-student-housing/Logos/Instagram/instagram-30x30.gif" alt="" /> Follow Us On Instagram!</a>
        <span class="footer-sep" aria-hidden="true">|</span>
          <?php
          ##### Share code found on:  https://onlinecode.org/social-media-sharing-buttons-php/  #####
          #
          $site_url = "https://www.cortlandcollegehousing.com/";
          $site_title = "CornerStone Properties";
          ?>

          <!-- Facebook Social Media -->
        <a href="https://www.facebook.com/sharer.php?u=<?=$site_url?>" target="_blank" rel="noopener">
          <img src="<?php print $path; ?>images/cortland-ny/suny-cortland/off-campus-student-housing/Logos/Facebook/facebook-share.png" alt="" /> Share us on Facebook! <span class="show-for-sr">(opens in a new window)</span>
        </a>
        </p>
      </div>        
    </div> <!-- row -->

  </footer>

  
    
    <!-- scripts that Foundation needs.  Must be placed here. -->
    <!-- foundation code (jQuery itself is loaded once, in the <head>) -->
    <script src="<?php print $path; ?>includes/js/vendor/what-input.js"></script>
    <!-- same Foundation version as the CSS in the <head> -->
    <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.8.1/dist/js/foundation.min.js" crossorigin="anonymous"></script>
    <script>
      jQuery(function($){
        // Foundation is only switched on for the top navigation,
        // so nothing else on the pages changes behavior.
        $('#site-nav').foundation();

        // banner photos: keep the blurred backdrop in step with the slider
        var $backdrops = $('.hero-backdrop'), showing = 0;
        function setBackdrop(src){
          var next = 1 - showing;
          $backdrops.eq(next).css('background-image', 'url("' + src + '")').addClass('is-visible');
          $backdrops.eq(showing).removeClass('is-visible');
          showing = next;
        }
        var $slider = $('.single-item');
        $slider.on('init', function(e, slick){
          setBackdrop($(slick.$slides[0]).find('img').attr('src'));
        });
        $slider.on('beforeChange', function(e, slick, current, next){
          setBackdrop($(slick.$slides[next]).find('img').attr('src'));
        });
        $slider.slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          speed: 300,
          dots: false,
          autoplay: true,
          infinite: true,
          responsive: [ { breakpoint: 640, settings: { arrows: false } } ]
        });
      });
    </script>
    
    
  </body></html>
<?php
}
?>

<?php
// Let the web guy know there was a database error 
########  Honeypot spam check (replaces the image captchas)  ########
# Put honeypotFields() inside a <form>.  A real visitor never sees or fills the
# hidden field; spam bots usually do, and they usually submit within a second or two.
function honeypotFields(){
  $_SESSION['form_started'] = time();
  ?>
  <div class="hp-field" aria-hidden="true">
    <label for="contact_by_fax">Leave this field empty</label>
    <input type="text" id="contact_by_fax" name="contact_by_fax" value="" tabindex="-1" autocomplete="off" />
  </div>
  <?php
}

# true when a submission looks like a bot (hidden field filled in, or sent too fast)
function honeypotFailed(){
  $filled  = !empty($_POST['contact_by_fax']);
  $started = isset($_SESSION['form_started']) ? (int) $_SESSION['form_started'] : 0;
  $tooFast = ( $started === 0 ) || ( time() - $started < 3 );
  if( $filled || $tooFast ){
    error_log("HONEYPOT: blocked a form submission on " . $_SERVER['PHP_SELF'] . ($filled ? ' (hidden field filled)' : ' (too fast / no session)'));
    return true;
  }
  return false;
}

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



