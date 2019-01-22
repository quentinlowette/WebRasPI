<?php
include 'scripts/session.php';

check_login(true);

include 'scripts/interface.php';
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="Author" content="Quentin Lowette" />
		
		<link rel="stylesheet" href="/WebRasPI/style.css" type="text/css" />
		<link rel="stylesheet" href="/WebRasPI/system.css" type="text/css" />

		<title>Raspberry Pi</title>
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
					printSystem();
				?>
			</div>
		</div>
	</body>
</html>