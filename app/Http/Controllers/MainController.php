<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Matches;
use App\Standings;
use phpDocumentor\Reflection\Types\Collection;

class MainController extends Controller
{
    public function showHome()
    {
        $teams = Standings::getStandingsOff();
        $articles = Article::all()->sortBy('date',SORT_REGULAR, true);
        foreach ($articles as $article) {
            $article->title = htmlspecialchars_decode(html_entity_decode($article->title),ENT_QUOTES);
            $article->description = htmlspecialchars_decode(html_entity_decode($article->description),ENT_QUOTES);
        }
        $matches = Matches::getMatchesOffline();
        return view('home', compact('articles','matches','teams'));

    }

    public function showNews()
    {
        $articles = Article::all()->sortBy('date',SORT_REGULAR, true);

        return view('news')->with('articles', $articles);
    }

    public function showMatches()
    {
        $matches = Matches::getMatchesOffline();
        return view('matches')->with('matches', $matches);
    }

    public function allArticles()
    {
        $articles = Article::all()->sortBy('date',SORT_REGULAR, true);
        foreach ($articles as $article) {
            $article->title = htmlspecialchars_decode(html_entity_decode($article->title),ENT_QUOTES);
            $article->description = htmlspecialchars_decode(html_entity_decode($article->description),ENT_QUOTES);
        }
        return $articles;
    }

        public function loading() {

        return view('loading');
    }
}
