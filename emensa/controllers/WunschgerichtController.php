<?php


require_once(__DIR__.'/../models/gericht.php');

/**
 * Class WunschgerichtController
 *
 * This class is responsible for handling user's dish recommendations.
 */
class WunschgerichtController
{
    /**
     * Handles the incoming data for dish recommendations and performs several validations.
     * If the data passes all validations, it records the dish recommendation.
     *
     * @return mixed The view to be displayed.
     */
    function index(){

        // Initialize error flag.
        $fehler = false;

        // If the name isn't empty after trimming, store it.
        $name = trim($_POST['name'] ?? NULL);
        if (empty($name)) {
            $fehler = "Name must not consist only of spaces";
            header("refresh:5; URL=wunschgericht.html");
            echo $fehler . "<br>";
            return view('empfehlung');
        }

        // Check for dish name.
        $Gname = trim($_POST['Gname'] ?? NULL);
        if (empty($Gname)) {
            $fehler = "Dish name must not consist only of spaces";
            header("refresh:5; URL=wunschgericht.html");
            echo $fehler . "<br>";
            return view('empfehlung');
        }

        // Check for dish description.
        $Gbeschreibung = trim($_POST['Gbeschreibung'] ?? NULL);
        if (empty($Gbeschreibung)) {
            $fehler = "Dish description must not consist only of spaces";
            header("refresh:5; URL=wunschgericht.html");
            echo $fehler . "<br>";
            return view('empfehlung');
        }

        // Validate email format.
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $fehler = "Email is not in the correct format";
            header("refresh:5; URL=werbeseite.php");
            echo $fehler . "\n";
            return view('empfehlung');
        }

        // Check for spam emails.
        $spammail = ['rcpt.at', 'damnthespam.at', 'wegwerfmail.de', 'trashmail'];
        foreach ($spammail as $emails) {
            if (str_contains($_POST['email'], $emails)) {
                $fehler = "Spam email detected";
                echo $fehler . "\n";
                return view('empfehlung');
            }
        }

        // If there's no error in the input, record the dish recommendation.
        if (!$fehler) {
            wunsch_gericht($name, $Gname, $Gbeschreibung);
            echo "Thank you for the recommendation";
            return view('emensa');
        }
    }
}
