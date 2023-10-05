@extends(".examples.layout.m4_7d_layout")

@section("title", "Bewertung")

@section('content')

    @if(isset($markedratings))
        <h3>Bewertungen der Nutzer:</h3>
        <br>
        <table id="bewertung_table">
            <thead>
            <tr>
                <td>Gericht</td>
                <td>Bemerkung</td>
                <td>Bewertung</td>
        </tr>
        </thead>
        @foreach($markedratings as $r)
            <tr>
                <td>{{$r['name']}}</td>
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
            </tr>
        @endforeach
    </table>

    @else
        <h2>Keine hervorgehobene Gerichte vorhanden!</h2>
    @endif

@endsection