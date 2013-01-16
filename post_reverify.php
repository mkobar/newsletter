<?php
$success = true;
ini_set('display_errors',1);
include_once("inc/common.inc.php");
$msg = Array();
$msg_success = Array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['reverify'])) {
    if (filter_var($_SESSION['reverify'],FILTER_VALIDATE_EMAIL)) {
        if (strlen($_SESSION['reverify'] > 256))
        {
            $success = false;
            $msg[] = "Email was too long.";
        }
        else
        {
            $r = sqlSel("SELECT * FROM `users` where `email`=?",$_SESSION['reverify']);
            if ($r)
            {
                if ($r->num_rows > 0) {
                    $success = true;
                }
                else
                {
                    $success = false;
                    $msg[0] = "You must create an account first.";
                }
            }
            else
            {
                $success = false;
                $msg[] = "Email was invalid.";
            }
            $r->free();
        }
    } else {
        $success = false;
        $msg[] = "Email was invalid.";
    }

    if ($success) {
        $user = sqlDataE('users',$_SESSION['reverify']);
        $code = $user['vcode'];

        if ($code > 0) {
            $id = $user['id'];
            $msg_success[] = 1;

            $recipient = $_SESSION['reverify'];

            $subject = "TriplePulse.com: Account Verification Request.";

            $message = "Thank you for registering.<br>\n<br>\nPlease visit the following address in order to verify your account and receive your temporary password:<br>\n<br>\n";
            $message .= "<a href=\"http://".$_SERVER['SERVER_NAME']."/index.php?verify=$code&uid=$id\">http://".$_SERVER['SERVER_NAME']."/index.php?verify=$code&uid=$id</a>";

            $body = "<html>\n";
            $body .= "<body style=\"font-family:Verdana, Arial, Geneva, sans-serif; font-size:12px; color:#777777;\">\n";
            $body = $message;
            $body .= "</body>\n";
            $body .= "</html>\n";

            $server = explode('.',$_SERVER['SERVER_NAME']);
            array_shift($server);
            $server = implode('.',$server);

            $headers  = "From: TriplePulse <noreply@".$server.">\r\n";
            $headers .= "Reply-To: noreply@".$server."\r\n";
            $headers .= "Return-Path: noreply@".$server."\r\n";
            $headers .= "X-Mailer: Drupal\n";
            $headers .= 'MIME-Version: 1.0' . "\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            mail($recipient, $subject, $body, $headers);
        } else {
            $msg[] = "You have already been verified.";
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

