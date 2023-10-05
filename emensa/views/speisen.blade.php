@extends(".examples.layout.m4_7d_layout")
@section("title", "E-Mensa")

@section('content')
 <div id="gerichte_div">

        @if (isset($data['error']))
            <h1>Es gab ein Problem mit der Datenbankverbindung</h1>
            <p>Fehlermeldung</p>
            <pre> {{$data['beschreibung']}}</pre>
        @else
            <h3>Gerichte, die Sie erwarten:</h3>
            <br>
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
                @forelse($data as $d)
                    <tr>
                        <td>{{$d['name']}}</td>
                        <td>{{$d['allergene']}}</td>
                        <td>{{$d['preis_intern']}} €</td>
                        <td>{{$d['preis_extern']}} €</td>
                        @if (isset($d['bildname']))
                            <td><img src="./img/gerichte/{{$d['bildname']}}" width="200" height="150"  alt=""></td>
                        @else
                            <td><img src="./img/gerichte/00_image_missing.jpg" width="200" height="150"  alt=""></td>
                        @endif
                        <td><a href="./bewertung?gerichtid={{$d['id']}}">Hier bewerten</a></td>
                    </tr>
                @empty
                    <tr>
                        <td>Leer</td>
                    </tr>
                @endforelse
            </table>
        @endif
    </div>
@endsection
