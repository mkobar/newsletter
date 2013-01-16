<?php
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
?>
<div class="holder tal">
<h3 class="bgo cb" style="padding-left:15px;">Mission</h3>
<p class="f12">We started TriplePulse out of Westwood, California, with the goal of helping amateur and intermediate endurance athletes reach their full potential. We’ve sifted through the noise and hassle of the endurance nutrition market to deliver the essentials conveniently to the door of our customers on a monthly basis. Our mission is to support endurance athletes, both physically and mentally, to help them overcome their challenges in and away from the race. In addition to our products, we will curate web content with expert training insight and inspiration from athletes. This mix is the recipe for perseverance and universal success.</p>
<hr class="br30">
</div>
<?php
include("footer.php");
?>
</body>
</html>
<?php
if ($db) $db->close();
?>

