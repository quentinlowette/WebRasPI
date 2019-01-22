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
<html lang="fr">
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