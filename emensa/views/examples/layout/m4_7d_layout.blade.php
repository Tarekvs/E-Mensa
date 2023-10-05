<!doctype html>
<html class="no-js" lang="DE">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/home.css">
    <style>

    </style>

    <title>@yield('title')</title>
</head>
<body>

    <header>
           <div id="header">
            <div id="logo">
                <img id="logo_img" src="./img/E-MensaLogo.png" alt="E-Mensa Logo">   <!--Mensa Logo-->
            </div>
            <div id="navigation">
                <a href=Ankuendigung>Ankündigung</a>
                <a href=Speisen>Speisen</a>
                <a href=Zahlen>Zahlen</a>
                <a href=Kontakt>Kontakt</a>
                <a href=Meinungen>Meinungen unserer Gäste</a>
                <a href=Empfehlung>Gericht empfehlen</a>

                @if (isset($_SESSION['eingeloggt']) && $_SESSION['eingeloggt']==true)
                    <a href="MyProfile">{{$_SESSION['name']}}</a>
                    <a href="Ausloggen">Ausloggen</a>
                @else
                    <a href=Anmelden>Anmelden</a>
                @endif

            </div>
        </div>
    </header>

    <div class="main">
        @yield('content')
    </div>
    <footer>
         <div id="footer">
            <div id="footerlinks"></div>
            <div id="footermitte">
                <table>
                    <tr>
                        <td>&copy; E-Mensa GmbH</td>
                        <td>Tarek von Seckendorff</td>
                        <td><a href="">Impressum</a></td>
                    </tr>
                </table>
            </div>
            <div id="footerrechts"></div>
        </div>

    </footer>
    </div>
</body>

