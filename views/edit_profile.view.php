<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Profile</title>
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    require('partials/nav.php');
    ?>
        <h2>Edit Profile</h2>
        <form action="updateProfile.php" method="post" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>">
            <br>
            <input type="submit" value="Update Profile">
        </form>
        <?php
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<p class='error'>$error</p>";
            }
            unset($_SESSION['errors']);
        }
        ?>
</body>
</html>