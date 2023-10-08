<?php

/**
 * Registers a new user in the database.
 *
 * @param string $name User's name.
 * @param string $email User's email address.
 * @param string $password User's password.
 * @param int $admin Specifies if the user is an admin (1 for admin, 0 for regular user).
 * @return bool Returns true on successful registration, false otherwise.
 */
function register($name, $email, $password, $admin) {
    // Salt and hash the password.
    $salt = 'dbwt';
    $hashpw = sha1($salt . $password);

    if ($name == "") {
        $name = 'Bot';
    }

    // Establish a connection to the database.
    $link = connectdb();
    $link->set_charset("utf8mb4");

    // Escape user inputs to prevent SQL injection.
    $email = mysqli_real_escape_string($link, $email);
    $name = mysqli_real_escape_string($link, $name);

    // Begin database transaction.
    $sql_begin = "BEGIN";
    mysqli_query($link, $sql_begin);

    // Check if a user with the same email already exists.
    $sql_login = "SELECT * FROM benutzer WHERE email='$email';";
    $daten = mysqli_fetch_assoc(mysqli_query($link, $sql_login));

    if (isset($daten)) {
        return false;
    }

    // Get current timestamp.
    date_default_timezone_set('Europe/Berlin');
    $format = "y-m-d h-m-s";
    $date = date($format, $_SERVER['REQUEST_TIME']);

    // Register the new user.
    $sql_register = "INSERT INTO `benutzer` 
                     (`name`,`email`,`passwort`,`admin`,`anzahlanmeldungen`,`letzteanmeldung`) 
                     VALUES
                     ('$name','$email','$hashpw',$admin,1,'$date');";
    mysqli_query($link, $sql_register);

    // Commit the transaction.
    $sql_end = "COMMIT";
    mysqli_query($link, $sql_end);

    // Set session variables.
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['anmeldungen'] = 1;
    $_SESSION['admin'] = $admin;

    logger()->info("$email hat sich registriert und angemeldet!");

    return true;
}

/**
 * Logs a user in.
 *
 * @param string $email User's email address.
 * @param string $password User's password.
 * @return bool Returns true on successful login, false otherwise.
 */
function login($email, $password) {
    // Salt and hash the password.
    $salt = 'dbwt';
    $hashpw = sha1($salt . $password);

    // Get current timestamp.
    date_default_timezone_set('Europe/Berlin');
    $format = "y-m-d h-m-s";
    $date = date($format, $_SERVER['REQUEST_TIME']);

    // Establish a connection to the database.
    $link = connectdb();
    $link->set_charset("utf8");

    // Begin database transaction.
    $sql_begin = "BEGIN";
    mysqli_query($link, $sql_begin);

    // Fetch user data based on the email.
    $sql_login = "SELECT name, email, passwort, anzahlanmeldungen as anmeldungen, admin FROM benutzer WHERE email='$email';";
    $daten = mysqli_fetch_assoc(mysqli_query($link, $sql_login));

    $success = false;

    // Check if provided email and password match the ones in the database.
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
            $sql_anmeldung = "UPDATE benutzer SET anzahlfehler = anzahlfehler + 1 WHERE email='$email';";
            mysqli_query($link, $sql_anmeldung);
            $success = false;
        }
    }

    // Commit the transaction.
    $sql_end = "COMMIT";
    mysqli_query($link, $sql_end);

    if ($success) {
        // Set session variables on successful login.
        $_SESSION['name'] = $daten['name'];
        $_SESSION['email'] = $email;
        $_SESSION['anmeldungen'] = $daten['anmeldungen'] + 1;
        $_SESSION['admin'] = $daten['admin'];

        logger()->info("$email hat sich angemeldet!");
    } else {
        logger()->warning("Anmeldung von $email fehlgeschlagen!");
    }

    return $success;
}
