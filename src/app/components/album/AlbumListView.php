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
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/album/album-list.css">
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const STORAGE_URL = "<?= STORAGE_URL ?>";
        let pages = 0;
        <?php if ($this->data['pages']) { ?>
            pages = "<?= $this->data['pages'] ?>"
        <?php } ?>
    </script>
    <script src="<?= BASE_URL ?>/javascript/album/album-list.js" defer></script>
    <title>
        Album List
    </title>
</head>

<body>
    <div class="black-body">
        <div class="wrapper">
            <!-- Navigation bar -->

            <!-- Form -->
            <div class="pad-40">
                <p class="album-list-header">Albums available on Spotipi</p>
                <?php if (!$this->data['albums']) { ?>
                    <p class="info">There are no albums yet available on Spotipi!</p>
                <?php } else { ?>
                    <div class="albums-list">
                        <?php foreach($this->data['albums'] as $album) { ?>
                            <a href="/public/album/detail/<?= $album->album_id ?>" class="single-album">
                                <img src="<?= STORAGE_URL ?>/images/<?= $album->image_path ?>" alt="<?= $album->judul ?>">
                                <header class="album-header">
                                    <p class="title"><?= $album->judul ?></p>
                                    <p><?= $album->penyanyi ?></p>
                                </header>
                                <div class="album-dategenre">
                                    <p><?= $album->tanggal_terbit ?></p>
                                    <p><?= $album->genre ?></p>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="pagination">
                        <p id="pagination-text">Page <span id="page-number">1</span> out of <?= $this->data['pages'] ?> pages</p>
                        <div class="pagination-buttons">
                            <button id="prev-page" disabled>
                                <img src="<?= BASE_URL ?>/images/assets/arrow-left.svg" alt="">
                            </button>
                            <button id="next-page" <?php if ($this->data['pages'] == 1) {?> disabled <? } ?>>
                                <img src="<?= BASE_URL ?>/images/assets/arrow-right.svg" alt="">
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>