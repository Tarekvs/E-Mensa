<?php

require_once(__DIR__.'/../models/passwort.php');


class AnmeldungController
{
    function index(RequestData $rd){

        $login=false;
        $register=false;

        $post=$rd->getPostData();

        if ($post['action']=="registrieren"){
            $_SESSION['action']="registrieren";
            $register=register($post['name'],$post['email'],$post['password'],$post['admin']);
        }
        else if ($post['action']=="login"){
            $_SESSION['action']="login";
            $login=login($post['email'],$post['password']);
        }

        if ($register || $login) {
            $_SESSION['eingeloggt']=true;

            if (isset($post['redirect']))
            {
                if ($post['redirect'] == "bewertung")
                {
                    if (isset($post['gerichtid']))
                    {
                        header("Location:http://localhost:9000/".$post['redirect']."?gerichtid=".$post['gerichtid'],true,301);
                        exit();
                    }
                }
            }


            return view('emensa',['_SESSION'=>$_SESSION]);
        }
        else {
            $_SESSION['eingeloggt']=false;
            return view('anmelden', ['_SESSION'=>$_SESSION]);
        }
    }
}