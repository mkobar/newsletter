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
    <table width="100%">
    <tr>
        <td class="tac p05">
            <img src="img/athletes/alexosbourne.jpg">
        </td>
        <td class="taj vat p05 f12">
            <h2>Alex Osborne</h2>
            <h3 style="font-weight:normal;">US Olympic Rower</h3>
            <p>
            Alex was born and raised in Los Angeles, CA the 25 year old is a highly gifted athlete. He began rowing in 2005 and by 2008 he won gold in the eight at the 2008 World Rowing Under 23 Championships. Alex holds a Economics degree from Stanford, enjoys golf, and is aspiring to become a mobile gaming entrepreneur.
            </p>
            <p>Follow him on Twitter <a target="new" href="//twitter.com/arosborne">@arosborne</a></p>
        </td>
    </tr>
    </table>
    <table width="100%">
    <tr>
        <td class="tac p05">
            <img src="img/athletes/guy east.png">
        </td>
        <td class="taj vat p05 f12">
            <h2>Guy East</h2>
            <h3 style="font-weight:normal;">US Olympic Cyclist</h3>
            <p>
            Guy East grew up in Indianapolis, and started riding at the age of 12 with a goal of making the 2012 U.S. Olympic Cycling Team. In 2010, a US National Team race in Mexico inspired him to help those less fortunate. Partnering with More Than Sport, he and other athletes are on a mission to improve distressed communities. 
            </p>
            <p>Follow him on Twitter <a target="new" href="//twitter.com/GuyEast">@GuyEast</a></p>
        </td>
    </tr>
    </table>
    <table width="100%">
    <tr>
        <td class="tac p05">
            <img src="img/athletes/glenochal.jpg">
        </td>
        <td class="taj vat p05 f12">
            <h2>Glenn Ochal</h2>
            <h3 style="font-weight:normal;">US Olympic Rower</h3>
            <p>
            Glenn was recently voted US Rowing's 2012 Male Athlete of the year. With seven years of National Team experience, the 26 year old received a Bronze medal in the four at his first Olympic games. Glenn also holds an Economics degree from Princeton University, enjoys competitive card playing, and is a beach vollyball fanatic.
            </p>
            <p>Follow him on Twitter <a target="new" href="//twitter.com/glennochal">@glennochal</a></p>
        </td>
    </tr>
    </table>
    <table width="100%">
    <tr>
        <td class="tac p05">
            <img src="img/athletes/david wiswell.png">
        </td>
        <td class="taj vat p05 f12">
            <h2>David Wiswell</h2>
            <h3 style="font-weight:normal;">US National Cyclist</h3>
            <p>
            At the age of 18, began racing on both the Junior and Espoir U.S. National Teams in track races. Come 2004, at the age of 21, David spent the spring racing the Australian track season before moving to a Belgian road team where he raced in the Itajian Summer Six Days along with a number of road events throughout Europe. His eight year racing career is fortified by five 1st place finishes.
            </p>
        </td>
    </tr>
    </table>
    <table width="100%">
    <tr>
        <td class="tac p05">
            <img src="img/athletes/danny friese.jpg">
        </td>
        <td class="taj vat p05 f12">
            <h2>Danny Friese</h2>
            <h3 style="font-weight:normal;">ITU Triathlete</h3>
            <p>
            Danny Friese is a native born German who moved to Denmark with his family at a young age. He is taking after his father, also a triathlete, and is currently training for the U-23 Triathlon World Championships.
            </p>
        </td>
    </tr>
    </table>
    <table width="100%">
    <tr>
        <td class="tac p05">
            <img src="img/athletes/greeksoccer.jpg">
        </td>
        <td class="taj vat p05 f12">
            <h2>Michail Fragoukalis</h2>
            <h3 style="font-weight:normal;">Greek Soccer Player</h3>
            <p>
            Childhood friend of TriplePulse co-founder Constantine, Michail was born in 1983 in Heraklion, Greece.Fragoulakis began his football career as a striker with Atsalenios F.C. before joining Ergotelis in 2006. Recently he has shifted to midfielder for the Greek club Asteras Tripoli F.C.
            </p>
        </td>
    </tr>
    </table>
</div>
<?php
include("footer.php");
?>
</body>
</html>
<?php
if ($db) $db->close();
?>

