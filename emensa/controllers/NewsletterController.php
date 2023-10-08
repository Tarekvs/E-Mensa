<?php

require_once(__DIR__.'/../models/newsletter.php');

/**
 * Class NewsletterController
 *
 * This class is responsible for managing the newsletter functionalities.
 */
class NewsletterController
{
    /**
     * Handles the incoming data from the newsletter form and performs several validations.
     * If the data passes all validations, it updates the newsletter.
     *
     * @return mixed The view to be displayed.
     */
    function index(){

        // Save data from the newsletter form using POST.
        $n_daten = $_POST;

        // Boolean variable for errors.
        $fehler = false;

        // If the name isn't empty after trimming, store it.
        $name = trim($n_daten['name'] ?? NULL);

        if (empty($name)) {
            $fehler = "Name must not consist only of spaces";
            header("refresh:5; URL=localhost:9000/Ankuendigung");
            echo $fehler . "<br>";
            return view('kontakt');
        }

        // Check for data protection agreement.
        if ($n_daten['dshw'] !== 'on') {
            $fehler = "Data protection agreement was not agreed upon";
            header("refresh:5; URL=localhost:9000/Ankuendigung");
            echo $fehler . "\n";
            return view('kontakt');
        }

        // Validate email format.
        if (!filter_var($n_daten['email'], FILTER_VALIDATE_EMAIL)) {
            $fehler = "Email is not in the correct format";
            header("refresh:5; URL=localhost:9000/Ankuendigung");
            echo $fehler . "\n";
            return view('kontakt');
        }

        // Check for spam emails.
        $spammail = ['rcpt.at', 'damnthespam.at', 'wegwerfmail.de', 'trashmail'];
        foreach ($spammail as $emails) {
            if (str_contains($n_daten['email'], $emails)) {
                $fehler = "Spam email detected";
                header("refresh:5; URL=localhost:9000/Ankuendigung");
                echo $fehler . "\n";
                return view('kontakt');
            }
        }

        // If there's no error in the input, update the newsletter.
        if (!$fehler) {
            updatenewsletter($n_daten);
            echo "The data is correct and has been stored in the text file newsletter_daten";
        }

        return view('emensa');
    }
}
