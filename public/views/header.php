<header>
    <div class="menu-left"></div>
    <label class='menu-button-container' for="menu-toggle"></label>
    <div class="header-title">
        <a href="home">JobHub</a>
    </div>
    <input id="menu-toggle" type="checkbox" />
    <label class='menu-button-container' for="menu-toggle">
        <div class='menu-button'></div>
    </label>
    <div class="menu">
        <?php
        if (isset($_COOKIE['user'])) {
            echo (
                '<span>Cześć, '.$_COOKIE['user'].'</span>
                <a href="add-offer">Dodaj ofertę</a>
                <a href="logout">Wyloguj</a>'
            );
        }
        else {
            echo ('
                <a href="login">Zaloguj</a>
                <a href="register">Rejestracja</a>
            ');
        }?>
    </div>
</header>
