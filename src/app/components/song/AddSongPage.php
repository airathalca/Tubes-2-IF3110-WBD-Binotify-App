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
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/navbar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/aside.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/song/add-song.css">
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
    </script>
    <script src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <script src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>
    <script src="<?= BASE_URL ?>/javascript/song/add-song.js" defer></script>
    <title>Add Song</title>
</head>

<body>
    <div class="black-body">
        <!-- Aside -->
        <?php include(dirname(__DIR__) . '/template/Aside.php') ?>
        <div class="wrapper">
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <div class="pad-40">
                <p class="form-header">Add a song</p>
                <form action="/public/song/add?csrf_token=<?=$_SESSION['csrf_token']?>" method="post" enctype="multipart/form-data" class="form">
                    <div class="form-group">
                        <label for="title">Song title</label>
                        <input type="text" name="title" id="title" placeholder="LycoReco">
                        <p class="alert-hide" id="title-alert">Please fill out the song title first!</p>
                    </div>
                    <div class="form-group">
                        <label for="artist">Artist</label>
                        <input type="text" name="artist" id="artist" placeholder="Chisato">
                        <p class="alert-hide" id="artist-alert">Please fill out the song artist first!</p>
                    </div>
                    <div class="form-group">
                        <label for="date">Published date</label>
                        <input type="date" name="date" id="date">
                        <p class="alert-hide" id="date-alert">Please fill out the published date first!</p>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" name="genre" id="genre" placeholder="Rock">
                        <p class="alert-hide" id="genre-alert">Please fill out the song genre first!</p>
                    </div>
                    <div class="form-group">
                        <label for="album">Album</label>
                        <select name="album" id="album">
                            <option value="">N/A</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="audio">Song File</label>
                        <input type="file" name="audio" id="audio" accept="audio/mpeg">
                        <p class="alert-hide" id="audio-alert">Please upload a valid song file first!</p>
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover photo</label>
                        <input type="file" name="cover" id="cover" accept="image/png, image/jpeg">
                        <p class="alert-hide" id="cover-alert">Please upload a valid cover image first!</p>
                    </div>
                    <button class="button green-button">Add song to database</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>