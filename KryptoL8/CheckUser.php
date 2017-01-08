<?php
require_once("MyDatabase.php");
/*
  Sprawdzanie użytkownika.
*/



$users = [
	["NICK"=>"STP","Imie"=>"Patryk","Nazwisko"=>"Niepatryk"], //qwerty
	["NICK"=>"K07","Imie"=>"Łomił","Nazwisko"=>"Sasadam"], //1234
	["NICK"=>"CRA","Imie"=>"Variusz","Nazwisko"=>"Niezmienny"] //abcd
];

if (!(isset($_POST['NICK']) and isset($_POST['pass']))){
	header("location: http://" . $_SERVER['HTTP_HOST'] . "/test/Blog.php");
	setcookie('NICK',  '');
	//header("location: http://" . $_SERVER['HTTP_HOST'] . "/test/Blog.php");
}


$NICK = htmlspecialchars((string)$_POST['NICK']);
$PASS = htmlspecialchars((string)$_POST['pass']);
$token =(string)$_POST['token'];;
$token2 = $_SESSION['login_token'];
 session_start();
 unset($_SESSION['login_token']);
 session_write_close();
 if($token == $token) {
	$salt = substr($NICK, 0, -1);
	$pw_hash = sha1($salt.$PASS);
	$db = myDB();
	$q = "SELECT Nick, Pwd FROM accounts WHERE Nick = '$NICK' AND Pwd = '$pw_hash'";
	$result = $db->query($q);
	if ($result && $row = $result->fetch_assoc()) {
			$_SESSION['NICK'] = $NICK;
			setcookie('NICK',    $NICK);
			header("location: http://" . $_SERVER['HTTP_HOST'] . "/test/Blog.php");
			exit;
	}
	$db -> close();
}


header("location: http://" . $_SERVER['HTTP_HOST'] ."/test/Blog.php");

?>