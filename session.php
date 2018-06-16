<?php

define('INACTIVITY_TIMEOUT', 3600);

session_start();

function check_auth($password)
{
	$password=hash('ripemd160',$password);
	if($password!="c61ed694ca319e22ac621dd053cce83609d7accb")
	{
		return false;
	}
	
	$_SESSION['password'] = $password;
	$_SESSION['timeout'] = time()+INACTIVITY_TIMEOUT;
	return true;
}

function check_login($redirect=true)
{
	$login=false;
	
	if(isset($_SESSION['password']) && $_SESSION['password'] && time()<$_SESSION['timeout'])
	{
		$_SESSION['timeout']=time()+INACTIVITY_TIMEOUT;
		$login=true;
	}
	
	if($redirect && !$login)
	{
		login();
	}
	else
	{
		return $login;
	}
}

function login()
{
	$_SESSION['initURL'] = $_SERVER['REQUEST_URI'];
	Header("location: login.php");
	exit();
}

function logout()
{
	unset($_SESSION['login'],$_SESSION['password'],$_SESSION['timeout']);
	session_destroy();
	Header("location: login.php");
    exit();
}