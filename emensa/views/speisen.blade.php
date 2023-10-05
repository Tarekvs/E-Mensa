@extends(".examples.layout.m4_7d_layout")

@section("title", "E-Mensa")

<!-- Linking to the speisen.css -->

<link rel="stylesheet" href="/css/speisen.css">


@section('content')
<div id="gerichte_div">
    <!-- Check for database connection error -->
    @if (isset($data['error']))
        <h1>Es gab ein Problem mit der Datenbankverbindung</h1>
        <p>Fehlermeldung</p>
        <pre>{{$data['beschreibung']}}</pre>
    @else
        <!-- Display Gerichte -->
        <h3>Gerichte, die Sie erwarten:</h3>
        <table>
            <thead>
                <tr>
                    <td>Gericht</td>
                    <td>Allergene</td>
                    <td>Preis intern</td>
                    <td>Preis extern</td>
                    <td>Bild</td>
                    <td>Bewertung</td>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $d)
                    <tr>
                        <td>{{$d['name']}}</td>
                        <td>{{$d['allergene']}}</td>
                        <td>{{$d['preis_intern']}} €</td>
                        <td>{{$d['preis_extern']}} €</td>
                        <td>
                            <!-- Display the image if exists, else display placeholder -->
                            @if (isset($d['bildname']))
                                <img src="./img/gerichte/{{$d['bildname']}}" width="200" height="150" alt="Bild von {{$d['name']}}">
                            @else
                                <img src="./img/gerichte/00_image_missing.jpg" width="200" height="150" alt="Bild fehlt">
                            @endif
                        </td>
                        <td>
                            <a href="./bewertung?gerichtid={{$d['id']}}">Hier bewerten</a>
                        </td>
                    </tr>
                @empty
                    <!-- Display if no data available -->
                    <tr>
                        <td colspan="6">Leer</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif
</div>
@endsection
