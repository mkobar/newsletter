<?php
$success = true;

if ($userid <= 0 && !empty($_GET['verify']))
{
	if (is_numeric($_GET['verify']) && is_numeric($_GET['uid'])) {
	    $r = sqlSel("SELECT * FROM `users` WHERE id=? AND vcode=?",$_GET['uid'], $_GET['verify']);
	    if ($r && $r->num_rows > 0)
	    {
		    $pw = randPW(12);
            $password = encryptPW($pw);
		    $q = $db->prepare("UPDATE `users` SET pw=PASSWORD('$password'), vcode='0' WHERE id=? AND vcode=?");
		    $q->bind_param('ii',$_GET['uid'],$_GET['verify']);
		    if ($q->execute()) {
                $server = explode('.',$_SERVER['SERVER_NAME']);
                if (count($server) > 2)
                {
                    array_shift($server);
                }
                $server = implode('.',$server);

			    $uData = sqlData('users',$_GET['uid']);

			    $msg_success[] = "Congratulations! Your account has been successfully verified. You may now login.";

			    $recipient = $uData['email'];

			    $subject = "TriplePulse.com: Welcome to TriplePulse; lets dominate 2013!";

			    $message = "Hi, we are stoked to have you on our team(and that you aren't a robot).<br>\n<br>\nHere is your temporary password(for sign in with out social connection): $pw<br>\n<br>\nCheck back regularly for updates.<br>\n<br>\n";
                //Your temporary password can be changed at any point from account settings on <a href=\"http://".$_SERVER['SERVER_NAME']."/\">$server</a><br>\n<br>\n
			    $message .= "If you ever have any questions, please feel free to send an e-mail to <a href=\"mailto:support@".$server."\">support@".$server."</a><br>\n<br>\n<br>\n";
			    $message .= "TriplePulse | Dominate 2013";

			    $body = "<html>\n";
			    $body .= "<body style=\"font-family:Verdana, Arial, Geneva, sans-serif; font-size:12px;\">\n";
			    $body = $message;
			    $body .= "</body>\n";
			    $body .= "</html>\n";

			    $headers  = "From: TriplePulse <dominate@".$server.">\r\n";
			    $headers .= "Reply-To: dominate@".$server."\r\n";
			    $headers .= "Return-Path: dominate@".$server."\r\n";
			    $headers .= "X-Mailer: Drupal\n";
			    $headers .= 'MIME-Version: 1.0' . "\n";
			    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			    mail($recipient, $subject, $message, $headers);
                $verified = true;
		    } else {
			    $msg[] = "Your verification code did not match. Please be sure that you entered the URL correctly.";
		    }
		    $q->close();
	    } else {
		    $msg[] = "Your verification code or user id were incorrect. Please be sure that you entered the URL correctly.";
	    }
	    $r->free();
	} else {
		$msg[] = "Your verification code or user id were incorrect. Please be sure that you entered the URL correctly.";
	}
}
?>

