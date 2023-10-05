@extends(".examples.layout.m4_7d_layout")

@section("title", "E-Mensa")
<link rel="stylesheet" href="/css/empfehlung.css">

@section('content')
<div class="gericht-recommendation-container">
    <div class="titel">Empfehlen Sie uns ein schmackhaftes Gericht</div>
    <form action="Wunschgericht" method="post">
        <div class="form-group">
            <label for="name">Ihr Name</label>
            <input type="text" maxlength="50" id="name" name="name" placeholder="Name">
        </div>

        <div class="form-group">
            <label for="email">Bitte Email eingeben</label>
            <input type="email" maxlength="50" id="email" name="email" required placeholder="Email">
        </div>

        <div class="form-group">
            <label for="Gname">Name des Gerichts</label>
            <input type="text" maxlength="50" id="Gname" name="Gname" required placeholder="Gericht">
        </div>

        <div class="form-group">
            <label for="Gbeschreibung">Beschreibung des Gerichts</label>
            <input type="text" maxlength="200" id="Gbeschreibung" name="Gbeschreibung" required placeholder="Beschreibung">
        </div>

        <div class="form-group">
            <input type="submit" value="Gericht wünschen">
        </div>
    </form>
</div>
@endsection
