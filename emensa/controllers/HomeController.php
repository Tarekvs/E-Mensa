<?php

require_once(__DIR__.'/../models/gericht.php');
require_once(__DIR__.'/../models/zahlen.php');
require_once(__DIR__.'/../models/newsletter.php');
require_once(__DIR__.'/../models/bewertung.php');

/**
 * Class HomeController
 *
 * This class is responsible for handling the primary views and functionalities of the application.
 */
class HomeController
{
    /**
     * Displays the home view.
     *
     * @param RequestData $request The request data.
     * @return mixed The home view.
     */
    public function index(RequestData $request) {
        return view('home', ['rd' => $request ]);
    }
    
    /**
     * Displays the debug view.
     *
     * @param RequestData $request The request data.
     * @return mixed The debug view.
     */
    public function debug(RequestData $request) {
        return view('debug');
    }

    /**
     * Logs the visit to the main page and displays the main view.
     *
     * @return mixed The emensa view.
     */
    public function emensa(){
        logger()->info("Main page was visited!");
        return view('emensa');
    }

    /**
     * Retrieves the dishes data and displays the dishes view.
     *
     * @return mixed The dishes view with the dishes data.
     */
    public function speisen(){
        $data = db_gericht_tabelle();
        return view('speisen',['data' => $data]);
    }

    /**
     * Retrieves various statistics and displays the statistics view.
     *
     * @return mixed The statistics view with the gathered data.
     */
    public function zahlen(){
        $besucher = besucherzahlen();
        $anmeldungen = newsletteranmeldungen();
        $gerichte = anzahl_gerichte();
        return view('zahlen',['zahlen' => [$besucher, $anmeldungen, $gerichte]]);
    }

    /**
     * Displays the contact view.
     *
     * @return mixed The contact view.
     */
    public function kontakt(){
        return view('kontakt');
    }

    /**
     * Displays the important information view.
     *
     * @return mixed The important view.
     */
    public function wichtig(){
        return view('wichtig');
    }

    /**
     * Displays the recommendation view.
     *
     * @return mixed The recommendation view.
     */
    public function empfehlung(){
        return view('empfehlung');
    }

    /**
     * Displays the registration view.
     *
     * @return mixed The registration view.
     */
    public function anmeldung(){
        return view('anmelden');
    }

    /**
     * Logs the user out and displays the registration view.
     *
     * @return mixed The registration view.
     */
    public function ausloggen(){
        session_destroy();
        logger()->info("User has logged out!");
        return view('anmelden');
    }

    /**
     * Displays the profile view for the logged-in user.
     *
     * @return mixed The profile view with the user's data.
     */
    public function myprofile(){

        if(isset($_SESSION['name']))
        {
            $myratings = myratings($_SESSION['name']);

            if (isset($_GET['delete-rating']))
            {
                $user = getrating($_GET['delete-rating'])[0]['benutzer'];

                if ($user == $_SESSION['name'])
                {
                    deleterating($_GET['delete-rating']);
                    header("Location:http://localhost:9000/MyProfile",true,301);
                    exit();
                }
            }
        }
        return view('myprofile',['_SESSION'=>$_SESSION, 'ratings' => $myratings]);
    }
    /**
     * Handles the dish rating functionalities.
     *
     * @return mixed The appropriate view based on the user's actions.
     */
    public function bewertung()
    {
        if (isset($_SESSION['eingeloggt']) && $_SESSION['eingeloggt'] == true)
        {
            if (isset($_GET['gerichtid']))
            {
                $gericht = select_gericht_id($_GET['gerichtid']);
                $ratings = getratings(($_GET['gerichtid']));

                if (isset($_POST['benutzer']) && isset($_POST['gerichtid']) && isset($_POST['bemerkung'])&& isset($_POST['bewertung']))
                {
                    addrating($_POST['benutzer'], $_POST['bemerkung'], $_POST['bewertung'],$_POST['gerichtid']);
                    header("refresh:0");
                }

                if (isset($_GET['delete-rating']))
                {
                    $user = getrating($_GET['delete-rating'])[0]['benutzer'];

                    if ($user == $_SESSION['name'])
                    {
                        deleterating($_GET['delete-rating']);
                        header("Location:http://localhost:9000/bewertung?gerichtid=".$_GET['gerichtid'],true,301);
                        exit();
                    }
                }

                return view('bewertung', ['data' => $gericht, 'ratings' => $ratings]);
            }

        }
        else
        {
            header("Location:http://localhost:9000/Anmelden?redirect=bewertung&gerichtid=".$_GET['gerichtid'],true,301);
            exit();
        }

    }
    

    /**
     * Handles the functionalities related to all ratings.
     *
     * @return mixed The ratings view with the relevant data.
     */
    public function bewertungen()
        {
            $allratings = getallratings();
            $admin = isadmin($_SESSION['name']);
            $isadmin = 0;
    
            if (isset($admin[0]['admin']) && $admin[0]['admin'] == 1)
            {
                $isadmin = 1;
            }
    
    
            if (isset($_GET['delete-rating']))
            {
                $user = getrating($_GET['delete-rating'])[0]['benutzer'];
    
                if ($user == $_SESSION['name'])
                {
                    deleterating($_GET['delete-rating']);
                    header("Location:http://localhost:9000/bewertungen",true,301);
                    exit();
                }
            }
    
            if (isset($_GET['mark']) && isset($_GET['rating-id']))
            {
                if ($_GET['mark'] == "nein")
                {
                    mark_rating($_GET['rating-id'],false);
                }
    
                if($_GET['mark'] == "ja")
                {
                    mark_rating($_GET['rating-id'],true);
                }
    
                header("Location:http://localhost:9000/bewertungen",true,301);
                exit();
            }
    
            return view('bewertungen', ['ratings' => $allratings, 'isadmin' => $isadmin]);
        }
    

    /**
     * Displays the opinions view with marked ratings.
     *
     * @return mixed The opinions view with marked ratings.
     */
    public function meinungen(){

        return view('meinungen' , ['markedratings' => markedratings()]);
    }
}
