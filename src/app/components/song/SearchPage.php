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
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/song/search.css">
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const STORAGE_URL = "<?= STORAGE_URL ?>";
        const BASE_URL = "<?= BASE_URL ?>";
        let pages = 0;
        <?php if ($this->data['pages']) { ?>
            pages = "<?= $this->data['pages'] ?>"
        <?php } ?>
    </script>
    <script src="<?= BASE_URL ?>/javascript/song/search.js" defer></script>
    <script src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>Search Page</title>
</head>

<body>
    <div class="black-body">
        <div class="wrapper">
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
                if (!$this->data['username'] || !$this->data['is_admin']) { ?>
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
                        if ($this->data['username']) { ?>
                            <a href="#" id="log-out" class="nav-link">
                                Log out
                            </a>
                        <?php }
                        ?>
                    </div>
                <?php } else { ?>
                    <div class="nav-container" id="nav-container">
                        <a href="public/song/add" class="nav-link">
                            Add song
                        </a>
                        <a href="/public/album/add" class="nav-link">
                            Add album
                        </a>
                        <a href="/public/album" class="nav-link">
                            Album list
                        </a>
                        <a href="#" id="log-out" class="nav-link">
                            Log out
                        </a>
                    </div>
                <?php } ?>
            </nav>
            <form action="<?= BASE_URL ?>/song/search" METHOD="GET" class="search-form">
                <div class="form-group">
                    <label for="search">Searching for ...</label>
                    <input type="text" name="q" placeholder="Chisato X Takina" id="search">
                </div>
                <div class="form-group">
                    <label for="sort">Sorted by ...</label>
                    <select name="sort" id="sort">
                        <option value="judul">Title (A-Z)</option>
                        <option value="judul desc">Title (Z-A)</option>
                        <option value="penyanyi">Singer (A-Z)</option>
                        <option value="penyanyi desc">Singer (Z-A)</option>
                        <option value="tanggal_terbit">Date (Newest First)</option>
                        <option value="tanggal_terbit desc">Date (Latest First)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="filter">Select a genre</label>
                    <select name="filter" id="filter">
                        <option value="all"></option>
                        <?php foreach ($this->data['genre_arr'] as $index => $genre) : ?>
                            <option value=<?= $genre->genre ?>><?= $genre->genre ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-button">
                    <button type="submit" class="button green-button">Search!</button>
                </div>
            </form>
            <div class="pad-40">
                <p class="article-heading">Search Result</p>
                <?php if (!$this->data['songs']) { ?>
                    <p class="no-result">Your Search did not match any songs in our database!</p>
                <?php } else { ?>
                <div class="search-result-flex songs-result">
                <?php foreach ($this->data['songs'] as $song) : ?>
                    <a href="/public/song/detail/<?=$song->song_id?>" class="single-song">
                        <img src="<?= STORAGE_URL ?>/images/7316a521430430e30f0b9f33fc8ed46b.png" alt=<?=$song->judul?>>
                        <header class="song-header">
                            <p class="title"><?= $song->judul ?></p>
                            <p><?= $song->penyanyi ?></p>
                        </header>
                        <div class="song-dategenre">
                            <p><?= substr($song->tanggal_terbit, 0, 4) ?></p>
                            <p><?= $song->genre ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
                </div>
                <div class="pagination">
                    <p id="pagination-text">Page <span id="page-number">1</span> out of <?= $this->data['pages'] ?> pages</p>
                    <div class="pagination-buttons">
                        <button id="previous" disabled>
                            <img src="<?= BASE_URL ?>/images/assets/arrow-left.svg" alt="">
                        </button>
                        <button id="next" <?php if ($this->data['pages'] == 1) {?> disabled <? } ?>>
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