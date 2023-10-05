@extends(".examples.layout.m4_7d_layout")

@section("title", "Bewertung")

@section('content')
    <div class="bewertung">
        @if(isset($data[0]['name']))
            <h2>Bewertung von {{$data[0]['name']}}</h2>
            @if(isset($data[0]['bildname']))
                <img src="./img/gerichte/{{$data[0]['bildname']}}" width="200" height="150" alt="">
            @else
                <img src="./img/gerichte/00_image_missing.jpg" width="200" height="150"  alt="">
            @endif

            <h3>Jetzt eigene Bewertung abgeben:</h3>
            <form action="/bewertung?gerichtid={{$_GET['gerichtid']}}" method="post">
                <label>Bemerkung:</label>
                <br>
                <textarea id="bemerkung" name="bemerkung" style="resize: none;width: 20%; height: 15%;" minlength="5"></textarea>
                <br>
                <label>Bewertung:</label>
                <br>
                <input type="radio" name="bewertung" value="1">Sehr gut</input>
                <br>
                <input type="radio" name="bewertung" value="2">Gut</input>
                <br>
                <input type="radio" name="bewertung" value="3">Schlecht</input>
                <br>
                <input type="radio" name="bewertung" value="4">Sehr schlecht</input>
                <input type="hidden" name="benutzer" value="{{$_SESSION['name']}}">
                <input type="hidden" name="gerichtid" value="{{$_GET['gerichtid']}}">
                <br>
                <br>
                <button type="submit">Bewertung abgeben</button>
            </form>
            <br>
            <h3>Bewertungen der Nutzer:</h3>
            <br>
            <table id="bewertung_table">
                <thead>
                <tr>
                    <td>Datum</td>
                    <td>Benutzer</td>
                    <td>Bemerkung</td>
                    <td>Bewertung</td>
                </tr>
                </thead>
                @foreach($ratings as $r)
                    <tr>
                        <td>{{$r['datum']}}</td>
                        <td>{{$r['benutzer']}}</td>
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
                        @if($r['benutzer'] == $_SESSION['name'])
                            <td><a href="/bewertung?gerichtid={{$_GET['gerichtid']}}&delete-rating={{$r['bewertungs_id']}}">Löschen</a></td>
                        @endif
                    </tr>
                @endforeach
            </table>

        @else
            <h2>Kein passendes Gericht zur ID gefunden!</h2>
        @endif

    </div>
@endsection