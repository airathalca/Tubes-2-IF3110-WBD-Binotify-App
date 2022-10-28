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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/aside.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/song/search.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const STORAGE_URL = "<?= STORAGE_URL ?>";
        const BASE_URL = "<?= BASE_URL ?>";
        const PAGES = parseInt("<?= $this->data['pages'] ?? 0 ?>");
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/song/search.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>Search Page</title>
</head>

<body>
    <div class="black-body">
        <!-- Aside -->
        <?php include(dirname(__DIR__) . '/template/Aside.php') ?>
        <div class="wrapper">
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <div class="pad-40">
                <form action="<?= BASE_URL ?>/song/search" METHOD="GET" class="search-form">
                    <div class="form-group">
                        <label for="search">Searching for ...</label>
                        <input type="text" name="q" placeholder="Artists, songs, or published year" id="search" <?php if ($_GET['q']) : ?> value="<?= $_GET['q'] ?>" <?php endif; ?>>
                    </div>
                    <div class="form-group">
                        <label for="sort">Sorted by ...</label>
                        <select name="sort" id="sort">
                            <option value="judul" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'judul') : ?> selected="selected" <?php endif; ?>>
                                Title (A-Z)
                            </option>
                            <option value="judul desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'judul desc') : ?> selected="selected" <?php endif; ?>>
                                Title (Z-A)
                            </option>
                            <option value="penyanyi" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'penyanyi') : ?> selected="selected" <?php endif; ?>>
                                Singer (A-Z)
                            </option>
                            <option value="penyanyi desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'penyanyi desc') : ?> selected="selected" <?php endif; ?>>
                                Singer (Z-A)
                            </option>
                            <option value="tanggal_terbit" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'tanggal_terbit') : ?> selected="selected" <?php endif; ?>>
                                Date (Newest First)
                            </option>
                            <option value="tanggal_terbit desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'tanggal_terbit desc') : ?> selected="selected" <?php endif; ?>>
                                Date (Latest First)
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filter">Select a genre</label>
                        <select name="filter" id="filter">
                            <option value="all">N/A</option>
                            <?php foreach ($this->data['genre_arr'] as $index => $genre) : ?>
                                <option value=<?= $genre->genre ?> <?php if (isset($_GET['filter']) && $_GET['filter'] == $genre->genre) : ?> selected="selected" <?php endif; ?>>
                                    <?= $genre->genre ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-button">
                        <button type="submit" class="button green-button">Search!</button>
                    </div>
                </form>
                <div class="line-break"></div>
                <h1 class="article-heading">Search Result</h1>
                <?php if (!$this->data['songs']) : ?>
                    <p class="no-result">Your search did not match any songs in our database!</p>
                <?php else : ?>
                    <div class="search-result-flex songs-result">
                        <?php foreach ($this->data['songs'] as $song) : ?>
                            <a href="/public/song/detail/<?= $song->song_id ?>" class="single-song">
                                <div class="top-section">
                                    <img src="<?= STORAGE_URL ?>/images/<?= $song->image_path ?>" alt=<?= $song->judul ?>>
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
                    <div class="pagination">
                        <p id="pagination-text">Page <span id="page-number">1</span> out of <?= $this->data['pages'] ?> pages</p>
                        <div class="pagination-buttons">
                            <button id="previous" disabled>
                                <img src="<?= BASE_URL ?>/images/assets/arrow-left.svg" alt="">
                            </button>
                            <button id="next" <?php if ($this->data['pages'] == 1) : ?> disabled <? endif; ?>>
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