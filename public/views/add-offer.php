<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/add-offer.css">
    <title>JobHub</title>
</head>

<body>
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
        <span>Cześć, Jan!</span>
        <a href="login">Wyloguj</a>
    </div>
</header>
<div class="container">
    <div class="add-offer-container content-container ">
        <div class="heading-container">
            <div class="heading-content">
                <img alt="add icon" class="icon" src="public/img/add-icon.svg">
                <span>Dodaj ofertę</span>
            </div>
            <hr class="heading-line"/>
        </div>
        <form class="form add-offer-form" action="addoffer" method="POST">
            <div class="messages">
            </div>
            <input class="input" name="title" type="text" placeholder="tytuł">
            <input class="input" name="company" type="text" placeholder="firma">
            <input class="input" name="localization" type="text" placeholder="lokalizacja">
            <div class="salary-container">
                <input min="0" max="999999" class="salary-input input" name="salary" type="number" placeholder="oferowane wynagrodzenie brutto">
                <select class="salary-select input" name="currency" disabled>
                    <option value="PLN">PLN</option>
                </select>
            </div>
            <textarea class="textarea" name="requirements" rows="10" placeholder="opis wymagań"></textarea>
            <textarea class="textarea" name="details" rows="10" placeholder="szczegóły"></textarea>
            <input class="input" name="contact" type="text" placeholder="kontakt">
            <input class="input" name="tags" type="password" placeholder="tagi (oddzielone przecinkami)">
            <button class="button" type="submit">Dodaj</button>
        </form>
    </div>
</div>
</body>