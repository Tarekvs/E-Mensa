
@extends(".examples.layout.m4_7d_layout")

@section("title", "E-Mensa")

@section('content')

@if (isset($_SESSION['eingeloggt']) && $_SESSION['eingeloggt']==false)

    @if ($_SESSION['action']=='registrieren')
        <h1>Registrierung hat nicht geklappt. E-Mail ist bereits vergeben</h1> <br> <br>
    @endif
    @if ($_SESSION['action']=='login')
        <h1>Anmeldung hat nicht geklappt. Probieren Sie es erneut</h1> <br> <br>
    @endif
@endif

    <div class="titel">Loggen Sie sich ein oder registrieren Sie sich</div>
        <form action="anmeldung" method="post">

            <label for="name">Ihr Name</label> <br>
            <input type="text" maxlength="50" id="name" name="name" placeholder="Default: Bot"> <br>

            <label for="email">Ihre E-mail</label> <br>
            <input type="email" maxlength="50" id="email" name="email" required placeholder="Email"> <br>

            <label for="password">Ihr Passwort</label> <br>
            <input type="password" maxlength="50" id="password" name="password" required placeholder="Passwort"> <br>
            <br>


            <label for="admin">Admin? (Nur relevant für Registrierung)</label> <br>
            <input type="radio" id="admin" name="admin" value="true"> Yes
            <input type="radio" id="admin" name="admin" value="false" checked> No <br>

            @if(isset($_GET['redirect']) && $_GET['redirect']=="bewertung")
                <input type="hidden" name="redirect" value="bewertung">
                @if(isset($_GET['gerichtid']))
                    <input type="hidden" name="gerichtid" value="{{$_GET['gerichtid']}}">
                @endif
            @endif

        <br>
        <button name="action" value="login">Login</button>
        <button name="action" value="registrieren">Register</button>
        </form>


@endsection