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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/album/album-list.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const STORAGE_URL = "<?= STORAGE_URL ?>";
        let pages = 0;
        <?php if ($this->data['pages']) : ?>
            pages = parseInt("<?= $this->data['pages'] ?>");
        <?php endif; ?>
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script src="<?= BASE_URL ?>/javascript/album/album-list.js" defer></script>
    <script src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>
        Album List
    </title>
</head>

<body>
    <div class="black-body">
        <!-- Aside -->
        <?php include(dirname(__DIR__) . '/template/Aside.php') ?>
        <div class="wrapper">
            <!-- Navigation bar -->
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <!-- Main -->
            <div class="pad-40">
                <h1 class="album-list-header">Albums available on Binotify</h1>
                <?php if (!$this->data['albums']) : ?>
                    <p class="info">There are no albums yet available on Binotify!</p>
                <?php else : ?>
                    <div class="albums-list">
                        <?php foreach ($this->data['albums'] as $album) : ?>
                            <a href="/public/album/detail/<?= $album->album_id ?>" class="single-album">
                                <div class="top-section">
                                    <img src="<?= STORAGE_URL ?>/images/<?= $album->image_path ?>" alt="<?= $album->judul ?>">
                                    <header class="album-header">
                                        <p class="title"><?= $album->judul ?></p>
                                        <p><?= $album->penyanyi ?></p>
                                    </header>
                                </div>
                                <div class="album-dategenre">
                                    <p><?= substr($album->tanggal_terbit, 0, 4) ?></p>
                                    <p class="genre"><?= $album->genre ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="pagination">
                        <p id="pagination-text">Page <span id="page-number">1</span> out of <?= $this->data['pages'] ?> pages</p>
                        <div class="pagination-buttons">
                            <button id="prev-page" disabled>
                                <img src="<?= BASE_URL ?>/images/assets/arrow-left.svg" alt="">
                            </button>
                            <button id="next-page" <?php if ($this->data['pages'] == 1) : ?> disabled <? endif; ?>>
                                <img src="<?= BASE_URL ?>/images/assets/arrow-right.svg" alt="">
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>