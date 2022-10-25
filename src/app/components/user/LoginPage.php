<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <link rel="manifest" href="<?= BASE_URL ?>/images/icon/site.webmanifest">
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/globals.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/login.css">
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/login.js" defer></script>
    <title>Spotipi</title>
</head>

<body>
    <header></header>
    <nav></nav>
    <main>
        <article>
            <form action="<?= BASE_URL ?>/user/login" method="POST">
                <input type="text" id="username" name="username" placeholder="Enter Username">
                <input type="password" id="password" name="password" placeholder="Enter Password" autocomplete="on">
                <input type="checkbox" id="remember_me" name="remember_me" value="checked">
                <label for="remember_me">Remember Me</label>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                <input type="submit" value="Login">
            </form>
        </article>
        <aside></aside>
    </main>
    <footer></footer>
</body>

</html>