<?php
ini_set('display_errors',0);
include_once("inc/common.inc.php");
?>
<?php include("html_head.php"); ?>
<title>TriplePulse | Custom Packs | Vitamins & Supplements | Fitness Advice</title>
<?php include("meta_script.php"); ?>

<link href="css/triplepulse.css" rel="stylesheet" type="text/css">
<link href="css/index.css" rel="stylesheet" type="text/css">

</head>

<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['verify'])) include_once("inc/include_register.php");
?>
<?php
include("header.php");
?>
<div id="pack-holder">
    <a href="membership.php"><img id="get_started" class="abs" style="padding-top:420px; left:50%; margin-left:-66px; z-index:1;" src="img/get_started.png"></a>
    <div id="pack-info">
        <div id="pack-info2"></div>
        <div id="larrow"></div>
        <div id="rarrow"></div>
    </div>
    <ul id="slides"><li id="s0"></li><li id="s1"></li><li id="s2"></li><li id="s3"></li><li id="s4"></li></ul>
    <div style="margin-top:30px; margin-left:auto; margin-right:auto; height:450px; width:960px; text-align:left;">
        <div style="width:300px; float:left;">
            <h3 style="text-align:center">DRAFT OFF THE PROS</h3>
            <p>Try our pack of performance sports nutrition created and tested by our team of pros. Custom for endurance athletes.</p>
            <img src="img/how1.png">
        </div>
        <div style="width:300px; margin-left:30px; float:left;">
            <h3 style="text-align:center">JOIN OUR BETA</h3>
            <p>We are constantly optimizing our formula ratios, absorption methods, and delivery formats with our team of Olympians, pro cyclists, and Ironman triathletes.</p>
            <img src="img/how2.png">
        </div>
        <div style="width:300px; margin-left:30px; float:left;">
            <h3 style="text-align:center">GET GUIDANCE</h3>
            <p>Stay motivated with advice from our pros. We also send an “aid station” at the end of the month, with samples, discounts and exclusives.</p>
            <img src="img/how3.png">
        </div>
    </div>
    <div></div>
</div>
<?php
include("footer.php");
?>
<?php
// Required to create PHP tracker, add valid actions and execute JavaScript, track("Action"), actions
include_once("track.php");
//Setup valid user actions to track from this page.
$track = new Track("Used carousel");
?>
<script src="js/bgpos.js" type="text/javascript"></script>
<script src="js/carousel.js" type="text/javascript"></script>
</body>
</html>
<?php
if ($db) $db->close();
?>

