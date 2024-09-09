<header>
    <div class="container flex-a-center flex-sb">
        <div class="left flex-a-center gap-1">
            <span class="material-symbols-outlined icon-btn">menu</span>
            <?php if ($pageName == 'enregistrements') : ?>
                <div class="top-search">
                    <span class="material-symbols-outlined">search</span>
                    <input type="search" name="search-text" id="search-text" placeholder="Rechercher..." onkeyup="filterTable('search-text', 'tbody')">
                </div>
            <?php endif ?>
        </div>
        <div class="right flex-a-center gap-1">
            <div class="notifications">
                <span class="material-symbols-outlined icon-btn">notifications</span>
                <div class="drop-items"></div>
            </div>
            <div class="login-element">
                <span class="material-symbols-outlined icon-btn">person</span>
                <div class="drop-items"></div>
            </div>
        </div>
    </div>
</header>