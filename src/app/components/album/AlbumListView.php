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
        <div class="wrapper">
            <!-- Navigation bar -->
            <nav class="black-navbar">
                <div class="pad-40">
                    <div class="flex-between">
                        <button class="toggle" id="toggle">
                            <img src="<?= BASE_URL ?>/images/assets/bars.svg" alt="Bars">
                        </button>
                        <a href="/public/home">
                            <img src="<?= BASE_URL ?>/images/assets/logo-light.svg" alt="Logo Spotipi">
                        </a>
                    </div>
                </div>
                <?php
                if (!$this->data['username'] || !$this->data['is_admin']) : ?>
                    <div class="nav-container" id="nav-container">
                        <div class="nav-search">
                            <form action="<?= BASE_URL ?>/song/search" METHOD="GET">
                                <label for="search">Enter song/title/artist/published year to search!</label>
                                <div class="search-input">
                                    <input type="text" placeholder="YOASOBI" name="q">
                                    <button type="submit">
                                        <img src="<?= BASE_URL ?>/images/assets/search.svg" alt="Search icon">
                                    </button>
                                </div>
                            </form>
                        </div>
                        <a href="/public/album" class="nav-link">
                            Album list
                        </a>
                        <?php
                        if ($this->data['username']) : ?>
                            <a href="#" id="log-out" class="nav-link">
                                Log out
                            </a>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <div class="nav-container" id="nav-container">
                        <a href="/public/song/add" class="nav-link">
                            Add song
                        </a>
                        <a href="/public/album/add" class="nav-link">
                            Add album
                        </a>
                        <a href="/public/album" class="nav-link">
                            Album list
                        </a>
                        <a href="/public/user" class="nav-link">
                            User List
                        </a>
                        <a href="#" id="log-out" class="nav-link">
                            Log out
                        </a>
                    </div>
                <?php endif; ?>
            </nav>
            <!-- Main -->
            <div class="pad-40">
                <p class="album-list-header">Albums available on Spotipi</p>
                <?php if (!$this->data['albums']) : ?>
                    <p class="info">There are no albums yet available on Spotipi!</p>
                <?php else : ?>
                    <div class="albums-list">
                        <?php foreach ($this->data['albums'] as $album) : ?>
                            <a href="/public/album/detail/<?= $album->album_id ?>" class="single-album">
                                <img src="<?= STORAGE_URL ?>/images/<?= $album->image_path ?>" alt="<?= $album->judul ?>">
                                <header class="album-header">
                                    <p class="title"><?= $album->judul ?></p>
                                    <p><?= $album->penyanyi ?></p>
                                </header>
                                <div class="album-dategenre">
                                    <p><?= substr($album->tanggal_terbit, 0, 4) ?></p>
                                    <p><?= $album->genre ?></p>
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