<?php
 /**
         *- Praktikum DBWT. Autoren:
         *- Jonas, Gühler, 3263987
         *- Tarek, von Seckendorff, 3533712
         */
    require_once(__DIR__.'/../models/gericht.php');

class WunschgerichtController
{
    function index(){



        $fehler = false;

//Wenn der Name nicht leer ist, werden die Leerzeichen entfernt und der Name wird gespeichert
        $name = trim($_POST['name'] ?? NULL);
        if (empty($name)) { //Name besteht nur aus Leerzeichen nach Trim = empty
            $fehler = "Name darf nicht nur aus Leerzeichen bestehen"; //Fehlermeldung
            header("refresh:5; URL=wunschgericht.html");    //Neue Seite wird für 5 Sekunden angezeigt, wo die Fehlermeldung ausgegeben wird.
            echo $fehler . "<br>";                                //Nach 5 Sekunden wird man wieder auf die Werbeseite weitergeleitet
            echo "\n";
            return view('empfehlung');

        }

        $Gname = trim($_POST['Gname'] ?? NULL);

        if (empty($Gname)) { //Name besteht nur aus Leerzeichen nach Trim = empty
            $fehler = "Name des Gerichts darf nicht nur aus Leerzeichen bestehen"; //Fehlermeldung
            header("refresh:5; URL=wunschgericht.html");    //Neue Seite wird für 5 Sekunden angezeigt, wo die Fehlermeldung ausgegeben wird.
            echo $fehler . "<br>";                                //Nach 5 Sekunden wird man wieder auf die Werbeseite weitergeleitet
            echo "\n";
            return view('empfehlung');

        }

        $Gbeschreibung = trim($_POST['Gbeschreibung'] ?? NULL);

        if (empty($Gbeschreibung)) { //Name besteht nur aus Leerzeichen nach Trim = empty
            $fehler = "Beschreibung des Gerichts darf nicht nur aus Leerzeichen bestehen"; //Fehlermeldung
            header("refresh:5; URL=wunschgericht.html");    //Neue Seite wird für 5 Sekunden angezeigt, wo die Fehlermeldung ausgegeben wird.
            echo $fehler . "<br>";                                //Nach 5 Sekunden wird man wieder auf die Werbeseite weitergeleitet
            echo "\n";
            return view('empfehlung');

        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { //Wenn Email im falschen Format -> Fehlermeldung
            $fehler = "Email nicht im korrekten Format";
            header("refresh:5; URL=werbeseite.php");
            echo $fehler . "\n";
            return view('empfehlung');

        }

        $spammail = ['rcpt.at', 'damnthespam.at', 'wegwerfmail.de', 'trashmail']; //Wenn eine Spam-Mail aus dem Array erkannt wird -> Fehlermeldung
        foreach ($spammail as $emails) {
            if (str_contains($_POST ['email'], $emails)) {
                $fehler = "Spam-Email erkannt";
                echo $fehler . "\n";
                return view('empfehlung');

            }

        }

        if (!$fehler) { //Wenn kein Fehler in der Eingabe
            wunsch_gericht($name,$Gname,$Gbeschreibung);
            echo "Vielen Dank für die Empfehlung"; //Rückmeldung an den User
            return view('emensa');
        }
    }
}