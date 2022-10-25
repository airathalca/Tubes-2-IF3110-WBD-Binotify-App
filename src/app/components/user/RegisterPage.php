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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/register.css">
    <!-- JavaScript Constant -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/register.js" defer></script>
    <title>Register</title>
</head>

<body>
    <!-- Kelas terluar menyatakan warna latarnya -->
    <div class="white-body">
        <!-- Konten utama dari halaman harus memiliki wrapper -->
        <div class="wrapper">
            <div class="pad-40">
                <main>
                    <!-- Contoh konten untuk halaman registrasi -->
                    <header class="registration-header">
                        <img src="<?= BASE_URL ?>/images/assets/logo-dark.svg" alt="Spotipi Logo">
                        <p>Sign up for free to start listening.</p>
                    </header>
                    <form class="registration-form">
                        <div class="form-group">
                            <!-- Sebuah form terdiri atas label dan inputnya -->
                            <label for="username">What's your username?</label>
                            <input type="text" name="username" placeholder="johndoe" id="username">
                        </div>
                        <div class="form-group">
                            <!-- Sebuah form terdiri atas label dan inputnya -->
                            <label for="email">What's your email?</label>
                            <input type="email" name="email" placeholder="john@doe.com" id="email">
                        </div>
                        <div class="form-group">
                            <!-- Sebuah form terdiri atas label dan inputnya -->
                            <label for="password">Pick a password!</label>
                            <input type="password" name="password" placeholder="●●●●●●" id="password" autocomplete="on">
                        </div>
                        <div class="form-group">
                            <!-- Sebuah form terdiri atas label dan inputnya -->
                            <label for="confirm_password">Confirm your password!</label>
                            <input type="password" name="confirm_password" placeholder="●●●●●●" id="confirm_password" autocomplete="on">
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
    </div>
</body>

</html>