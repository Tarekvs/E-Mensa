<?php

require_once(__DIR__.'/../models/passwort.php');

/**
 * Class anmeldung_verifizierenController
 *
 * This class is responsible for handling user registration and login functionalities.
 */
class anmeldung_verifizierenController
{
    /**
     * Processes user registration and login based on the provided request data.
     * Redirects the user to appropriate views or routes based on the outcome.
     *
     * @param RequestData $rd The request data.
     * @return mixed The appropriate view based on the outcome.
     */
    function index(RequestData $rd){

        $login = false;
        $register = false;

        $post = $rd->getPostData();

        // Check if the user wants to register.
        if ($post['action'] == "registrieren"){
            $_SESSION['action'] = "registrieren";
            $register = register($post['name'], $post['email'], $post['password'], $post['admin']);
        }
        // Check if the user wants to log in.
        else if ($post['action'] == "login"){
            $_SESSION['action'] = "login";
            $login = login($post['email'], $post['password']);
        }

        // If either registration or login is successful.
        if ($register || $login) {
            $_SESSION['eingeloggt'] = true;

            // Handle specific redirects.
            if (isset($post['redirect'])) {
                if ($post['redirect'] == "bewertung" && isset($post['gerichtid'])) {
                    header("Location:http://localhost:9000/".$post['redirect']."?gerichtid=".$post['gerichtid'], true, 301);
                    exit();
                }
            }

            return view('emensa', ['_SESSION' => $_SESSION]);
        } 
        // If both registration and login failed.
        else {
            $_SESSION['eingeloggt'] = false;
            return view('anmelden', ['_SESSION' => $_SESSION]);
        }
    }
}
