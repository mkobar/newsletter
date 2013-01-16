<?php
ini_set('display_errors',1);
$db = mysqli_connect("127.0.0.1","triplepu_db","sup3rPuls3TRIPLE","triplepu_db");

if (!$db) {
	die("Connect error."); //: " . mysqli_error());
}

/*
$h = date("YmdH"); //current year month day hour

$ip = $_SERVER['REMOTE_ADDR'];

$query = "SELECT * FROM `ip_ignore` WHERE ip='$ip' LIMIT 1";
$result = mysqli_query($db,$query);
if ($result && mysqli_num_rows($result) > 0)
{
	$resData = mysqli_fetch_assoc($result);
	if ($abs($h) > $abs($resData['expiration']))
	{
        //ip ban has expired
		$query = "DELETE FROM `ip_ignore` WHERE ip='$ip'";
		mysqli_query($db,$query);
	}
	else
	{
		die("Connect error."); //ip is banned/blacklisted for too many malicious connection attempts
	}
}
*/

session_start();
include_once("inc/fb/facebook.php");
include_once("inc/twitter/EpiCurl.php");
include_once("inc/twitter/EpiSequence.php");
include_once("inc/twitter/EpiOAuth.php");
include_once("inc/twitter/EpiTwitter.php");

$fb_conf = array();
$fb_conf["appId"] = '440714052657944';
$fb_conf["secret"] = 'd2e3481cb7310147783e1f390c42eada';
$fb_conf["fileUpload"] = false; // optional

$fb = new Facebook($fb_conf);
//var_dump($fb);
$ufb_id = $fb->getUser();
$user = Array();

if (isset($_SESSION['userid']) && $_SESSION['userid'] <= 0)
{
    unset($_SESSION['userid']);
}

if ($ufb_id) {
    try
    {
        $ufb = $fb->api('/me');
        $ufb_e = $ufb["email"];
    }
    catch(FacebookApiException $e) {
        $ufb_id = 0;
    }
}

try
{
    $twitterObj = new EpiTwitter('ZCOdMmXQoglM3BoZ68Ldgg','Kzl0MdwHy9jWxvLTfPyijdLji3GMTFmr6pPaNI0ps','321170807-hzSgiCnhHHhodW81IhPHhl5ffaxFUHbao55F2bvr','DXs5eqsdqkIdPtNCc4bWEuHyEfucPddwIuonXtdiE');
    $creds = $twitterObj->get('/account/verify_credentials.json');
}catch(EpiTwitterException $e){
    //echo $e->xdebug_message;
}catch(Exception $e){
    //echo $e->getMessage();
}

$self = $_SERVER['PHP_SELF'];
$page_self = basename($_SERVER['PHP_SELF']);
//$_POST = db_escape($_POST);
//$_REQUEST = db_escape($_REQUEST);
//$_GET = db_escape($_GET);
$msg = Array();
$msg_success = Array();

if (isset($_REQUEST['logout']) && $_REQUEST['logout'] > 0) {
	session_unset();
    $_POST = Array();
    $_REQUEST = Array();
    $_GET = Array();
    $msg_success[] = "Sign out successful.";
}

$harray = explode('.', parse_url($_SERVER["SERVER_NAME"], PHP_URL_HOST));
$host1 = "h1";
if (count($harray) > 1)
{
    $harray = array_reverse($harray);
    $host1 = $harray[1] . $harray[0];
}
$host2 = "h2";
if (isset($_SERVER["HTTP_REFERER"]))
{
    $harray = explode('.', parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST));
    if (count($harray) > 1)
    {
        $harray = array_reverse($harray);
        $host2 = $harray[1] . $harray[0];
    }
}
if ($host1 != 'h1' && $host2 != 'h2' && strcasecmp($host1,$host2) != 0)
{
    $q = $db->prepare("INSERT INTO `referers` (url,cnt,ts) VALUES (?,1,now()) ON DUPLICATE KEY UPDATE cnt=cnt+1,ts=now()");
    $q->bind_param('s',substr($_SERVER["HTTP_REFERER"],0,255));
    $q->execute();
    $q->close();
}

if (isset($_SESSION['userid']) && $_SESSION['userid'] > 0) {
	$user = sqlData('users', $_SESSION['userid']);
	if (empty($user['email']))
	{
	    unset($_SESSION['userid']);
	    $user = Array();
	}
	else
	{
	    $userid = $_SESSION['userid'];
	}
}
else
{
    if ($ufb_id)
    {
        $user = sqlDataE('users',$ufb_e);
        if ($user['vcode'] == 0 && $user['id'] > 0)
        {
            $_SESSION['userid'] = $user['id'];
	        $userid = $user['id'];
	        $msg_success[] = 1;
        }
        else
        {
            if ($user['id'] > 0)
            {
                $msg[] = "Verification of account required.<hr><a id=\"reverify\" href=\"#reverification\">Re-send code to {$user['email']}</a>?<script type=\"text/javascript\">$(\"#reverify\").mousedown(reverify);</script>";
                $_SESSION['reverify'] = $user['email'];
            }
            else
            {
                if ($user['vcode'])
                {
                    $msg[] = "You must register for an account before signing in.";
                }
            }
        }
    }
}

//$seed = mt_rand(1000000000, 9999999999);

//----------------------
//COMMON FUNCTIONS BELOW
//----------------------

function encryptPW($pw)
{
	$pw = base64_encode(sha1($pw, true));

	$cipher = mcrypt_module_open(MCRYPT_BLOWFISH, '', MCRYPT_MODE_CBC, '');
	$iv =  '12J4M678';
	$key256 = '1891028743M4I8CHE23LL5678EILUFEJ';
	// Do 256-bit blowfish encryption:
	// The strengh of the encryption is determined by the length of the key
	// passed to mcrypt_generic_init
	if (mcrypt_generic_init($cipher, $key256, $iv) != -1)
	{
		// PHP pads with NULL bytes if $cleartext is not a multiple of the block size..
		$cipherText = mcrypt_generic($cipher,$pw);
		mcrypt_generic_deinit($cipher);

		// Display the result in hex.
		//printf("256-bit blowfish encrypted:\n%s\n\n",bin2hex($cipherText));

		$pw = bin2hex($cipherText);
	}
    return $pw;
}

function randPW($len) {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!#$%^&~@";
    $max = 67; //strlen($alphabet)-1;
    $pass = "";
    for ($i = 0; $i < $len; $i++) {
        $n = mt_rand(0, $max);
        $pass .= $alphabet[$n];
    }
    return $pass;
}

function sqlData($table,$id) {
    $r = sqlSel("SELECT * FROM `$table` WHERE id=?",$id);
    if ($r->num_rows > 0)
    {
        $res = $r->fetch_assoc();
        $r->free();
	    return $res;
	}
	else
	{
        $r->free();
	    return 0;
	}
}

function sqlDataE($table,$email) {
    $r = sqlSel("SELECT * FROM `$table` WHERE email=?",$email);
    if ($r->num_rows > 0)
    {
        $res = $r->fetch_assoc();
        $r->free();
	    return $res;
	}
	else
	{
        $r->free();
	    return 0;
	}
}

function sqlSel($sql) {
    global $db;
    $params=func_get_args();
    unset($params[0]);
    $sql=preparaSQL($sql, $params);

    $res = $db->query($sql);
    if (!$res) return 0;
    return $res;
}

function preparaSQL($sql,$array_param){
    global $db;
    foreach ($array_param as $k => $v){
      $array_param[$k]=$db->real_escape_string($v);
    }
    return vsprintf(str_replace("?","'%s'",$sql),$array_param);
}

function age($bMonth,$bDay,$bYear) {

	$cMonth = date('n');
	$cDay = date('j');
	$cYear = date('Y');

	if(($cMonth >= $bMonth && $cDay >= $bDay) || ($cMonth > $bMonth)) {
		return ($cYear - $bYear);
	} else {
		return ($cYear - $bYear - 1);
	}
}

?>

