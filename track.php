<?php
ini_set('display_errors',1);

/*
//  Include file(once) which connects to your database and stores it in variable: global $db
//  e.g.
//
//  global $db;
//  $db = mysqli_connect("127.0.0.1","db_user_name","db_user_password","db_name");
*/
include_once('inc/common.inc.php');

// ***********************************
// *** DO NOT EDIT BELOW THIS LINE ***
// ***********************************
if (!isset($db)) {
	die("cerr"); //: " . mysqli_error());
}

if (session_id() == '') session_start();
if (!isset($_SESSION['tp_id']))
{
    $_SESSION['tp_id'] = $_SERVER['REMOTE_ADDR'];
}
$tp_id = $_SESSION['tp_id'];

//Sets up what is currently valid to track on this user session($tp_id)
class Track
{
    private $actions;
    
    function Track($action = null)
    {
        $this->actions = array();
        if ($action != null)
        {
            $this->actions[$action] = True;
        }
        $_SESSION['tp_actions'] = $this->actions;
    }
    
    public function add($action = "Default Action")
    {
        $this->actions[$action] = True;
        $_SESSION['tp_actions'] = $this->actions;
    }
    
    // This can be re-defined to represent a user's unique id, e-mail in table.
    public function id($id)
    {
        global $tp_id;
        $_SESSION['tp_id'] = $id;
        $tp_id = $id;
    }
}
if (isset($_REQUEST['Track']) && isset($_SESSION['tp_actions']))
{
    $tp_action = $_REQUEST['Track'];
    $tp_actions = $_SESSION['tp_actions'];
    //Verify this user's posted action to track is currently allowed and valid
    if (isset($tp_actions[$tp_action]) && $tp_actions[$tp_action])
    {
        $q = $db->query("SHOW TABLES LIKE 'tp_a_$tp_action'");
        if ($q->num_rows < 1)
        { // Create table for this action
            $q = $db->query("CREATE TABLE IF NOT EXISTS `tp_a_$tp_action` (`id` varchar(45) NOT NULL,`cnt` int(10) NOT NULL,`ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        }
        $q = $db->prepare("INSERT INTO `tp_a_$tp_action` (id,cnt,ts) VALUES (?,1,now()) ON DUPLICATE KEY UPDATE cnt=cnt+1,ts=now()");
        $q->bind_param('s',$tp_id);
        $q->execute();
        $q->close();
    }
}
if (basename($_SERVER["SCRIPT_NAME"]) != "track.php")
{
?>
<script type="text/javascript">
function track(action){$.post('track.php',{Track:action},function (html) { if (html == "cerr") alert("Error connecting to database(global $db)."); });}
</script>
<?php
}
?>