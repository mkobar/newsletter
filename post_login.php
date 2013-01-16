<?php
include_once("inc/common.inc.php");
$password = '';

if (isset($_POST['password']))
{
	/*
	$cipher = mcrypt_module_open(MCRYPT_BLOWFISH, '', MCRYPT_MODE_CBC, '');
	$iv =  '12345678';
	$key256 = '1234567890123456ABCDEFGHIJKLMNOP';
	// Do 256-bit blowfish encryption:
	// The strengh of the encryption is determined by the length of the key
	// passed to mcrypt_generic_init
	if (mcrypt_generic_init($cipher, $key256, $iv) != -1)
	{
		// PHP pads with NULL bytes if $cleartext is not a multiple of the block size..
		$cipherText = mcrypt_generic($cipher,$_POST['password']);
		mcrypt_generic_deinit($cipher);

		// Display the result in hex.
		//printf("256-bit blowfish encrypted:\n%s\n\n",bin2hex($cipherText));

	$password = bin2hex($cipherText);
	*/
	$password = $_POST['password']; //base64_encode(sha1($_POST['password'], true));
}

if (!empty($password))
{
    $password = encryptPW($password);
}

if (isset($_POST['username'])) {
    $r = sqlSel("SELECT `id` FROM `users` WHERE pw=PASSWORD(?) AND email=? LIMIT 1",$password,$_POST['username']);

	if ($r && $r->num_rows > 0) {
	    $row = $r->fetch_row();
	    $user = sqlData('users', $row[0]);
        if ($user['vcode'] == 0)
        {
            $_SESSION['userid'] = $row[0];
            $userid = $_SESSION['userid'];
            $msg_success[] = 1;
        }
		else
        {
            $msg[] = "Verification of account required.<hr><a id=\"reverify2\" href=\"#reverification\">Re-send code to {$user['email']}</a>?<script type=\"text/javascript\">$(\"#reverify2\").mousedown(reverify);</script>";
            $_SESSION['reverify'] = $user['email'];
        }
	} else {
		$msg[] = "Incorrect login information. <a id=\"forgot_pw2\" href=\"#forgot_pw\">Forgot password?</a><script type=\"text/javascript\">$(\"#forgot_pw2\").mousedown(forgotpw);</script>";
		$_SESSION['forgot'] = $_POST['username'];
	}
}

if (count($msg) > 0)
{
    foreach ($msg as $m)
    {
        echo $m."\n";
    }
}
else
{
    if (count($msg_success) > 0)
    {
        echo $msg_success[0];
    }
    else
    {
        if ($userid > 0)
        {
            echo 1;
        }
        else
        {
            echo "No account found. Please register first.";
        }
    }
}
?>

