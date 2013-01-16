<div id="pack-holder">
<img class="c" src="img/text_ceo.png">
<hr>
<div id="subs">
    <ul>
        <a href="membership.php"><li style="margin:0 32px;"><img src="img/sub_1.png"></li></a>
        <a href="membership.php?sub=3"><li><img src="img/sub_3.png"></li></a>
        <a href="membership.php?sub=6"><li><img src="img/sub_6.png"></li></a>
        <a href="membership.php?sub=12"><li><img src="img/sub_12.png"></li></a>
    </ul>
</div>
<div class="holder">
    <a href="http://www.triplepulse.com/science.php"><img class="c" src="img/information.png" alt="The Science"></a>
</div>
    <?php
        if (isset($userid) && $userid > 0)
        {
    ?>
<div id="account-set" class="a"><?php echo $user['email']; ?></div>
    <?php
        }
        else
        {
    ?>
<div id="login-def">Sign In</div>
    <?php
        }
    ?>
<div id="footer">
    <div id="con">CONNECT</div><ul id="social"><li id="f"><a target="new" href="http://www.facebook.com/pages/Triple-Pulse/109490285810788" class="facebook"></a></li><li id="t"><a target="new" href="http://www.twitter.com/Triple_Pulse" class="twitter"></a></li><li id="l"><a target="new" href="http://www.linkedin.com/company/2781052" class="linkedin"></a></li></ul>
    <ul id="links"><li><a href="faq.php">FAQ</a></li><li><a href="mission.php">Team Mission</a></li><li><a href="privacy.php">Privacy Policy</a></li><li><a href="terms.php">Terms</a></li><li><a href="athletes.php">Our Athletes</a></li></ul>
</div>
<div id="legal">This site is for educational and entertainment purposes. It is not a substitute for medical advice, diagnosis, or treatment. You should consult your physician or other health care professional before using any vitamins or supplements or any other fitness program to determine if it is right for your body. </div>

<!--Preload Images-->
<img class="hide" src="img/slides/arrow_l.png">
<img class="hide" src="img/slides/arrow_r.png">
<img class="hide" src="img/slides/arrow_l_hover.png">
<img class="hide" src="img/slides/arrow_r_hover.png">
<img class="hide" src="img/slides/slide_0.png">
<img class="hide" src="img/slides/slide_1.png">
<img class="hide" src="img/slides/slide_2.png">
<img class="hide" src="img/slides/slide_3.png">
<img class="hide" src="img/slides/slide_4.png">
<img class="hide" src="img/logo_solo_h.png">
<img class="hide" src="img/social/f_dark.png">
<img class="hide" src="img/social/t_dark.png">
<img class="hide" src="img/social/l_dark.png">

<!--Load *.js-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js" type="text/javascript"></script>
<script src="js/fb_init.js" type="text/javascript"></script>
<script src="js/signup.js" type="text/javascript"></script>
<!--<script src="js/bootstrap.min.js" type="text/javascript"></script>-->

<script type="text/javascript">
<?php
if (!empty($verified))
{
?>
show_verify();
<?php
}
?>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-34340907-1']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
</div>

