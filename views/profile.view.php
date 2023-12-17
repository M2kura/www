<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile Page</title>
	<link href="../css/styles.css" rel="stylesheet" type="text/css">
	<link href="../css/profile.css" rel="stylesheet" type="text/css">
</head>
<body>
	<nav>
		<!-- Navigation bar can go here -->
	</nav>
	<main>
		<h2>Profile Page</h2>
		<div class="profile-info">
			<img src="profile-picture.jpg" alt="Profile Picture" width="150" height="150">
			<p>Email: <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></p>
			<p>Password: <?= htmlspecialchars($password, ENT_QUOTES, 'UTF-8') ?></p>
			<button onclick="window.location.href = '../php/edit_profile.php';">Edit Profile</button>
		</div>
	</main>
	<footer>
		<!-- Footer can go here -->
	</footer>
</body>
</html>