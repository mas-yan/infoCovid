<?php

namespace App\Http\Controllers;

class covidController extends Controller
{
    public function index()
    {
        $positif = json_decode(file_get_contents("https://api.kawalcorona.com/positif"), true);
        $sembuh = json_decode(file_get_contents("https://api.kawalcorona.com/sembuh"), true);
        $meninggal = json_decode(file_get_contents("https://api.kawalcorona.com/meninggal"), true);
        $global = json_decode(file_get_contents("https://api.kawalcorona.com/"), true);

        return view('global', compact('positif', 'sembuh', 'meninggal', 'global'));
    }

    public function indonesia()
    {
        $indonesia = json_decode(file_get_contents("https://apicovid19indonesia-v2.vercel.app/api/indonesia/more"), true);
        $provinsi = json_decode(file_get_contents("https://apicovid19indonesia-v2.vercel.app/api/indonesia/provinsi/more"), true);

        return view('indonesia', compact('indonesia', 'provinsi'));
    }

    public function jateng()
    {
        $jateng = json_decode(file_get_contents(url('api/jateng')), true);
        return view('jateng', compact('jateng'));
    }

    public function kendal()
    {
        $kendal = json_decode(file_get_contents(url('api/kendal')), true);
        return view('kendal', compact('kendal'));
    }
}
