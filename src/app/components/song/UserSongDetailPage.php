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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/aside.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/song/song-detail.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const SONG_COUNT = "<?= $_SESSION['song_count'] ?? 0 ?>";
        const MAX_SONG_COUNT = "<?= MAX_SONG_COUNT ?>";
        const username = "<?= $this->data['username'] ?? '' ?>";
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/song/play-song.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>
        <?php if (isset($this->data['judul'])) : ?>
            <?= $this->data['judul'] ?>
        <?php else : ?>
            Song not found
        <?php endif; ?>
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
                <h1 class="details-header">Song details</h1>
                <?php if (isset($this->data['song_id'])) : ?>
                    <div class="song-flex">
                        <img src="<?= STORAGE_URL ?>/images/<?= $this->data['image_path'] ?>" alt="Song cover" class="song-cover">
                        <div class="song-details">
                            <h1 class="song-title"><?= $this->data['judul'] ?></h1>
                            <p class="song-artist"><?= $this->data['penyanyi'] ?> ● <?= $this->data['genre'] ?> ● <?= date('d F Y', strtotime($this->data['tanggal_terbit'])) ?> ● <?= floor(((int) $this->data['duration']) / 60) . " min " . ((int) $this->data['duration']) % 60 . " sec" ?></p>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    <?php if ($this->data['album'] === NULL) : ?>
                        <p class="info">This song doesn't belong to any album yet!</p>
                    <?php else : ?>
                        <a href="<?= BASE_URL ?>/album/detail/<?= $this->data['album'] ?>" class="button button-album">See album!</a>
                    <?php endif; ?>
                    <div class="audio-player-container">
                        <!-- <p class="audio-info"><?= $this->data['judul'] ?> by <?= $this->data['penyanyi'] ?></p> -->
                        <div class="player-button">
                            <div class="button-play">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path fill="#000000" d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z" />
                                </svg>
                            </div>
                            <div class="button-pause">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path fill="#000000" d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z" />
                                </svg>
                            </div>
                        </div>
                        <div class="progress-bar-container">
                            <p id="curr-duration">0:00</p>
                            <input type="range" name="progress-bar" id="progress-bar" step="0.01" value="0">
                            <p id="final-duration"><?= floor($this->data['duration'] / 60) ?>:<?= str_pad($this->data['duration'] % 60, 2, "0") ?></p>
                        </div>
                        <div class="hide-player">
                            <audio controls class="audio-player">
                                <source src="<?= STORAGE_URL ?>/songs/<?= $this->data['audio_path'] ?>">
                            </audio>
                        </div>
                    </div>
                <?php else : ?>
                    <p class="info">Cannot find the song you're looking for!</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>

</html>