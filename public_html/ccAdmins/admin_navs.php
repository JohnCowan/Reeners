<?php

function admin_navs(){
  ?>
    <p style="font-size: .9em;">
      | 
      <?php
      if( preg_match( '/\/index\.html/', $_SERVER['PHP_SELF']) ){
        print "Admins Home |";
      }else{
        print "<a href='index.html'>Admins Home</a> | ";
      }


      if( preg_match( '/\/news-admin\.html/', $_SERVER['PHP_SELF']) ){
        print "News Admin |";
      }else{
        print "<a href='news-admin.html'>News Admin</a> | ";
      }


      if( preg_match( '/\/applicants\.html/', $_SERVER['PHP_SELF']) ){
        print "Rental Applicants |";
      }else{
        print "<a href='applicants.html'>Rental Applicants</a> | ";
      }
      ?>
    </p>

  <?php
}
?>