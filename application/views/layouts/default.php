<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo $template['title']; ?></title>
		<?php echo $template['metadata']; ?>		
	</head>
	<body>
		<div id="wrapper">
			<?php echo $template['partials']['navigation']; ?>
			<?php echo $template['body']; ?>
		</div>
	</body>
</html>