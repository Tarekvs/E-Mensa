@extends(".examples.layout.m4_7d_layout")
<link rel="stylesheet" href="/css/meinungen.css">

@section("title", "Bewertung")

@section('content')

@if(isset($markedratings))
    <h3>Bewertungen der Nutzer:</h3>
    <table id="bewertung_table">
        <thead>
            <tr>
                <th>Gericht</th>
                <th>Bemerkung</th>
                <th>Bewertung</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
@else
    <h2>Keine hervorgehobene Gerichte vorhanden!</h2>
@endif

@endsection
