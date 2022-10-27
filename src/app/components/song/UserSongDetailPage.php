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
        <!-- Aside -->
        <?php include(dirname(__DIR__) . '/template/Aside.php') ?>
        <div class="wrapper">
            <!-- Navigation bar -->
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <!-- Form -->
            <div class="pad-40">
                <p class="details-header">Song details</p>
                <?php if (isset($this->data['song_id'])) { ?>
                    <div class="song-flex">
                        <img src="<?= STORAGE_URL ?>/images/<?= $this->data['image_path'] ?>" alt="Song cover" class="song-cover">
                        <div class="song-details">
                            <h1 class="song-title"><?= $this->data['judul'] ?></h1>
                            <p class="song-artist"><?= $this->data['penyanyi'] ?> ● <?= $this->data['genre'] ?> ● <?= date('d F Y', strtotime($this->data['tanggal_terbit'])) ?> ● <?=floor(((int) $this->data['duration']) / 60) . " min " . ((int) $this->data['duration']) % 60 . " sec" ?></p>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    <?php if ($this->data['album'] === NULL) { ?>
                        <p class="info">This song doesn't belong to any album yet!</p>
                    <?php } else  { ?>
                        <a href="<?= BASE_URL?>/album/detail/<?= $this->data['album']?>" class="button button-album">See album!</a>
                    <?php } ?>
                    <div class="audio-player-container">
                        <p class="audio-info"><?= $this->data['judul'] ?> by <?= $this->data['penyanyi'] ?></p>
                        <audio controls class="audio-player">
                            <source src="<?= STORAGE_URL?>/songs/<?=$this->data['audio_path']?>">
                        </audio>
                    </div>
                <?php } else { ?>
                    <p class="info">Cannot find the song you're looking for!</p>
                <?php } ?>
                
            </div>
        </div>
    </div>
</body>

</html>