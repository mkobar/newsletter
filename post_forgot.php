<?php
ini_set('display_errors',1);
include_once('inc/common.inc.php');

if (!empty($_SESSION['forgot']))
{
    $r = sqlSel("SELECT * FROM `users` WHERE email=? AND vcode=0",$_SESSION['forgot']);
    if ($r && $r->num_rows > 0)
    {
	    $pw = randPW(12);
        $password = encryptPW($pw);
	    $q = $db->prepare("UPDATE `users` SET pw=PASSWORD('$password') WHERE email=? AND vcode=0 LIMIT 1");
	    $q->bind_param('s',$_SESSION['forgot']);
	    if ($q->execute()) {
            $server = explode('.',$_SERVER['SERVER_NAME']);
            if (count($server) > 2)
            {
                array_shift($server);
            }
            $server = implode('.',$server);

		    $uData = sqlDataE('users',$_SESSION['forgot']);

		    $recipient = $uData['email'];

		    $subject = "TriplePulse.com: Temporary Password Notice";

		    $message = "Thank you for verifying.<br>\n<br>\nHere is your temporary password(for sign in with out social connection): $pw<br>\n<br>\nYour temporary password can be changed at any point from account settings on <a href=\"http://".$_SERVER['SERVER_NAME']."/\">$server</a>.<br>\n<br>\nCheck back regularly for updates.<br>\n<br>\n";
		    $message .= "If you ever have any questions, please feel free to send an e-mail to <a href=\"mailto:support@".$server."\">support@".$server."</a><br>\n<br>\n<br>\n";
		    $message .= "Sincerely,<br>\n<br>\n- TriplePulse Founders & Team -";

		    $body = "<html>\n";
		    $body .= "<body style=\"font-family:Verdana, Arial, Geneva, sans-serif; font-size:12px;\">\n";
		    $body = $message;
		    $body .= "</body>\n";
		    $body .= "</html>\n";

		    $headers  = "From: TriplePulse <noreply@".$server.">\r\n";
		    $headers .= "Reply-To: noreply@".$server."\r\n";
		    $headers .= "Return-Path: noreply@".$server."\r\n";
		    $headers .= "X-Mailer: Drupal\n";
		    $headers .= 'MIME-Version: 1.0' . "\n";
		    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		    mail($recipient, $subject, $message, $headers);
            echo 1;
	    } else {
		    $msg[] = "Your verification code did not match. Please be sure that you entered the URL correctly.";
	    }
	    $q->close();
    } else {
	    $msg[] = "Your account has not yet been verified.";
    }
    if ($r)
    {
        $r->free();
    }
}
?>

