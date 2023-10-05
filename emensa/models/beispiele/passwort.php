<?php

    function register($name,$email,$password,$admin)

    {
        $salt = 'dbwt';
        $hashpw = sha1($salt . $password);
        if ($name=="")
            $name='Bot';

        $link = connectdb();
        $link -> set_charset("utf8mb4");

        $email = mysqli_real_escape_string($link ,$email);
        $name = mysqli_real_escape_string($link ,$name);

        //Beginn der Transaktion
        $sql_begin="BEGIN";
        mysqli_query($link,$sql_begin);

        $sql_login="SELECT * FROM benutzer WHERE email='$email';";
        $daten=mysqli_fetch_assoc(mysqli_query($link,$sql_login));

        //Prüft ob Benutzer mit email bereits existiert
        if (isset($daten))
            return false;

        date_default_timezone_set('Europe/Berlin');
        $format="y-m-d h-m-s";
        $date=date($format, $_SERVER['REQUEST_TIME']);

        $sql_register = "INSERT INTO `benutzer` 
                         (`name`,`email`,`passwort`,`admin`,`anzahlanmeldungen`,`letzteanmeldung`) 
                         VALUES
                         ('$name','$email','$hashpw',$admin,1,'$date');";

        mysqli_query($link, $sql_register);

        //Ende der Transaktion
        $sql_end="COMMIT";
        mysqli_query($link,$sql_end);

        //Setze Benötigte Variablen in $_SESSION Variable
        $_SESSION['name']=$name;
        $_SESSION['email']=$email;
        $_SESSION['anmeldungen']=1;
        $_SESSION['admin']=$admin;

        logger()->info("$email hat sich registriert und angemeldet!");

        return true;
    }

    function login($email,$password){

        $salt = 'dbwt';
        $hashpw=sha1($salt . $password);


        date_default_timezone_set('Europe/Berlin');
        $format="y-m-d h-m-s";
        $date=date($format, $_SERVER['REQUEST_TIME']);

        $link= connectdb();
        $link -> set_charset("utf8");

        //Beginn der Transaktion
        $sql_begin="BEGIN";
        mysqli_query($link,$sql_begin);

        $sql_login="SELECT name, email, passwort, anzahlanmeldungen as anmeldungen, admin FROM benutzer WHERE email='$email';";
        $daten=mysqli_fetch_assoc(mysqli_query($link,$sql_login));

        //Defaultwert Login Erfolg
        $success=false;

        //Falls Query mit Werten zurückkommt
        if (isset($daten)) {

            if ($daten['email'] == $email && $daten['passwort'] == $hashpw) {
                $sql_anmeldung = "UPDATE benutzer SET letzteanmeldung='$date' WHERE email='$email';";
                mysqli_query($link, $sql_anmeldung);
                $sql_anmeldung = "CALL inkrAnzahlAnmeldungen('$email');";
                mysqli_query($link, $sql_anmeldung);
                $success = true;
            } else {
                $sql_anmeldung = "UPDATE benutzer SET letzterfehler='$date' WHERE email='$email';";
                mysqli_query($link, $sql_anmeldung);
                $sql_anmeldung = "UPDATE benutzer SET anzahlfehler = anzahlfehler + 1  WHERE email='$email';";
                mysqli_query($link, $sql_anmeldung);
                $success = false;
            }
        }

        //Ende der Transaktion
        $sql_end="COMMIT";
        mysqli_query($link,$sql_end);

        if($success)
        {
            //Setze benötigte Variablen in $_SESSION Variable
            $_SESSION['name']=$daten['name'];
            $_SESSION['email']=$email;
            $_SESSION['anmeldungen']=$daten['anmeldungen']+1;
            $_SESSION['admin']=$daten['admin'];

            logger()->info("$email hat sich angemeldet!");

        }

        else
        {
            logger()->warning("Anmeldung von $email fehlgeschlagen!");
        }

        return $success;
    }

