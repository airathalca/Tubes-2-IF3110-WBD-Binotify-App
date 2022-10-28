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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/album/album-detail.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>
        <?php if (isset($this->data['judul'])) : ?>
            <?= $this->data['judul'] ?>
        <?php else : ?>
            Album not found
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
                <h1 class="details-header">Album details</h1>
                <?php if (isset($this->data['album_id'])) : ?>
                    <div class="album-detail-flex">
                        <img src="<?= STORAGE_URL ?>/images/<?= $this->data['image_path'] ?>" alt="Album cover" class="album-cover">
                        <div class="album-details">
                            <h1 class="album-title"><?= $this->data['judul'] ?></h1>
                            <p class="album-artist"><?= $this->data['penyanyi'] ?> ● <?= count($this->data['songs']) ?> songs, <?= $this->data['total_duration'] ?></p>
                        </div>
                    </div>
                    <div class="line-break"></div>
                    <p class="songs-list-header">Songs inside this album:</p>
                    <?php if (!$this->data['songs']) : ?>
                        <p class="info">This album doesn't have any songs yet!</p>
                    <?php endif; ?>
                    <?php if ($this->data['songs']) : ?>
                        <div class="songs-list">
                            <?php foreach ($this->data['songs'] as $song) : ?>
                                <a href="/public/song/detail/<?= $song->song_id ?>" class="single-song">
                                    <div class="song-top-section">
                                        <img src="<?= STORAGE_URL ?>/images/<?= $song->image_path ?>" alt="<?= $song->judul ?>">
                                        <p class="song-title"><?= $song->judul ?></p>
                                        <p class="song-genre"><?= $song->genre ?></p>
                                    </div>
                                    <div class="song-bottom-section">
                                        <p class="song-dateduration"><?= substr($song->tanggal_terbit, 0, 4) ?> - <?= floor($song->duration / 60) ?> min <?= $song->duration % 60 ?> sec</p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <p class="info">Cannot find the album you're looking for!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>