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
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/home/home.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script src="<?= BASE_URL ?>/javascript/home/home.js" defer></script>
    <title>Home Page</title>
</head>

<body>
    <div class="black-body">
        <!-- Aside -->
        <?php include(dirname(__DIR__) . '/template/Aside.php') ?>
        <div class="wrapper">
            <!-- Navbar -->
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <article>
                <div class="pad-40">
                    <p class="article-heading">Songs for you</p>
                    <?php if (!$this->data['song_arr']) : ?>
                        <p class="info">There are currently no songs available on Spotipi!</p>
                    <?php endif; ?>
                    <div class="songs-container">
                        <?php foreach ($this->data['song_arr'] as $index => $song) : ?>
                            <a href="/public/song/detail/<?= $song->song_id ?>" class="single-song">
                                <div class="top-section">
                                    <img src="<?= STORAGE_URL ?>/images/<?= $song->image_path ?>" alt="<?= $song->judul ?>">
                                    <header class="song-header">
                                        <p class="title"><?= $song->judul ?></p>
                                        <p><?= $song->penyanyi ?></p>
                                    </header>
                                </div>
                                <div class="song-dategenre">
                                    <p><?= substr($song->tanggal_terbit, 0, 4) ?></p>
                                    <p class="genre"><?= $song->genre ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </article>
        </div>
    </div>
</body>

</html>