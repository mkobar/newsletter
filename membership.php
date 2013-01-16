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

$sub = 1;
$sub_cost = '$75/mo.';
$sub_charge = '50.00';

if (!empty($_REQUEST['sub']))
{
    $sub = $_REQUEST['sub'];
    $sub_cost = '$75/mo.';
    $sub_charge = '50.00';
    if ($sub == 3)
    {
        $sub_cost = '$135';
        $sub_charge = '135.00';
    }
    if ($sub == 6)
    {
        $sub_cost = '$255';
        $sub_charge = '255.00';
    }
    if ($sub == 12)
    {
        $sub_cost = '$450';
        $sub_charge = '450.00';
    }
    if ($sub_cost == '$50')
    {
        $sub = 1;
    }
}
?>
<div class="holder">
    <hr>
    <table width="100%">
        <tr>
            <td width="25%" class="tal" colspan="2">
                <div class="w100 bgo">
                    <h3 class="m1" style="font-weight:normal;">Endurance Pack</h2></h3>
                </div>
            </td>
        <tr>
            <td width="25%" class="tac vat">
                <hr>
                <?php
                if (isset($_POST['promo_code']) && strcasecmp($_POST['promo_code'],'beachblast') == 0)
                {
                ?>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <div class="w25 c tac">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="6HA85LRPQY62S">
                <input type="hidden" name="on0" value="Monthly Supply">
                
                <select class="w25 f14" name="os0">
                        <option value="1 Month @ $52.50/mo. -- Includes 30% off w/BeachBlast promo!">1 Month @ $52.50/mo. -- Includes 30% off w/BeachBlast promo!</option>
                        <option value="3 Months @ $45/mo. -- Includes 40% off w/BeachBlast promo!">3 Months @ $45/mo. -- Includes 40% off w/BeachBlast promo!</option>
                    </select>
                    <hr>
                    <input type="hidden" name="on1" value="Shipment Month">
                </div>
                <div class="w25 c tac">
                    <input class="w25" type="text" name="os1" maxlength="200" placeholder="Shipment Month If Not Immediate">
                    <input type="hidden" name="currency_code" value="USD">
                <?php
                }
                else if (isset($_POST['promo_code']) && strcasecmp($_POST['promo_code'],'3PBeta20') == 0)
                {
                ?>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <div class="w25 c tac">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="MJZGUZDPE58SA">
                <input type="hidden" name="on0" value="Monthly Supply">
                
                <select class="w25 f14" name="os0">
                    <option value="1 Month @ $75/mo. + 20% OFF">1 Month @ $75/mo. + 20% OFF</option>
                    <option value="3 Months @ $57/mo. + 20% OFF">3 Months @ $57/mo. + 20% OFF</option>
                    <option value="6 Months @ $45/mo. + 20% OFF">6 Months @ $45/mo. + 20% OFF</option>
                    <option value="12 Months @ $37/mo. + 20% OFF">12 Months @ $37/mo. + 20% OFF</option>
                </select> 
                <hr>
                <input type="hidden" name="on1" value="Shipment Month">
                </div>
                <div class="w25 c tac">
                    <input class="w25" type="text" name="os1" maxlength="200" placeholder="Shipment Month If Not Immediate">
                    <input type="hidden" name="currency_code" value="USD">
                <?php
                }
                else
                {
                ?>

                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <div class="w25 c tac">
                    <!--<h3><div class="fl w6 co"><?php echo $sub_cost; ?></div>-->
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="PS76W3G3699V4">
                    <input type="hidden" name="on0" value="Supply">
                    <select class="w25 f14" name="os0">
                        <option value="1 Month @ $75/mo."<?php echo $sub == 1 ? ' selected'  : ''; ?>>1 Month @ $75/mo.</option>
                        <option value="3 Months @ $57/mo."<?php echo $sub == 3 ? ' selected'  : ''; ?>>3 Months @ $57/mo.</option>
                        <option value="6 Months @ $45/mo."<?php echo $sub == 6 ? ' selected'  : ''; ?>>6 Months @ $45/mo.</option>
                        <option value="12 Months @ $37/mo."<?php echo $sub == 12 ? ' selected'  : ''; ?>>12 Months @ $37/mo.</option>
                    </select>
                    <hr>
                    <input type="hidden" name="on1" value="Shipment Month">
                </div>
                <div class="w25 c tac">
                    <p class="tal f8">Shipment Month If Not Immediate:</p>
                    <input class="w25" type="text" name="os1" maxlength="200" placeholder="Shipment Month If Not Immediate">
                    <input type="hidden" name="currency_code" value="USD">
                </div>
                <?php
                }
                ?>
                <hr>
                <div class="w25 c tac">
                    <input class="br30 w25 b cw bgo f14" type="submit" value="Purchase" alt="PayPal - The safer, easier way to pay online!">
                </div>
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
                <hr>
                <hr>
                <hr><hr>
                <img src="img/products/pack0/pack.png">
                <hr>
            </td>
            <td width="75%" class="tal vat m2 f12">
                <?php
                if (!isset($_POST['promo_code']) || (isset($_POST['promo_code']) && strcasecmp($_POST['promo_code'],'beachblast') != 0))
                {
                ?>
                <div class="fr abs"><h6 class="fl f8" style="margin:0px;padding:0px;border:0px;">Have a promo code?</h6><form method="post" action="membership.php"><input class="w25 fr f8" type="text" name="promo_code" maxlength="200" placeholder="Promo code"><hr><input type="submit" value="Apply promo code" class="bgo cb fr f8" ></form></div>
                <?php
                }
                else
                {
                ?>
                <div class="fr abs"><h6 class="fl f8">Thanks for using our BeachBlast promo code!</h6></div>
                <?php
                }
                ?>
                <hr>
                <h4>What’s in your monthly subscription?</h4>
                <ul>
                    <li>A stack of sports nutrition for a full month of endurance training (aminos, multis, glutamine, electrolytes).</li>
                    <li>Expert training tips from our team of pro athletes.</li>
                    <li>Exclusives, discounts, and samples of the latest in endurance sports nutrition.</li>
                </ul>
                <p>Our stacks are the result of hundreds of conversations with endurance athletes across many sports and levels. A surprise box of samples didn’t accomplish what they wanted most--all the work done for them.  WE do all the work for YOU--the research, testing, supplier qualification, convenient packaging...all netting in a monthly box that is always being tweaked and optimized.  And we toss in samples, exclusives, and discounts as part of it.</p>
                <p>Our full endurance stacks are built with the the fundamental principles of endurance training. Our team of athletes field test all of our mixes and provide feedback to our team of scientists. This allows us to constantly optimize our stack to help athletes maximize their potential in endurance athletics.</p>
            </td>
        </tr>
    </table>
    <hr>
    <img class="c" src="img/tictac.png">
</div>
<?php
include("footer.php");
?>
</body>
</html>
<?php
if ($db) $db->close();
?>

