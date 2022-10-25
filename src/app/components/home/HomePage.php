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
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/home/home.css">
    <!-- JavaScript Constant -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script src="<?= BASE_URL ?>/javascript/home/home.js" defer></script>
    <title>Home Page</title>
</head>

<body>
    <div class="black-body">
        <div class="wrapper">
            <div class="big-flex-container">
                <main class="left-side">
                    <nav class="black-navbar">
                        <div class="pad-40">
                            <button class="toggle" id="toggle">
                                <img src="<?= BASE_URL ?>/images/assets/bars.svg" alt="Bars">
                            </button>
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
                                <a href="" class="nav-link">
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
                                <a href="#" class="nav-link">
                                    Add song
                                </a>
                                <a href="<?= BASE_URL?>/album/add" class="nav-link">
                                    Add album
                                </a>
                                <a href="#" class="nav-link">
                                    Album list
                                </a>
                                <a href="#" id="log-out" class="nav-link">
                                    Log out
                                </a>
                            </div>
                        <?php } ?>
                    </nav>
                    <article>
                        <div class="pad-40">
                            <p class="article-heading">Songs for you</p>
                            <div class="songs-container">
                                <?php foreach ($this->data['song_arr'] as $index => $song) : ?>
                                    <a href="" class="single-song">
                                        <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                        <header class="song-header">
                                            <p class="title"><?= $song->judul?></p>
                                            <p><?= $song->penyanyi?></p>
                                        </header>
                                        <div class="song-dategenre">
                                            <p><?= substr($song->tanggal_terbit,0,4)?></p>
                                            <p><?= $song->genre?></p>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </article>
                </main>
                <aside class="right-side">
                    <img src="<?= BASE_URL ?>/images/assets/logo-notext-dark.svg" alt="Spotipi Logo">
                    <?php
                    if (!$this->data['username']) { ?>
                        <p><a href="/public/user/login">Log in</a> or <a href="/public/user/register">Register</a> to fully experience Spotipi!</p>
                    <?php } else { ?>
                        <p>Hello, <strong><?= $this->data['username'] ?></strong>!</p>
                    <?php } ?>
                </aside>
            </div>
        </div>
    </div>
</body>

</html>