<script language="JavaScript">
function entsub(myform) {
  if (window.event && window.event.keyCode == 13){
  	//myform.submitform.click();
    //myform.submit();
	document.form1.submitform.click();
  }else{
    return true;
  }
}


</script>

<?php
$pword = !empty($_REQUEST['pword']) ? $_REQUEST['pword'] : '';

if ( isset($pword) && $pword ){
	if ( $pword == 'The-Suites' ){
		$verified = 1;
		if( !isset( $_SESSION['verified'] ) ){
			$_SESSION['verified'] = $verified;
		}
	}else{
		$verified = 0;
		$err_message = "<p style=\"color: #FF0000;\">The password was not correct. Try again!!</p>";
	}
}

function _showLoginScreen(){
	// show the login form...
	// print "br /Yo Baby ".$_SERVER['PHP_SELF'];
	?>
	
	<p>You must login to be able to see the Amin section of this site.</p>
	<table style="background-color: #336699; color: #fff;">
	<tr><td style="font-size: 16px; color: #fff;">Login Please</td></tr>
	</table>
	<table style="border: 1px solid #336699;">
	<form name="form1" action="<?php print $_SERVER['PHP_SELF'] ?>" method="POST">
	<tr>
	<td>Password: <input type="password" name="pword" size="10" onkeypress="return entsub(this.form)" >
	    <input type="submit" name="submitform" value="Let me in!"></td>
	</tr>
	</form>
	</table>
<?php
}
?>
