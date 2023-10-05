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
    "/demo"         => "DemoController@demo",
    '/dbconnect'    => 'DemoController@dbconnect',
    '/debug'        => 'HomeController@debug',
    '/error'        => 'DemoController@error',
    '/requestdata'  => 'DemoController@requestdata',

    // Erstes Beispiel:
    '/m4_7a_queryparameter' => 'ExampleController@m4_7a_queryparameter',
    '/m4_7b_kategorie' => 'ExampleController@m4_7b_kategorie',
    '/m4_7c_gerichte' => 'ExampleController@m4_7c_gerichte',
    '/m4_7d_layout' => 'ExampleController@m4_7d_layout',


);