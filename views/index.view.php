<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/index.css">
        <title>la galerie</title>
    </head>
    <body>
        <div class="welcome">
            <h1>Welcome</h1>
        </div>
        <div class="sign-in-form">
            <form method="post" action="index.php">
                <fieldset>
                    <legend class="legend"><input type="Submit" value="Sign In"></legend>
                    <label for="username">Username: <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required></label>
                    <label for="password">Password: <input type="password" id="password" name="password" required></label>
                </fieldset>
                <div class="links">
                    <p class="sign-up"><a href="php/register.php">Sign up</a></p><p class="forgot"><a href="php/reset_password.php">Forget password?</a></p>
                </div>
                <div class="errors">
                    <?php
                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            echo "<p class='error'>$error</p>";
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </body>
    <!-- <script src="js/main.js"></script> -->
</html>