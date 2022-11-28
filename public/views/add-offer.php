<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>JobHub</title>
</head>

<body>
<header>
    <div class="header-buttons"></div>
    <div class="header-title">
        <a href="home">JobHub</a>
    </div>
    <div class="header-buttons">
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
            <input class="offer-input input" name="title" type="text" placeholder="tytuł">
            <input class="offer-input input" name="company" type="text" placeholder="firma">
            <input class="offer-input input" name="localization" type="text" placeholder="lokalizacja">
            <div class="salary-container">
                <input min="0" max="999999" class="salary-input input" name="salary" type="number" placeholder="oferowane wynagrodzenie brutto">
                <select class="salary-select input" name="currency" disabled>
                    <option value="PLN">PLN</option>
                </select>
            </div>
            <textarea class="textarea" name="requirements" rows="10" placeholder="opis wymagań"></textarea>
            <textarea class="textarea" name="details" rows="10" placeholder="szczegóły"></textarea>
            <input class="offer-input input" name="contact" type="text" placeholder="kontakt">
            <input class="offer-input input" name="tags" type="password" placeholder="tagi (oddzielone przecinkami)">
            <button class="button" type="submit">Dodaj</button>
        </form>
    </div>
</div>
</body>