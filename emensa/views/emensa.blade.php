@extends(".examples.layout.m4_7d_layout")

@section("title", "E-Mensa")





@section('content')
<div id="hauptseite">
    <div id="welcome">
        <div id="welcome_img_div">
            <img id="welcome_img" src="./img/mensa.jpeg" alt="Mensa">
        </div>
        <div id="welcome_txt_div">
            <h3>Bald gibt es auch Essen online ;)</h3>
            <p>In neun Mensen bieten wir unseren Gästen aus Aachen und Jülich eine großzügige Auswahl
                an gesunder und abwechslungsreicher Verpflegung, die nicht nur gut schmeckt, sondern darüber
                hinaus besonders günstig ist. Bei uns erhalten Sie viele Gerichte der internationalen Küche,
                Leckeres aus dem WOK oder vom Grill sowie Pizza und Pasta.
                <br>
                Die Mensa Bayernallee wurde im Jahr 2010 komplett saniert und ist ein beliebter Mittagstreffpunkt mit
                Kaffeebar und Außenterrasse im Sommer.
                <br>
                Wir möchten, dass Sie in unseren Mensen, Cafeterien und Kaffeebars einen reibungslosen und
                schnellen Service genießen.
                Deswegen haben wir in allen Einrichtungen die Chipkartenzahlung mit der BlueCard, FH-Karte,
                Studierendengastkarte und Gastkarte eingeführt.
                Das elektronische Zahlungssystem bietet gegenüber der Barzahlung einen entscheidenden
                Vorteil: Der Bezahlvorgang dauert nur wenige Sekunden. Dadurch lassen sich in den Hochschulpausen
                Wartezeiten an der Kasse reduzieren und wertvolle Minuten einsparen.
                {{$_SERVER['DOCUMENT_ROOT']}}
            </p>
        </div>
    </div>
 <div id="Wichtig">
                <div class="titel">Das ist uns wichtig</div>
                <div id="wichtiglist">
                    <ul>
                        <li>Beste frische saisonale Zutaten</li>
                        <li>Ausgewogene abwechslungsreiche Gerichte</li>
                        <li>Sauberkeit</li>
                    </ul>
                </div>
            </div>
@endsection