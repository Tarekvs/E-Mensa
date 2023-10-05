@extends(".examples.layout.m4_7d_layout")

@section("title", "E-Mensa")

@section('content')

    <h1>Mein Profil</h1>

    Name: {{$_SESSION['name']}}     <br>
    E-Mail: {{$_SESSION['email']}}     <br>
    Anzahl Anmeldungen: {{$_SESSION['anmeldungen']}}     <br>
    Admin: {{$_SESSION['admin']}}     <br>

    <hr>
    <h3>Meine Bewertungen:</h3>
    <br>
    <table id="bewertung_table">
        <thead>
        <tr>
            <td>Gericht</td>
            <td>Datum</td>
            <td>Bemerkung</td>
            <td>Bewertung</td>
        </tr>
        </thead>
        @if(isset($_SESSION['eingeloggt']) && $_SESSION['eingeloggt'])
        @foreach($ratings as $r)
            <tr>
                <td>{{$r['name']}}</td>
                <td>{{$r['datum']}}</td>
                <td>{{$r['bemerkung']}}</td>
                @if($r['bewertung'] == 1)
                    <td>Sehr gut</td>
                @elseif($r['bewertung'] == 2)
                    <td>Gut</td>
                @elseif($r['bewertung'] == 3)
                    <td>Schlecht</td>
                @elseif($r['bewertung'] == 4)
                    <td>Sehr schlecht</td>
                @endif
                @if(isset($_SESSION['name']) && $r['benutzer'] == $_SESSION['name'])
                    <td><a href="/MyProfile?delete-rating={{$r['bewertungs_id']}}">Löschen</a></td>
                @endif
            </tr>
        @endforeach
        @endif
    </table>

@endsection