<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <link rel="manifest" href="<?= BASE_URL ?>/images/icon/site.webmanifest">
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/globals.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/login.css">
    <!-- JavaScript Constant -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/login.js" defer></script>
    <title>Login</title>
</head>

<body>
    <div class="white-body">
        <div class="wrapper">
            <main class="pad-40">
                <header class="login-header">
                    <img src="<?= BASE_URL ?>/images/assets/logo-dark.svg" alt="Spotipi Logo">
                    <p>To continue, log in to Spotipi.</p>
                </header>
                <form class="login-form">
                    <div class="form-group">
                        <label for="username">What's your username?</label>
                        <input type="text" name="username" placeholder="Username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Enter your password!</label>
                        <input type="password" name="password" placeholder="Password" id="password" autocomplete="on">
                    </div>
                    <div class="form-button">
                        <button type="submit" class="button black-button">Log in</button>
                    </div>
                </form>
                <div class="form-hyperlink">
                    <p>Don't have an account? <a href="<?= BASE_URL ?>/user/register">Register</a>.</p>
                </div>
            </main>
        </div>
    </div>
</body>

</html>