<?php
/*
Random validation (CAPTCHA) image

Use this script in your contact form, for you whois query tool or just there where some extra validation is needed. A session will be created inside a dynamic image file (requires GD library). The random value of this image appears inside the generated CAPTCHA image. The user has to enter this value into formfield. This value will be checked while processing the form. Without entering this value a form will not be processed.

example of usage:

inside your form
<input type="text" name="validator" id="validator" size="4">
<img src="random.php" alt="CAPTCHA image" width="60" height="20" vspace="1" align="top">
and test the value of the "validator" form field like:
if (!empty($_POST['validator']) && $_POST['validator'] == $_SESSION['rand_code']) {
    process your form here
    at least destroy the session
    unset($_SESSION['rand_code']);
*/


session_start();

// save this code in your random script

//if (empty($_SESSION['rand_code'])) {
    $str = "";
    $length = 0;
    for ($i = 0; $i < 4; $i++) {
        // this numbers refer to numbers of the ascii table (small-caps)
        $str .= chr(rand(97, 122));
    }
    $_SESSION['rand_code'] = $str;
//}

$imgX = 60;
$imgY = 20;
$image = imagecreatetruecolor(60, 20);

$backgr_col = imagecolorallocate($image, 238,239,239);
$border_col = imagecolorallocate($image, 208,208,208);
$text_col = imagecolorallocate($image, 46,60,31);

imagefilledrectangle($image, 0, 0, 60, 20, $backgr_col);
imagerectangle($image, 0, 0, 59, 19, $border_col);

$font = "fonts/VeraSe.ttf"; // it's a Bitstream font check www.gnome.org for more
$font_size = 10;
$angle = 0;
$box = imagettfbbox($font_size, $angle, $font, $_SESSION['rand_code']);
$x = (int)($imgX - $box[4]) / 2;
$y = (int)($imgY - $box[5]) / 2;
imagettftext($image, $font_size, $angle, $x, $y, $text_col, $font, $_SESSION['rand_code']);

header("Content-type: image/png");
imagepng($image);
imagedestroy ($image);
?>
