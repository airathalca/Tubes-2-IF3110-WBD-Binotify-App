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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/album/add-album.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/album/add-album.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>Add Album</title>
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
                <h1 class="form-header">Add an album</h1>
                <form action="/public/album/add?csrf_token=<?php echo $_SESSION['csrf_token'] ?>" method="post" enctype="multipart/form-data" class="form">
                    <div class="form-group">
                        <label for="title">Album title</label>
                        <input type="text" name="title" id="title" placeholder="Lycoris Recoil OST">
                        <p class="alert-hide" id="title-alert">Please fill out the album title first!</p>
                    </div>
                    <div class="form-group">
                        <label for="artist">Artist</label>
                        <input type="text" name="artist" id="artist" placeholder="Chisato">
                        <p class="alert-hide" id="artist-alert">Please fill out the artist name first!</p>
                    </div>
                    <div class="form-group">
                        <label for="date">Published date</label>
                        <input type="date" name="date" id="date">
                        <p class="alert-hide" id="date-alert">Please fill out the published date first!</p>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" name="genre" id="genre" placeholder="Rock">
                        <p class="alert-hide" id="genre-alert">Please fill out the album genre first!</p>
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover photo</label>
                        <input type="file" name="cover" id="cover" accept="image/png, image/jpeg">
                        <p class="alert-hide" id="cover-alert">Please upload a valid cover photo first!</p>
                    </div>
                    <button class="button green-button">Add album to database</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>