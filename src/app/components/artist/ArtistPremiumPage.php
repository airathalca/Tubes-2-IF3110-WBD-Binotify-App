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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/aside.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/artist/artist-premium.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        <?php if (isset($this->data['redirect'])) { ?>
            location.replace("<?= $this->data['redirect'] ?>")
        <?php } ?>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const USERNAME = "<?= $this->data['username'] ?? '' ?>";
        <?php if (isset($_SESSION['user_id'])) { ?>
            const USER_ID = <?= $_SESSION['user_id'] ?>;
        <?php } ?>
        const REST_URL = "<?= REST_URL ?>";
        const SOAP_URL = "<?= SOAP_URL ?>";
        const SOAP_KEY = "<?= SOAP_KEY ?>"
        const POLLING_INTERVAL = parseInt("<?= POLLING_INTERVAL ?>");
    </script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/xmlToJson.js" defer></script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/artist/artist-premium.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>
        Artist Premium
    </title>
</head>

<body>
    <div class="black-body">
        <!-- Aside -->
        <?php include(dirname(__DIR__) . '/template/Aside.php') ?>
        <div class="wrapper">
            <!-- Navigation bar -->
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <!-- Form -->
            <div class="pad-40">
                <h1 class="details-header">Artist Premium</h1>
                <div class="line-break"></div>
                <div class="extra-padding">
                    <p class="error-text">No Artist Premium yet!</p>
                    <table class="artist-table">
                        <tr>
                        <th><p>#</p></th>
                        <th><p>Artist Name</p></th>
                        <th><p>Actions</p></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal">
            <div class="color-indicator"></div>
            <p class="modal-text">Subscription successful!</p>
        </div>
    </div>
</body>

</html>