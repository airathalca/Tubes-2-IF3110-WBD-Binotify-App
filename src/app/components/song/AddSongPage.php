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
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/song/add-song.css">
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <script src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <script src="<?= BASE_URL ?>/javascript/song/add-song.js" defer></script>
    <title>Add Song</title>
</head>

<body>
    <div class="black-body">
        <div class="wrapper">
            <nav class="black-navbar">
                <div class="pad-40">
                    <button class="toggle" id="toggle">
                        <img src="<?= BASE_URL ?>/images/assets/bars.svg" alt="Bars">
                    </button>
                </div>
                    <div class="nav-container" id="nav-container">
                        <a href="<?= BASE_URL?>/album/add" class="nav-link">
                            Add album
                        </a>
                        <a href="<?= BASE_URL?>/album" class="nav-link">
                            Album list
                        </a>
                        <a href="#" id="log-out" class="nav-link">
                            Log out
                        </a>
                    </div>
                </nav>
            <div class="pad-40">
                <p class="form-header">Add a song</p>
                <form action="/public/song/add?csrf_token=<?=$_SESSION['csrf_token']?>" method="post" enctype="multipart/form-data" class="form">
                    <div class="form-group">
                        <label for="title">Song title</label>
                        <input type="text" name="title" id="title" placeholder="Becak Tiguling">
                    </div>
                    <div class="form-group">
                        <label for="artist">Artist</label>
                        <input type="text" name="artist" id="artist" placeholder="aira">
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
                        <label for="album">Album</label>
                        <select name="album" id="album">
                            <option value="NULL">N/A</option>
                            <?php foreach ($this->data['album_arr'] as $index => $album ) : ?>
                                <option value=<?= $album->album_id ?>><?= $album->judul ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cover">Song File</label>
                        <input type="file" name="audio" id="audio" accept="audio/mpeg">
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover photo</label>
                        <input type="file" name="cover" id="cover" accept="image/png, image/jpeg">
                    </div>
                    <button class="button green-button">Add song to database</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>