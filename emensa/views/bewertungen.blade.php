@extends(".layout.layout")

@section("title", "Bewertung")

@section('content')
    <h3>Bewertungen der Nutzer:</h3>
    <br>
    <table id="bewertung_table">
        <thead>
        <tr>
            <td>Gericht</td>
            <td>Datum</td>
            <td>Benutzer</td>
            <td>Bemerkung</td>
            <td>Bewertung</td>
        </tr>
        </thead>
        @foreach($ratings as $r)
            <tr>
                <td @if($r['markiert'])
                        style="font-weight: bold"
                        @endif>{{$r['name']}}</td>
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
                @if($isadmin == 1)
                    <td>
                        @if($r['markiert'])
                            <a href="/bewertungen?mark=nein&rating-id={{$r['bewertungs_id']}}">Hervorhebung abwählen</a>
                        @else
                            <a href="/bewertungen?mark=ja&rating-id={{$r['bewertungs_id']}}">Hervorheben</a>
                        @endif
                    </td>
                @endif
                <td>
                    @if(isset($_SESSION['name']) && $r['benutzer'] == $_SESSION['name'])
                        <a href="/bewertungen?delete-rating={{$r['bewertungs_id']}}">Löschen</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection