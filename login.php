<?php
include 'scripts/session.php';

$message=0;
if(isset($_POST['submit']))
{
	if(isset($_POST['password']) && $_POST['password']!='')
	{
		if(check_auth($_POST['password']))
		{
			if(isset($_SESSION['initURL']))
			{
				$url = $_SESSION['initURL'];
				unset($_SESSION['initURL']);
				Header('location: '.$url);
			}
			else
			{
				Header("location: /WebRasPI/index.php");
			}
		}
		else
		{
			$message=1;
		}
	}
	else
	{
		$message=2;
	}
}
else
{
	if(check_login(false))
	{
		Header("location: /WebRasPi/index.php");
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="Author" content="Quentin Lowette" />
		
		<link rel="stylesheet" href="/WebRasPI/style.css" type="text/css" />
		<link rel="stylesheet" href="/WebRasPI/login.css" type="text/css" />

		<title>Raspberry Pi</title>
	</head>
	
	<body>
		<?php
			if($message==1)
			{
				echo '<p class="error">Wrong Password</p>';
			}
			elseif($message==2)
			{
				echo '<p class="error">Please enter a password</p>';
			}
		?>
		<h1>Raspberry Pi</h1>
		<form method="post" action="login.php" class="loginForm">
			<input type="password" name="password" class="pwd" autofocus />
			<input type="submit" name="submit" value="Connection" class="submit"/>
		</form>
	</body>
</html>