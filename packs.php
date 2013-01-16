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
if ($_SERVER['REQUEST_METHOD'] == 'POST' || ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['verify']))) include_once("inc/include_register.php");
?>
<?php
include("header.php");
?>
Packs
<?php
include("footer.php");
?>
</body>
</html>
<?php
if ($db) $db->close();
?>

