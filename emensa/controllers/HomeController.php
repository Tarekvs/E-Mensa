<?php
require_once(__DIR__.'/../models/gericht.php');
require_once(__DIR__.'/../models/zahlen.php');
require_once(__DIR__.'/../models/newsletter.php');
require_once(__DIR__.'/../models/bewertung.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {
        return view('home', ['rd' => $request ]);
    }
    
    public function debug(RequestData $request) {
        return view('debug');
    }

    public function emensa(){
        logger()->info("Hauptseite wurde besucht!");
        return view('emensa');
    }
    public function speisen(){
        $data = db_gericht_tabelle();
        return view('speisen',['data' => $data]);
    }
    public function zahlen(){
        $besucher=besucherzahlen();
        $anmeldungen=newsletteranmeldungen();
        $gerichte=anzahl_gerichte();


        return view('zahlen',['zahlen'=>[$besucher,$anmeldungen,$gerichte]]);
    }
    public function kontakt(){
        return view('kontakt');
    }
    public function wichtig(){
        return view('wichtig');
    }
    public function empfehlung(){
        return view('empfehlung');
    }
    public function anmeldung(){
        return view ('anmelden');
    }
    public function ausloggen(){
        session_destroy();
        logger()->info("User hat sich abgemeldet!");
        return view ('anmelden');
    }
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

            return view('myprofile',['_SESSION'=>$_SESSION, 'ratings' => $myratings]);
        }

        else
        {
            return view('myprofile',['_SESSION'=>$_SESSION]);
        }
    }

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

    public function meinungen(){

        return view('meinungen' , ['markedratings' => markedratings()]);
    }
}

