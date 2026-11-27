<?php
/*
 * Sets the ccAdmins password.  Run from a terminal on your PC (not on the website):
 *     php ~/Websites/Reeners/set-admin-password.php
 * It writes only a one-way hash to public_html/includes/database/admin_pass.php.
 * Upload that file to the server afterwards.
 */
if( php_sapi_name() !== 'cli' ){ exit("Run this from a terminal.\n"); }

function ask_hidden($prompt){
	echo $prompt;
	system('stty -echo');
	$value = rtrim((string) fgets(STDIN), "\r\n");
	system('stty echo');
	echo PHP_EOL;
	return $value;
}

$p1 = ask_hidden("New admin password: ");
$p2 = ask_hidden("Type it again: ");

if( $p1 !== $p2 ){ exit("The passwords did not match. Nothing was changed.\n"); }
if( strlen($p1) < 10 ){ exit("Please use at least 10 characters. Nothing was changed.\n"); }

$file = __DIR__ . '/public_html/includes/database/admin_pass.php';
$hash = password_hash($p1, PASSWORD_DEFAULT);
$php  = "<?php\n// ccAdmins password hash, made by set-admin-password.php on " . date('Y-m-d') .
        ".\n// Not the password itself. Keep out of git.\nreturn " . var_export($hash, true) . ";\n";

if( file_put_contents($file, $php) === false ){ exit("Could not write $file\n"); }
chmod($file, 0640);
echo "Saved. Now upload public_html/includes/database/admin_pass.php to the server.\n";
