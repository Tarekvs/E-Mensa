@extends(".layout.layout")
<link rel="stylesheet" href="/css/anmeldung.css">

@section("title", "E-Mensa")

@section('content')

@if (isset($_SESSION['eingeloggt']) && $_SESSION['eingeloggt']==false)
    @if ($_SESSION['action']=='registrieren')
        <h1 class="error-message">Registrierung hat nicht geklappt. E-Mail ist bereits vergeben</h1>
    @endif
    @if ($_SESSION['action']=='login')
        <h1 class="error-message">Anmeldung hat nicht geklappt. Probieren Sie es erneut</h1>
    @endif
@endif

<div class="login-container">
    <div class="titel">Loggen Sie sich ein oder registrieren Sie sich</div>
    <form action="anmeldung" method="post">

        <div class="form-group">
            <label for="name">Ihr Name</label>
            <input type="text" maxlength="50" id="name" name="name" placeholder="Default: Bot">
        </div>

        <div class="form-group">
            <label for="email">Ihre E-mail</label>
            <input type="email" maxlength="50" id="email" name="email" required placeholder="Email">
        </div>

        <div class="form-group">
            <label for="password">Ihr Passwort</label>
            <input type="password" maxlength="50" id="password" name="password" required placeholder="Passwort">
        </div>

        <div class="form-group">
            <label for="admin">Admin? (Nur relevant für Registrierung)</label>
            <div class="radio-group">
                <input type="radio" id="admin-yes" name="admin" value="true"> 
                <label for="admin-yes">Yes</label>
                <input type="radio" id="admin-no" name="admin" value="false" checked>
                <label for="admin-no">No</label>
            </div>
        </div>

        @if(isset($_GET['redirect']) && $_GET['redirect']=="bewertung")
            <input type="hidden" name="redirect" value="bewertung">
            @if(isset($_GET['gerichtid']))
                <input type="hidden" name="gerichtid" value="{{$_GET['gerichtid']}}">
            @endif
        @endif

        <div class="form-group">
            <button name="action" value="login">Login</button>
            <button name="action" value="registrieren">Register</button>
        </div>
    </form>
</div>

@endsection
