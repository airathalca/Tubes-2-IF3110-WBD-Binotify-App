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
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/album/add-album.css">
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <script src="<?= BASE_URL ?>/javascript/album/add-album.js" defer></script>
    <title>Add Album</title>
</head>

<body>
    <div class="black-body">
        <div class="wrapper">
            <!-- Navigation bar -->

            <!-- Form -->
            <div class="pad-40">
                <p class="form-header">Add an album</p>
                <form action="/public/album/add?csrf_token=<?php echo $_SESSION['csrf_token'] ?>" method="post" enctype="multipart/form-data" class="form">
                    <div class="form-group">
                        <label for="title">Album title</label>
                        <input type="text" name="title" id="title" placeholder="Lycoris Recoil OST">
                    </div>
                    <div class="form-group">
                        <label for="artist">Artist</label>
                        <input type="text" name="artist" id="artist" placeholder="Chisato">
                    </div>
                    <div class="form-group">
                        <label for="date">Published date</label>
                        <input type="date" name="date" id="date">
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" name="genre" id="genre" placeholder="Rock">
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover photo</label>
                        <input type="file" name="cover" id="cover" accept="image/png, image/jpeg">
                    </div>
                    <button class="button green-button">Add album to database</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>