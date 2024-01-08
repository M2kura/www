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
            <form method="post" action="register.php" autocomplete="off" enctype="multipart/form-data">
                <fieldset class="main-fieldset">
                    <legend class="legend"><input class="submit" type="Submit" value="Sign Up"></legend>
                    <label for="username">Username: <input type="text" id="username" name="username" required></label>
                    <label for="password">Password: <input type="password" id="password" name="password" autocomplete="new-password" required></label>
                    <label for="email">Email: <input type="email" id="email" name="email" required></label>
                    <label for="profilePicture">Profile Picture: 
                        <input type="file" id="profilePicture" name="profilePicture" accept="image/*">
                    </label>
                </fieldset>
            </form>
        </div>
        <div>
            <p>Already have an account? <a href="../index.html">Sign In</a></p>
            <?php if (!empty($message)) : ?>
                <p class="success"><?= $message ?></p>
            <?php endif; ?>
        </div>
    </body>
</html>