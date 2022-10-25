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
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/song/search.css">
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <script src="<?= BASE_URL ?>/javascript/home/home.js" defer></script>
    <title>Search Page</title>
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
                                <a href="#" class="nav-link">
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
                                <a href="#" class="nav-link">
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
                    <div class="wrapper">
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
                                <label for="genre">Select a genre</label>
                                <select name="filter" id="filter">
                                    <option value="all"></option>
                                    <?php foreach ($this->data['genre_arr'] as $index => $genre ) : ?>
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
                    </div>
                </main>
                <aside class="right-side">
                    <img src="<?= BASE_URL ?>/images/assets/logo-notext-dark.svg" alt="Spotipi Logo">
                    <?php
                        if (!$this->data['username']) { ?>
                            <p><a href="<?=BASE_URL?>/user/login">Log in</a> or <a href="<?=BASE_URL?>/user/register">Register</a> to fully experience Spotipi!</p>
                        <?php } else { ?>
                            <p>Hello, <strong><?php echo $this->data['username'] ?></strong>!</p>
                        <?php } ?>
                </aside>
            </div>
        </div>
    </div>
</body>
</html>