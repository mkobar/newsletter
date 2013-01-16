<?php
$success = true;
include_once("inc/common.inc.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST['email1'])) {

		if (filter_var($_POST['email1'],FILTER_VALIDATE_EMAIL)) {
            if (strlen($_POST['email1'] > 256))
            {
                $success = false;
                $msg[] = "Email was too long.";
                $_POST['email1'] = '';
            }
            else
            {
                $r = sqlSel("SELECT * FROM `users` where `email`=?",$_POST['email1']);
                if ($r)
                {
                    if ($r->num_rows > 0) {
                        $success = false;
                        $msg[0] = "Account already exists. <a id=\"forgot_pw\" href=\"#forgot_pw\">Forgot password?</a><script type=\"text/javascript\">$(\"#forgot_pw\").mousedown(forgotpw);</script>"; // Replace verification required message.
                        $_SESSION['forgot'] = $_POST['email1'];
                        $_POST['email1'] = '';
                    }
                }
                else
                {
                    $success = false;
                    $_POST['email1'] = '';
                    $msg[] = "Email was invalid.";
                }
                $r->free();
            }
		} else {
			$success = false;
			$msg[] = "Email was invalid.";
			$_POST['email1'] = '';
		}

		if ($success) {
			$code = mt_rand(100000000, 999999999);

            $q = $db->prepare("INSERT INTO `users` (email,pw,vcode) VALUES (?,'un-verified','$code')");
            $q->bind_param('s',$_POST['email1']);

			if ($q->execute()) {
                $id = $q->insert_id;
				$msg_success[] = 1;

				$recipient = $_POST['email1'];

				$subject = "TriplePulse.com: Confirming you're not a robot; lets dominate 2013!";

				$message = "Hi, we are stoked that you are joining our team.<br>\n<br>\nPlease click this link to prove that you are not a robot (robots aren't real athletes)--<br>\n<br>\n";
				$message .= "<a href=\"http://".$_SERVER['SERVER_NAME']."/index.php?verify=$code&uid=$id\">http://".$_SERVER['SERVER_NAME']."/index.php?verify=$code&uid=$id</a>";
				$message .= "\n<br>\n<br>\n<br>\nTriplePulse | Dominate 2013";

				$body = "<html>\n";
				$body .= "<body style=\"font-family:Verdana, Arial, Geneva, sans-serif; font-size:12px; color:#777777;\">\n";
				$body = $message;
				$body .= "</body>\n";
				$body .= "</html>\n";

                $server = explode('.',$_SERVER['SERVER_NAME']);
                if (count($server) > 2)
                {
                    array_shift($server);
                }
                $server = implode('.',$server);

				$headers  = "From: TriplePulse <dominate@".$server.">\r\n";
				$headers .= "Reply-To: dominate@".$server."\r\n";
				$headers .= "Return-Path: dominate@".$server."\r\n";
				$headers .= "X-Mailer: Drupal\n";
				$headers .= 'MIME-Version: 1.0' . "\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				mail($recipient, $subject, $body, $headers);
			} else {
				$msg[] = "There was an error during MYSQL insert attempt." . mysql_error();
			}
            $q->close();
		}
	}
}
if ($msg && count($msg) > 0)
{
    foreach ($msg as $m)
    {
        echo $m."\n";
    }
}
else
{
    if ($msg_success && count($msg_success) > 0)
    {
        echo $msg_success[0];
    }
}
?>

