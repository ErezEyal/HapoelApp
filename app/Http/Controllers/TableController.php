<?php

namespace App\Http\Controllers;

use App\Articles;
use PHPHtmlParser\Dom;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function show()
    {

        $teams = \App\Standings::getStandingsOff();
        //dd($teams);
        return view('table')->with('teams', $teams);
    }

}
