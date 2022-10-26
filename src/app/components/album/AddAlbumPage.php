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
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/album/add-album.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script src="<?= BASE_URL ?>/javascript/album/add-album.js" defer></script>
    <script src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>Add Album</title>
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
                <?php } ?>
            </nav>
            <!-- Form -->
            <div class="pad-40">
                <p class="form-header">Add an album</p>
                <form action="/public/album/add?csrf_token=<?php echo $_SESSION['csrf_token'] ?>" method="post" enctype="multipart/form-data" class="form">
                    <div class="form-group">
                        <label for="title">Album title</label>
                        <input type="text" name="title" id="title" placeholder="Lycoris Recoil OST">
                    </div>
                    <div class="form-group">
                        <label for="artist">Artist</label>
                        <input type="text" name="artist" id="artist" placeholder="Chisato">
                    </div>
                    <div class="form-group">
                        <label for="date">Published date</label>
                        <input type="date" name="date" id="date">
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" name="genre" id="genre" placeholder="Rock">
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover photo</label>
                        <input type="file" name="cover" id="cover" accept="image/png, image/jpeg">
                    </div>
                    <button class="button green-button">Add album to database</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>