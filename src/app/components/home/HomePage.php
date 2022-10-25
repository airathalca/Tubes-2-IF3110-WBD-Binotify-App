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
    <!-- JavaScript -->
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
                        <div class="nav-container" id="nav-container">
                            <div class="nav-search">
                                <form action="">
                                    <label for="search">Enter song/title/artist/published year to search!</label>
                                    <div class="search-input">
                                        <input type="text" placeholder="YOASOBI">
                                        <button type="submit">
                                            <img src="<?= BASE_URL ?>/images/assets/search.svg" alt="Search icon">
                                        </button>
                                    </div>
                                </form>
                            </div>
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
                    </nav>
                    <article>
                        <div class="pad-40">
                            <p class="article-heading">Songs for you</p>
                            <div class="songs-container">
                                <a href="" class="single-song">
                                    <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                    <header class="song-header">
                                        <p class="title">Bidadari Surga</p>
                                        <p>Chisato X Takina</p>
                                    </header>
                                    <div class="song-dategenre">
                                        <p>1 April 2016</p>
                                        <p>Rock</p>
                                    </div>
                                </a>
                                <a href="" class="single-song">
                                    <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                    <header class="song-header">
                                        <p class="title">Bidadari Surga</p>
                                        <p>Chisato X Takina</p>
                                    </header>
                                    <div class="song-dategenre">
                                        <p>1 April 2016</p>
                                        <p>Rock</p>
                                    </div>
                                </a>
                                <a href="" class="single-song">
                                    <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                    <header class="song-header">
                                        <p class="title">Bidadari Surga</p>
                                        <p>Chisato X Takina</p>
                                    </header>
                                    <div class="song-dategenre">
                                        <p>1 April 2016</p>
                                        <p>Rock</p>
                                    </div>
                                </a>
                                <a href="" class="single-song">
                                    <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                    <header class="song-header">
                                        <p class="title">Bidadari Surga</p>
                                        <p>Chisato X Takina</p>
                                    </header>
                                    <div class="song-dategenre">
                                        <p>1 April 2016</p>
                                        <p>Rock</p>
                                    </div>
                                </a>
                                <a href="" class="single-song">
                                    <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                    <header class="song-header">
                                        <p class="title">Bidadari Surga</p>
                                        <p>Chisato X Takina</p>
                                    </header>
                                    <div class="song-dategenre">
                                        <p>1 April 2016</p>
                                        <p>Rock</p>
                                    </div>
                                </a>
                                <a href="" class="single-song">
                                    <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                    <header class="song-header">
                                        <p class="title">Bidadari Surga</p>
                                        <p>Chisato X Takina</p>
                                    </header>
                                    <div class="song-dategenre">
                                        <p>1 April 2016</p>
                                        <p>Rock</p>
                                    </div>
                                </a>
                                <a href="" class="single-song">
                                    <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                    <header class="song-header">
                                        <p class="title">Bidadari Surga</p>
                                        <p>Chisato X Takina</p>
                                    </header>
                                    <div class="song-dategenre">
                                        <p>1 April 2016</p>
                                        <p>Rock</p>
                                    </div>
                                </a>
                                <a href="" class="single-song">
                                    <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                    <header class="song-header">
                                        <p class="title">Bidadari Surga</p>
                                        <p>Chisato X Takina</p>
                                    </header>
                                    <div class="song-dategenre">
                                        <p>1 April 2016</p>
                                        <p>Rock</p>
                                    </div>
                                </a>
                                <a href="" class="single-song">
                                    <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                    <header class="song-header">
                                        <p class="title">Bidadari Surga</p>
                                        <p>Chisato X Takina</p>
                                    </header>
                                    <div class="song-dategenre">
                                        <p>1 April 2016</p>
                                        <p>Rock</p>
                                    </div>
                                </a>
                                <a href="" class="single-song">
                                    <img src="<?= BASE_URL ?>/images/assets/sample.png" alt="Chisato x Takina">
                                    <header class="song-header">
                                        <p class="title">Bidadari Surga</p>
                                        <p>Chisato X Takina</p>
                                    </header>
                                    <div class="song-dategenre">
                                        <p>1 April 2016</p>
                                        <p>Rock</p>
                                    </div>
                                </a>
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
                        <p>Hello, <strong><?php echo $this->data['username'] ?></strong>!</p>
                    <?php } ?>
                </aside>
            </div>
        </div>
    </div>
</body>

</html>