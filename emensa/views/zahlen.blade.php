@extends(".examples.layout.m4_7d_layout")
<link rel="stylesheet" href="/css/zahlen.css">

@section('content')
<div id="Zahlen">
    <div class="titel">E-Mensa in Zahlen</div>
    <div id="zahlentabelle">
        <div class="zt1">
            {{$zahlen[0]}}
            <br> Besucher
        </div>
        <div class="zt2">
            {{$zahlen[1]}}
            <br> Anmeldungen zum Newsletter
        </div>
        <div class="zt3">
            {{$zahlen[2]}}
            <br> Speisen
        </div>
    </div>
</div>
@endsection
