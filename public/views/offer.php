<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/offer.css">
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
        <a href="add-offer">Dodaj ofertę</a>
        <a href="login">Zaloguj</a>
        <a href="register">Zarejestruj</a>
        <a href="logout">Wyloguj</a>
    </div>
</header>
<div class="container">
    <div class="content-container offer-container">
        <div class="heading-container">
            <div class="heading-content">
                <img alt="job icon" class="offer-icon icon" src="public/img/job-icon.svg">
                <div class="offer-heading-text-container">
                    <span class="job-title">Junior C# Developer - zdalnie </span>
                    <span class="company-name smaller-text">ITEdge</span>
                </div>
                <div class="tag red-tag">Usuń</div>
            </div>
            <hr class="heading-line"/>
        </div>
        <div class="offer-content-container">
            <div class="offer-desc-container">
                <div class="offer-requirements content-background">
                    <div class="offer-content-heading">
                        <span>Opis wymagań</span>
                        <hr class="heading-line offer-line"/>
                    </div>
                    <div class="offer-text-content">Poszukujemy pracownika na stanowisko junior c# developer.
    Minimum roczne doświadczenie w branży
    C# i .NET Core
    język angielski B2
    Podstawowa wiedza na temat metod programowania (Agile, Scrum, CI/CD, etc.)

Mile widziane:
    Angular, Web API

Do twoich zadań będzie należało:
    tworzenie i implementacja oprogramowania w technologiach .NET
    tworzenie przejrzystego i dobrze zaprojektowanego kodu
    rozwiązywanie problemów i testowanie aplikacji .Net
    wdrażanie w pełni funkcjonalnych aplikacji
    tworzenie dokumentacji technicznej
    współpraca z zespołem</div>
                </div>
                <div class="offer-desc content-background">
                    <div class="offer-content-heading">
                        <span>Szczegóły</span>
                        <hr class="heading-line offer-line"/>
                    </div>
                    <div class="offer-text-content">Oferujemy:
    - Praca na pełny/część etatu
    - Umowa o pracę/zlecenie
    - Benefity (multisport, prywatna opieka zdrowotna)
    - Urlop przy umowie o pracę</div>
                </div>
            </div>
            <div class="offer-crucial-info content-background">
                <div class="salary-localization-wrapper">
                    <div class="padding-0 offer-content-heading crucial-info-heading">
                        <div class="crucial-content-container">
                            <span class="salary-text">12000 PLN</span>
                            <span class="smaller-text">Brutto miesięcznie</span>
                        </div>
                        <hr class="heading-line offer-line"/>
                    </div>

                    <div class="padding-0 offer-content-heading crucial-info-heading">
                        <div class="crucial-content-container">
                            <span>Zdalnie</span>
                            <span class="smaller-text">Lokalizacja</span>
                        </div>
                        <div class="crucial-content-container">
                            <span>praca@itedge.pl</span>
                            <span class="smaller-text">Kontakt</span>
                        </div>
                        <hr class="heading-line offer-line"/>
                    </div>
                </div>
                <div class="padding-0 offer-content-heading tags-wrapper">
                    <div class="tags-title">
                        <span class="smaller-text">Tagi</span>
                    </div>
                    <div class="tags-content">
                        <div class="tag">Junior</div>
                        <div class="tag">C#</div>
                        <div class="tag">Zdalnie</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>