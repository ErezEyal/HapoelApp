<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Matches;
use phpDocumentor\Reflection\Types\Collection;

class MainController extends Controller
{
    public function showNews()
    {
        //$articles = collect([]);
        $articles = Article::all()->sortBy('date',SORT_REGULAR, true);

        return view('news')->with('articles', $articles);
    }

    public function showMatches()
    {
        $matches = Matches::getMatchesOffline();
        return view('matches')->with('matches', $matches);
    }
}
