<?php
@session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username']))
	die("Oops");
	
function Secure($str){if(is_array($str))foreach($str AS $id => $value)$str[$id]=Secure($value);else$str = SanityCheck($str);return $str;}
function SanityCheck($str){if(strpos(str_replace("''",""," $str"),"'") != false) return str_replace("'", "''", $str);else return $str;}
if(isset($_POST)){$xweb_AI = array_keys($_POST);$count = count($xweb_AI);for($i=0; $i < $count; $i++)$_POST[$xweb_AI[$i]] = Secure($_POST[$xweb_AI[$i]],true);unset($xweb_AI);}

$login = $_SESSION['username'];

$ip = $_POST['ip'];
if(strlen($ip) > 15)
	die("IP < 15 Number");
	
$serial = $_POST['serial'];
if(!ctype_alnum($serial) || strlen($serial) != 16)
	die("Serial 16 number");
	
$port = $_POST['port'];
if($port < 1 || $port > 65535)
	die("Port Connect Server 1 -> 65535");
	
$mainCRC = $_POST['mainCRC'];
if(strlen($mainCRC) > 0 && strlen($mainCRC) != 7)
	die("CRC Main");
	
$window = $_POST['window'];
$ss = str_replace("\\\\","\\",$_POST['ss']);
$rf = $_POST['rfbt'];
$instances = $_POST['instances'];

$ipArr = array();
$serialArr = array();
$windowArr = array();
$ssArr = array();
$instancesArr = array();
$loginArr = array();
$portArr = array();
$rfArr = array();
$mainCRCArr = array();

$fileContent = "";

//Encrypt Window Name
for($n=0;$n < 32;$n++)
{
	$windowArr[$n] = dechex( ord($window[$n]) ^ 0xD6);
	$fileContent .= chr(hexdec($windowArr[$n]));
}

//Encrypt ScreenShot
for($n=0;$n < 128;$n++)
{
	$ssArr[$n] = dechex( ord($ss[$n]) ^ 0xC3);
	$fileContent .= chr(hexdec($ssArr[$n]));
}

//Encrypt IP
for($n=0;$n < 15;$n++)
{
	$ipArr[$n] = dechex( ord($ip[$n]) ^ 0xB1);
	$fileContent .= chr(hexdec($ipArr[$n]));
}

//Encrypt login
for($n=0;$n < 15;$n++)
{
	$loginArr[$n] = dechex( ord($login[$n]) ^ 0xA8);
	$fileContent .= chr(hexdec($loginArr[$n]));
}

//Encrypt instances
$instancesArr[0] = dechex( ord($instances[0]) ^ 0x65);
$fileContent .= chr(hexdec($instancesArr[0]));

//Encrypt Port
for($n=0;$n < 5;$n++)
{
	$portArr[$n] = dechex( ord($port[$n]) ^ 0x91);
	$fileContent .= chr(hexdec($portArr[$n]));
}

//Encrypt RF
$rfArr[0] = dechex( ord($rf[0]) ^ 0x73);
$fileContent .= chr(hexdec($rfArr[0]));

//Encrypt serial
for($n=0;$n < 16;$n++)
{
	$serialArr[$n] = dechex((ord($serial[$n]) ^ 0xA9));
	$fileContent .= chr(hexdec($serialArr[$n]));
}

//Encrypt main CRC
//Encrypt Pro Guard CRC
for($n=0;$n < 8;$n++)
{
	$mainCRCArr[$n] = dechex( ord($mainCRC[$n]) ^ 0xD3);
	$fileContent .= chr(hexdec($mainCRCArr[$n]));
}

$con = @mysql_connect("localhost","mutrixco_license","T#VH)k{t9t&[");
$db = @mysql_select_db("mutrixco_user",$con);

$ss = addslashes($ss);

$query = @mysql_query("SELECT client FROM mains6 WHERE client = '". $_SESSION['username'] ."'");
if(@mysql_num_rows($query) > 1)
	$go = @mysql_query("UPDATE mains6 SET ip = '$ip', title = '$window', screens = '$ss', port = '$port', rf = '$rf', maincrc = '$mainCRC', serial = '$serial' WHERE client = '". $_SESSION['username'] ."'");
else
	$go = @mysql_query("INSERT INTO mains6 (client, ip, title, screens, port, rf, mainCRC, serial) VALUES ('". $_SESSION['username'] ."', '$ip', '$window', '$ss', '$port', '$rf', '$mainCRC', '$serial')");
	
if(!is_dir("./" . $_SESSION['username']))
{
	mkdir($_SESSION['username'],0777);
}

$file = fopen("./" . $_SESSION['username'] . "/license.info","wb");
fwrite($file,$fileContent);
fclose($file);

echo "Right Click -> Save Link As.<br \><br \>
<a href='./" . $_SESSION['username'] . "/license.info'> Download </a>";

?>