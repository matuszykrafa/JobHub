<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/add-offer.css">
    <title>JobHub</title>
</head>

<body>
<?php include('header.php')?>
<div class="container">
    <div class="add-offer-container content-container ">
        <div class="heading-container">
            <div class="heading-content">
                <img alt="add icon" class="icon" src="public/img/add-icon.svg">
                <span>Dodaj ofertę</span>
            </div>
            <hr class="heading-line"/>
        </div>
        <form class="form add-offer-form" action="add-offer" method="POST">
            <div class="messages">
            </div>
            <input required class="input" name="title" type="text" placeholder="tytuł">
            <input required class="input" name="company" type="text" placeholder="firma">
            <input required class="input" name="localization" type="text" placeholder="lokalizacja">
            <div class="salary-container">
                <input required min="0" max="999999" class="salary-input input" name="salary" type="number" placeholder="oferowane wynagrodzenie brutto">
                <select aria-label="currency" required class="salary-select input" name="currency" disabled>
                    <option value="PLN">PLN</option>
                </select>
            </div>
            <textarea required class="textarea" name="requirements" rows="10" placeholder="opis wymagań"></textarea>
            <textarea required class="textarea" name="details" rows="10" placeholder="szczegóły"></textarea>
            <input required class="input" name="contact" type="text" placeholder="kontakt">
            <!--<input required class="input" name="tags" type="text" placeholder="tagi (oddzielone przecinkami)">-->
            <select required aria-label="tags" multiple class="input multiple-input" name="tags[]">
                <?php if(isset($tags)) { foreach ($tags as $tag): ?>
                    <option class="multiple-option" value="<?= $tag->getId();?>"><?= $tag->getTagName();?></option>
                <?php endforeach; } ?>
            </select>
            <button class="button" type="submit">Dodaj</button>
        </form>
    </div>
</div>
</body>