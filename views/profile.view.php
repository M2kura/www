<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile Page</title>
	<link href="../css/styles.css" rel="stylesheet" type="text/css">
	<link href="../css/profile.css" rel="stylesheet" type="text/css">
</head>
<body>
 <!-- This page must contain user profile picture and name. Below this there's a space with the form that have a user friendly interface where user can upload couple of photos and arange them around this space. Later, at the home page of the website there will be a lost of all pages like that and other user will be able to go checl other people pages. -->
	<?php require('partials/nav.php'); ?>
	<div class="container">
		<h1>Profile Page</h1>
		<div class="profile">
			<div class="profile-picture">
				<!-- here we take the path for the image from db field profile_pic -->
				<img src="<?php echo $userData['profile_pic']; ?>" alt="Profile Picture">
			</div>
		</div>
		<div class="profile-form">
			<form action="php/upload.php" method="post" enctype="multipart/form-data">
				<h2>Upload Images</h2>
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload Image" name="submit">
			</form>
		</div>
</body>
</html>