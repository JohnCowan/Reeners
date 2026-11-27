<?php
/*
 * Admin login for the ccAdmins pages.
 *
 * The password is NOT stored here.  Only a one-way hash of it is kept in
 * includes/database/admin_pass.php (not in git, same as db_creds.php).
 * To set or change the password, run on your PC:
 *     php ~/Websites/Reeners/set-admin-password.php
 * then upload includes/database/admin_pass.php.
 *
 * Pages use it like this (unchanged):
 *     if( !isset($_SESSION['verified']) ){ require_once('../includes/login.php'); _showLoginScreen(); }
 */

$verified    = isset($_SESSION['verified']) ? 1 : 0;
$err_message = '';

$pword = isset($_POST['pword']) ? (string) $_POST['pword'] : '';

if( !$verified && $pword !== '' ){
	$hash_file = __DIR__ . '/database/admin_pass.php';
	$hash      = is_file($hash_file) ? include $hash_file : '';

	if( is_string($hash) && $hash !== '' && password_verify($pword, $hash) ){
		if( !headers_sent() ){ session_regenerate_id(true); }   // new session id once logged in
		$_SESSION['verified'] = 1;
		$verified = 1;
	}else{
		if( $hash === '' ){
			error_log("LOGIN.PHP: includes/database/admin_pass.php is missing - run set-admin-password.php");
		}
		sleep(2);                          // slows down password guessing
		$err_message = "<p style=\"color: #FF0000;\">The password was not correct. Try again!!</p>";
	}
}

function _showLoginScreen(){
	global $err_message;

	// already logged in (e.g. the password was just accepted): nothing to show
	if( isset($_SESSION['verified']) ){
		return;
	}
	?>
	  <p>You must login to be able to see the Admin section of this site.</p>
    <form name="form1" action="<?php print htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
			<div class="grid-x grid-padding-x">
			  <div class="cell small-6 large-3">
			  	<?php if( !empty($err_message) ){ print $err_message; } ?>
          <label for="password"><span style="color: #b31b1b;">**</span> <strong>Password:</strong>
            <input type="password" name="pword" id="pword" required />
          </label>
        </div>
        <div class="small-3 large-2 columns" style="text-align:left;">
        	<p>&nbsp;</p><p style="font-size: .8em;"><a class="red" id="password_show">Show PW</a></p>
        </div>
	    </div>

	    <div class="grid-x grid-padding-x">
	    	<div class="cell small-12">
		      <input type="submit" class="button" name="submitform" value="Let me in!" />
		    </div>
		  </div>
		</form>

		<script>
			$(document).ready(function(){
			  
			   // password

			  $('#password_show').click(function(e){
			    e.preventDefault();

			    var pw = $('#pword');

			    // set pword type to either text or password
			    var type = $('#pword').attr("type") === 'password' ? 'text' : 'password';

			    // set pword type
			    $('#pword').attr("type", type);
			    
			  });

			}); // document.ready

		</script>

	  
<?php
}
?>
