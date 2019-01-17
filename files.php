<?php
include 'scripts/session.php';

check_login(true);

if(isset($_POST['logout']))
{
	logout();
}

include 'scripts/interface.php';
?>

<!DOCTYPE html>
<html lang="fr" class="indexHTML">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="Author" content="Quentin Lowette" />
		
		<link rel="stylesheet" href="style.css" type="text/css" />
		<link rel="stylesheet" href="files.css" type="text/css" />

		<title>Files | Raspberry Pi</title>
	</head>
	
	<body>
		<div class="header">
				<h1>Raspberry Pi</h1>
				<?php
				$hostname = shell_exec('hostname');
				echo '<h3>('.trim($hostname).')</h3>';
				?>
			<form action="index.php" method="POST" class="logout">
				<input type="submit" name="logout" value="Log Out">
			</form>
		</div>

		<div class="content">
			<?php
				include 'sidebar.php'
			?>
			<div class="wrapper">
				<?php
					printFiles('/var/www/html');
				?>
			</div>
		</div>
	</body>
</html>