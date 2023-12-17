<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css" />
        <title>la galerie | Sign Up</title>
    </head>
    <body>
        <div class="welcome">
            <h1>Sign Up</h1>
        </div>
        <div class="sign-in-form">
            <form method="post" action="register.php" autocomplete="off">
                <fieldset>
                    <legend class="legend"><input type="Submit" value="Sign Up"></legend>
                    <label for="username">Username: <input type="text" id="username" name="username" required /></label>
                    <label for="password">Password: <input type="password" id="password" name="password" autocomplete="new-password" required /></label>
                    <label for="email">Email: <input type="email" id="email" name="email" required /></label>
                </fieldset>
            </form>
        </div>
        <div>
            <p>Already have an account? <a href="index.php">Sign In</a></p>
            <?php if (!empty($message)) : ?>
                <p><?= $message ?></p>
            <?php endif; ?>
        </div>
    </body>
</html>