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
<div class="container">
    <div class="row">
        <div class="span4">
            <h2>DRAFT OFF THE PROS</h2>
            <img src="img/draft.png">
        </div>
        <div class="span4">
            <h2>JOIN OUR BETA</h2>
            <img src="img/beta.png">
        </div>
        <div class="span4">
            <h2>GET GUIDANCE</h2><br>
            <img src="img/guidance.png">
        </div>
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

