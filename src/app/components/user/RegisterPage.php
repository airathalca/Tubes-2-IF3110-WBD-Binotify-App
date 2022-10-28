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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/register.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
    </script>
    <!-- JavaScript Library -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/register.js" defer></script>
    <title>Register</title>
</head>

<body>
    <div class="white-body">
        <div class="wrapper-small">
            <main class="pad-40">
                <header class="registration-header">
                    <img src="<?= BASE_URL ?>/images/assets/logo-dark.svg" alt="Binotify Logo">
                    <p>Sign up for free to start listening.</p>
                </header>
                <form class="registration-form">
                    <div class="form-group">
                        <label for="full-name">What's your full name?</label>
                        <input type="text" name="fullname" placeholder="Enter your fullname." id="fullname">
                        <p id="fullname-alert" class="alert-hide"></p>
                    </div>
                    <div class="form-group">
                        <label for="username">What's your username?</label>
                        <input type="text" name="username" placeholder="Enter your username." id="username">
                        <p id="username-alert" class="alert-hide"></p>
                    </div>
                    <div class="form-group">
                        <label for="email">What's your email?</label>
                        <input type="email" name="email" placeholder="Enter your email." id="email">
                        <p id="email-alert" class="alert-hide"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">Pick a password!</label>
                        <input type="password" name="password" placeholder="Enter your password." id="password" autocomplete="on">
                        <p id="password-alert" class="alert-hide"></p>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm your password!</label>
                        <input type="password" name="confirm-password" placeholder="Enter your password again." id="confirm-password" autocomplete="on">
                        <p id="confirm-password-alert" class="alert-hide"></p>
                    </div>
                    <div class="form-button">
                        <button type="submit" class="button black-button">Sign up</button>
                    </div>
                </form>
                <div class="form-hyperlink">
                    <p>Have an account? <a href="<?= BASE_URL ?>/user/login">Log in</a>.</p>
                </div>
            </main>
        </div>
    </div>
</body>

</html>