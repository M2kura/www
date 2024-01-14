<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="../css/styles.css" rel="stylesheet" type="text/css">
        <link href="../css/home.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin">

		<?php require('partials/nav.php'); ?>
		
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['username']?>!</p>
		</div>
	</body>
</html>