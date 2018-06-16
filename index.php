<?php
include 'session.php';

check_login(true);

if(isset($_POST['logout']))
{
	logout();
}
?>

<!DOCTYPE html>
<html lang="fr" class="indexHTML">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="Author" content="Quentin Lowette" />
		
		<link rel="stylesheet" href="style.css" type="text/css" />

		<title>Raspberry Pi</title>
	</head>
	
	<body>
		<?php
		include 'interface.php';
		?>
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
			<input id="tab0" type="radio" name="menu" checked />
			<div class="tab">
				<label class="menuItem" for="tab0">Home</label>
				<div class="pan">
					<h2>Raspberry Pi Admin Interface</h2>
					<?php
						printRasp();
					?>
				</div>
			</div>
			<input id="tab1" type="radio" name="menu" />
			<div class="tab">
				<label class="menuItem" for="tab1">Files</label>
				<div class="pan">
					<h2>Files</h2>
					<?php
						printFiles('/var/www/html');
					?>
				</div>
			</div>
			<input id="tab2" type="radio" name="menu" />
			<div class="tab">
				<label class="menuItem" for="tab2">phpMyAdmin</label>
				<div class="pan">
					<h2>phpMyAdmin</h2>
					<?php
						printPHPMA();
					?>
				</div>
			</div>
			<input id="tab3" type="radio" name="menu" />
			<div class="tab">
				<label class="menuItem" for="tab3">System</label>
				<div class="pan">
					<h2>System</h2>
					<?php
						printSystem();
					?>
				</div>
			</div>
		</div>
	</body>
</html>