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
<div class="holder">
    <img class="c" src="img/tips_0.png">
    <hr>
    <img class="c" src="img/tips_1.png">
    <hr>
    <img class="c" src="img/tips_2.png">
    <hr>
    <img class="c" src="img/tictac.png">
    <hr>
    <img class="c" src="img/tips_4.png">
    <hr>
</div>
<?php
include("footer.php");
?>
</body>
</html>
<?php
if ($db) $db->close();
?>

