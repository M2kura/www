<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="../css/styles.css" rel="stylesheet" type="text/css">
        <link href="../css/home.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">

		<?php require('partials/nav.php'); ?>
		
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['username']?>!</p>
		</div>
		<div class="search">
			<form id="searchForm">
				<input type="text" name="search" id="searchInput" placeholder="Search for users">
				<input type="submit" value="Search">
			</form>
		</div>
		<div class="users">

		</div>
		<button id="loadMore">Load More Users</button>
		<script src="../js/loadUsers.js"></script>
		<script src="../js/searchUsers.js"></script>
	</body>
</html>