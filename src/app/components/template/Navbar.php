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
                User list
            </a>
            <a href="#" id="log-out" class="nav-link">
                Log out
            </a>
        </div>
    <?php } ?>
</nav>