<?php
ini_set('display_errors',1);
include_once("inc/common.inc.php");
?>
<?php include("html_head.php"); ?>
<title>TriplePulse | Custom Packs | Vitamins & Supplements | Fitness Advice</title>
<?php include("meta_script.php"); ?>



<link href="css/triplepulse.css" rel="stylesheet" type="text/css">

<?php
// Required to create PHP tracker, add valid actions and execute JavaScript, track("Action"), actions
include_once("track.php");
//Setup valid user actions to track from this page.
$track = new Track("Used carousel");
?>
</head>

<body>
<?php
include("header.php");

function urldecode_to_array ($url) {
  $ret_ar = array();
 
  if (($pos = strpos($url, '?')) !== false)         // parse only what is after the ?
    $url = substr($url, $pos + 1);
  if (substr($url, 0, 1) == '&')                    // if leading with an amp, skip it
    $url = substr($url, 1);

  $elems_ar = explode('&', $url);                   // get all variables
  for ($i = 0; $i < count($elems_ar); $i++) {
    list($key, $val) = explode('=', $elems_ar[$i]); // split variable name from value
    $ret_ar[urldecode($key)] = urldecode($val);     // store to indexed array
  }

  return $ret_ar;
}


if ($userid > 0)
{
    $token = $_REQUEST['token'];
    $payer = $_REQUEST['PayerID'];
    $postfields = array('METHOD'=>'GetExpressCheckoutDetails', 'USER'=>'ca_api1.triplepulse.com', 'PW'=>'UAWL5ZF3ZUNN8G8Z', 'SIGNATURE'=>'A8sZ3NFhLxOvi2pzlWVA9pIpqno2AutwEPBcp5hFd62XyJok60slQQ-L', 'VERSION'=>'94.0', 'TOKEN'=>$token);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $result = curl_exec($ch);
    
    $vars = urldecode_to_array($result);
    if (!empty($vars['ACK']))
    {
        if (strcasecmp($vars['ACK'],"Success") == 0)
        {
            $postfields = array('METHOD'=>'DoExpressCheckoutPayment', 'USER'=>'ca_api1.triplepulse.com', 'PW'=>'UAWL5ZF3ZUNN8G8Z', 'SIGNATURE'=>'A8sZ3NFhLxOvi2pzlWVA9pIpqno2AutwEPBcp5hFd62XyJok60slQQ-L', 'VERSION'=>'94.0');
            $postfields['PAYMENTREQUEST_0_AMT'] = $vars['PAYMENTREQUEST_0_AMT'];
            $postfields['PAYMENTREQUEST_0_PAYMENTACTION'] = 'Sale';
            $postfields['PAYERID'] = $payer;
            $postfields['TOKEN'] = $token;
            /*
            $postfields['PAYMENTREQUEST_0_SHIPPINGAMT'] = '0.00';
            $postfields['PAYMENTREQUEST_0_INSURANCEAMT'] = '0.00';
            $postfields['PAYMENTREQUEST_n_SHIPDISCAMT'] = '-0.00'; // shipping discount ? 
            $postfields['PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED'] = 'false';
            $postfields['PAYMENTREQUEST_0_HANDLINGAMT'] = '0.00';
            $postfields['PAYMENTREQUEST_0_TAXAMT'] = '0.00';
            $postfields['PAYMENTREQUEST_0_DESC'] = "Endurance Pack - $sub month supplement supply.";
            $postfields['PAYMENTREQUEST_0_CUSTOM'] = !empty($_REQUEST['ship_month']) ? 'Ship: '.$_REQUEST['ship_month'] : 'Ship: Next month.'; // optional
            //$postfields['PAYMENTREQUEST_0_INVNUM'] = '1'; // Invoice tracking # (Optional)
            //$postfields['PAYMENTREQUEST_0_NOTIFYURL'] = ''; // (Optional) URL for receiving Instant Payment Notification (IPN) about this transaction
            //$postfields['PAYMENTREQUEST_0_NOTETEXT'] = ''; // (Optional) Note to merchant.
            //$postfields['PAYMENTREQUEST_0_TRANSACTIONID'] = '0';
            //$postfields['PAYMENTREQUEST_0_PAYMENTREQUESTID'] = '0'; // A unique identifier of the specific payment request, which is required for parallel payments.
            $postfields['PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID'] = 'HAAJ9ZDDGATKJ';
            
            if (!empty($user_ship))
            {
                $postfields['PAYMENTREQUEST_0_SHIPTONAME'] = !empty($user_ship['name']) ? $user_ship['name'] : '';
                $postfields['PAYMENTREQUEST_0_SHIPTOSTREET'] = !empty($user_ship['street']) ? $user_ship['street'] : '';
                $postfields['PAYMENTREQUEST_0_SHIPTOSTREET2'] = !empty($user_ship['street2']) ? $user_ship['street2'] : '';
                $postfields['PAYMENTREQUEST_0_SHIPTOCITY'] = !empty($user_ship['city']) ? $user_ship['city'] : '';
                $postfields['PAYMENTREQUEST_0_SHIPTOSTATE'] = !empty($user_ship['state']) ? $user_ship['state'] : '';
                $postfields['PAYMENTREQUEST_0_SHIPTOZIP'] = !empty($user_ship['zip']) ? $user_ship['zip'] : '';
                $postfields['PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE'] = !empty($user_ship['country_code']) ? $user_ship['country_code'] : '';
                $postfields['PAYMENTREQUEST_0_SHIPTOPHONENUM'] = !empty($user_ship['phone']) ? $user_ship['phone'] : '';
            }
            */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $result = curl_exec($ch);
            /*
            TIMESTAMP=2007%2d04%2d05T23%3a23%3a07Z
            &CORRELATIONID=63cdac0b67b50
            &ACK=Success
            &VERSION=XX%2e000000
            &BUILD=1%2e0006
            &TOKEN=EC%2d1NK66318YB717835M
            */
            /*
            SEND CLIENT TO:
            https://www.sandbox.paypal.com/cgi-bin/webscr?
            cmd=_express-checkout
            &token=EC-1NK66318YB717835M
            */
            $vars = urldecode_to_array($result);
            if (!empty($vars['ACK']))
            {
                if (strcasecmp($vars['ACK'],"Success") == 0)
                {
                    $msg = "PURCHASE SUCCESSFUL.";
                }
                else
                {
                    $msg = "PURCHASE FAILED.";
                }
            }
        }
    }
}
?>
<div class="holder">
    <div class="m5">
        <div class="fl w30p ta">
            <img src="img/products/pack0/pack.png">
            <hr>
            Pack...
        </div>
        <div class="w70p tal m2 pl35p">
            <hr>
            <div class="top vam w100 bgo">
                <h3 class="m1" style="font-weight:normal;">Endurance Pack</h2>
            </div>
            <h3><?php echo $msg; ?></h3>
            <hr>
            <img class="c" src="img/logo_thanks.png">
        </div>
        <hr class="br30">
    </div>
</div>
<?php
include("footer.php");
?>
</body>
</html>
<?php
if ($db) $db->close();
?>

