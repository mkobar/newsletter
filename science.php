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
<div id="holder">
    <img class="c" src="img/science_0.jpg">
    <hr class="br50">
    <img class="c" src="img/science_1.png">
</div>
<?php
include("footer.php");
?>
</body>
</html>
<?php
if ($db) $db->close();
?>

