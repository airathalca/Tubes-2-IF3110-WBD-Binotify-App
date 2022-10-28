<nav class="black-navbar">
    <div class="pad-32">
        <div class="flex-between">
            <div class="nav-left-portion">
                <a href="/public/home">
                    <img src="<?= BASE_URL ?>/images/assets/logo-light.svg" alt="Logo Binotify">
                </a>
                <div class="nav-top-search">
                    <form action="<?= BASE_URL ?>/song/search" METHOD="GET">
                        <div class="top-search-input">
                            <input type="text" placeholder="YOASOBI" name="q">
                            <button type="submit">
                                <img src="<?= BASE_URL ?>/images/assets/search.svg" alt="Search icon">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="nav-right-portion">
                <?php if ($this->data['username']) : ?>
                    <div class="nav-username">
                        <img src="<?= BASE_URL ?>/images/assets/user-solid.svg" alt="profile icon" ?>
                        <p><?= $this->data['username'] ?></p>
                    </div>
                <?php endif; ?>
                <button class="toggle" id="toggle">
                    <img src="<?= BASE_URL ?>/images/assets/bars.svg" alt="Bars">
                </button>
            </div>
        </div>
    </div>
    <?php
    if (!$this->data['username'] || !$this->data['is_admin']) : ?>
        <div class="nav-container" id="nav-container">
            <form action="<?= BASE_URL ?>/song/search" METHOD="GET" class="container-search">
                <div class="nav-search-input">
                    <input type="text" placeholder="YOASOBI" name="q">
                    <button type="submit">
                        <img src="<?= BASE_URL ?>/images/assets/search.svg" alt="Search icon">
                    </button>
                </div>
            </form>
            <a href="/public/album" class="nav-link">
                Album list
            </a>
            <?php if ($this->data['username']) : ?>
                <a href="#" id="log-out" class="nav-link">
                    Log out
                </a>
            <?php else : ?>
                <a href="/public/user/login" class="nav-link">
                    Log in
                </a>
                <a href="/public/user/register" class="nav-link">
                    Register
                </a>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="nav-container" id="nav-container">
            <form action="<?= BASE_URL ?>/song/search" METHOD="GET" class="container-search">
                <div class="nav-search-input">
                    <input type="text" placeholder="YOASOBI" name="q">
                    <button type="submit">
                        <img src="<?= BASE_URL ?>/images/assets/search.svg" alt="Search icon">
                    </button>
                </div>
            </form>
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
    <?php endif; ?>
</nav>