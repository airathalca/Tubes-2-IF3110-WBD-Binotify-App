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
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/song/song-detail.css">
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const SONG_COUNT = "<?= $_SESSION['song_count'] ?? 0 ?>";
        const MAX_SONG_COUNT = "<?= MAX_SONG_COUNT ?>";
        const username = "<?= $this->data['username'] ?? '' ?>";
        const songId = "<?= $this->data['song_id'] ?? '' ?>";
    </script>
    <script src="<?= BASE_URL ?>/javascript/song/play-song.js" defer></script>
    <script src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>
        <?php if ($this->data) { ?>
            <?= $this->data['judul'] ?>
        <?php } else { ?>
            Song Not Found
        <?php } ?>
    </title>
</head>

<body>
    <div class="black-body">
        <div class="wrapper">
            <!-- Navigation bar -->
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <!-- Form -->
            <div class="pad-40">
                <p class="details-header">Song details</p>
                <?php if ($this->data) { ?>
                    <img src="<?= STORAGE_URL ?>/images/<?= $this->data['image_path'] ?>" alt="Song cover" class="song-cover">
                    <p class="song-title"><?= $this->data['judul'] ?></p>
                    <p class="song-artist"><?= $this->data['penyanyi'] ?></p>
                    <p class="song-genre"><?= $this->data['genre'] ?></p>
                    <p class="song-dateduration"><?= $this->data['tanggal_terbit'] ?> - <?=$this->data['duration']?></p>
                    <?php if ($this->data['album'] === NULL) { ?>
                        <p class="info">This song doesn't belong to any album yet!</p>
                    <?php } else  { ?>
                        <a href="<?= BASE_URL?>/album/detail/<?= $this->data['album']?>" class="button button-album">See album!</a>
                    <?php } ?>
                    <audio controls class="audio-player">
                        <source src="<?= STORAGE_URL?>/songs/<?=$this->data['audio_path']?>">
                    </audio>
                <?php } else { ?>
                    <p class="info">Cannot find the song you're looking for!</p>
                <?php } ?>
                
            </div>
        </div>
    </div>
</body>

</html>