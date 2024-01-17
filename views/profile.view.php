<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="../css/styles.css" rel="stylesheet" type="text/css">
		<link href="../css/profile.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<!-- This page must contain user profile picture and name. -->
		<?php require('partials/nav.php'); ?>
		<div class="container">
			<h1>Profile Page</h1>
			<?php if (empty($errors)): ?>
				<div class="profile">
					<div class="profile-picture">
						<img height="150px" width="150px" src="<?php echo $userData['profile_pic']; ?>" alt="Profile Picture">
					</div>
					<div class="profile-info">
						<div class="profile-name">
							<h2>Username: <?php echo $userData['username']; ?></h2>
						</div>
						<?php if ($isOwner): ?>
							<div class="edit-profile">
								<a href="edit_profile.php">Edit Profile</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if (!empty($errors)): ?>
				<div class="errors">
					<?php foreach ($errors as $error): ?>
						<p><?php echo $error; ?></p>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</body>
</html>