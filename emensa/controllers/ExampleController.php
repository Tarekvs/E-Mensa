<?php
require_once(__DIR__.'/../models/kategorie.php');
require_once(__DIR__.'/../models/gericht.php');

class ExampleController

{
    public function m4_7a_queryparameter(RequestData $rd) {

        if(isset($_GET['name']))
        {
            $rd -> query['name'];
        }

        return view('examples.m4_7a_queryparameter', [
            'request'=>$rd,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }

    public function m4_7b_kategorie()
    {
        $name_kat_gericht = db_kategorie_select_all_asc();
        return view('examples.m4_7b_kategorie', ["db_data" => $name_kat_gericht]);
    }

    public function m4_7c_gerichte()
    {
        $gericht_preisint_groeßer2 = db_gericht_intprice_bigger2();
        return view('examples.m4_7c_gerichte', ["db_data" => $gericht_preisint_groeßer2]);
    }

    public function m4_7d_layout(RequestData $rd)
    {
        $no = $rd->query['no'] ?? '1';

        if ($no == '1')
        {
            return view('examples.pages.m4_7d_page_1');
        }

        elseif ($no == '2')
        {
            return view('examples.pages.m4_7d_page_2');
        }
    }
}