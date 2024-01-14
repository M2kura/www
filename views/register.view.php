<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/register.css">
        <title>la galerie | Sign Up</title>
    </head>
    <body class="reg-body">
        <div class="register">
            <h1><span class="create">Create</span> <span class="your">your</span> <span class="account">account.</span></h1>
        </div>
        <div class="register-form">
            <form id="registerForm" method="post" action="register.php" autocomplete="off" enctype="multipart/form-data">
                <fieldset class="main-fieldset">
                    <legend class="legend"><input name="reg_user" class="submit" type="Submit" value="Sign Up"></legend>
                    <label for="username">Username*: <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required></label>
                    <label for="email">Email*: <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required></label>
                    <label for="password">Password*: <input type="password" id="password" name="password" autocomplete="new-password" required></label>
                    <label for="password">Confirm Password*: <input type="password" id="cpassword" name="cpassword" autocomplete="new-password" required></label>
                    <label for="profilePicture">Profile Picture: <input type="file" id="profilePicture" name="profilePicture"></label>
                </fieldset>
            </form>
        </div>
        <div class="prompts">
            <p>Already have an account? <a href="../index.php">Sign In</a></p>
            <?php
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<p class='error'>$error</p>";
                }
            }
            ?>
        </div>
    </body>
    <script src="../js/password_check.js"></script>
    <script src="../js/if_error_margin.js"></script>
</html>