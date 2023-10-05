<?php /** @noinspection LanguageDetectionInspection */

require_once(__DIR__.'/../models/newsletter.php');

class NewsletterController
{
function index(){


    //Daten aus dem Newsletterformular mit POST abspeichern
    $n_daten = $_POST;
    //Bool Variable für Fehler
    $fehler = false;

//Wenn der Name nicht leer ist, werden die Leerzeichen entfernt und der Name wird gespeichert
    $name = trim($n_daten ['name'] ?? NULL);

    if (empty($name)) { //Name besteht nur aus Leerzeichen nach Trim = empty
        $fehler = "Name darf nicht nur aus Leerzeichen bestehen"; //Fehlermeldung
        header("refresh:5; URL=localhost:9000/Ankuendigung");    //Neue Seite wird für 5 Sekunden angezeigt, wo die Fehlermeldung ausgegeben wird.
        echo $fehler . "<br>";                                //Nach 5 Sekunden wird man wieder auf die Werbeseite weitergeleitet
        echo "\n";
        return view('kontakt');

    }
    if ($n_daten['dshw'] !== 'on') { //Wenn Datenschutz nicht zugestimmt -> Fehlermeldung
        $fehler = "Datenschutzbestimmung wurde nicht zugestimmt";
        header("refresh:5; URL=localhost:9000/Ankuendigung");    //Neue Seite wird für 5 Sekunden angezeigt, wo die Fehlermeldung ausgegeben wird.
        echo $fehler . "\n";
        return view('kontakt');

    }
    if (!filter_var($n_daten['email'], FILTER_VALIDATE_EMAIL)) { //Wenn Email im falschen Format -> Fehlermeldung
        $fehler = "Email nicht im korrekten Format";
        header("refresh:5; URL=localhost:9000/Ankuendigung");
        echo $fehler . "\n";
        return view('kontakt');

    }

    $spammail = ['rcpt.at', 'damnthespam.at', 'wegwerfmail.de', 'trashmail']; //Wenn eine Spam-Mail aus dem Array erkannt wird -> Fehlermeldung
    foreach ($spammail as $emails) {
        if (str_contains($n_daten ['email'], $emails)) {
            $fehler = "Spam-Email erkannt";
            header("refresh:5; URL=localhost:9000/Ankuendigung");
            echo $fehler . "\n";
            return view('kontakt');
        }
    }

    if (!$fehler) { //Wenn kein Fehler in der Eingabe
    updatenewsletter($n_daten);
    echo "Die Daten sind korrekt und wurden in der Textdatei newsletter_daten hinterlegt"; //Rückmeldung an den User
    }

    return view('emensa');
}

}