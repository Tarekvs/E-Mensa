<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */

return array(
    '/'             => "HomeController@emensa",
    '/Ankuendigung' => "HomeController@emensa",
    '/Speisen'      => "HomeController@speisen",
    '/Zahlen'       => "HomeController@zahlen",
    '/Kontakt'      => "HomeController@kontakt",
    '/Wichtig'      => "HomeController@wichtig",
    '/Empfehlung'   => "HomeController@empfehlung",
    '/Anmelden'     => "HomeController@anmeldung",
    '/Ausloggen'    => "HomeController@ausloggen",
    '/MyProfile'    => "HomeController@myprofile",
    '/Meinungen'      => "HomeController@meinungen",
    '/bewertung'    => "HomeController@bewertung",
    '/meinebewertungen' => "HomeController@myprofile",
    '/bewertungen' => "HomeController@bewertungen",

    '/index'        => "HomeController@index",
    '/debug'        => 'HomeController@debug',

);