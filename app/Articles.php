<?php

namespace App;

//require "../vendor/autoload.php";
use PHPHtmlParser\Dom;
use App\Article;

class Articles
{

    private const SITES = array(
        "sport5" => "https://www.sport5.co.il/team.aspx?FolderID=164&lang=he",
        "one" => "https://www.one.co.il/Soccer/team/5",
        "sport1" => "https://sport1.maariv.co.il/Statistics/Team/567",
        "walla" => "https://sports.walla.co.il/team/738?league=157",
        "ynet" => "https://www.ynet.co.il/tags/%D7%94%D7%A4%D7%95%D7%A2%D7%9C_%D7%AA%D7%9C_%D7%90%D7%91%D7%99%D7%91"
    );

    // return an array of article from all news sites
    public static function getArticles()
    {
        // fetch all articles and save them in one array
        self::updateArticleFiles();
        $articles = array_merge(
            self::getSport5Articles(),
            self::getOneArticles(),
            self::getSport1Articles(),
            self::getWallaArticles(),
            self::getYnetArticles()
            );

        // persist the articles in the DB
        foreach ($articles as $piece)
        {
            $article = new Article;
            $article->url = $piece["url"];
            $article->title = $piece["title"];
            $article->description = $piece["description"];
            $article->date = $piece["date"];
            $article->image = $piece["image"];
            $article->site = $piece["site"];

            if (Article::where('url', $piece["url"])->doesntExist())
                $article->save();
        }

        // remove old articles from the DB
        $thirtyDaysAgo = time() - 2592000;
        Article::where('date', '<', $thirtyDaysAgo)->delete();

        //usort($articles, array("self","sortFunction"));
        return $articles;
    }

    //sort articles by date
    private static function sortFunction( $a, $b ) {
        return $a["date"] < $b["date"];
    }

    // update html files of all news sites
    public static function updateArticleFiles()
    {

        foreach (self::SITES as $site => $url) {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'browser'
            ]);
            $result = curl_exec($curl);
            curl_close($curl);
            file_put_contents($site . '.txt', $result);
        }

    }

    // return an array of articles from sport5.txt
    public static function getSport5Articles()
    {
        $dom = new Dom;
        $i = 0;
        $articles = array();

        $div = $dom->loadFromFile('sport5.txt')->getElementsByClass('info-container')[0]->outerHtml;

        $headings = $dom->load($div)->getElementsByTag('h2');
        $desc = $dom->load($div)->getElementsByTag('p');
        $dates = $dom->load($div)->getElementsbyClass('date');
        $images = $dom->load($div)->getElementsByTag('img');
        $links = $dom->load($div)->getElementsByTag('a');

        foreach ($links as $link) {
            if ($i > 9)
                break;
            $article = html_entity_decode($link->getAttribute('href'));
            if (strpos($link->outerHtml, 'articles.aspx?') !== false & ! in_array($article, array_column($articles, 'url'))
            & strpos($link->outerHtml, 'link') == false & strpos($link->outerHtml, 'footer') == false) {
                $date = \DateTime::createFromFormat('d.m.y - H:i P', $dates[$i]->innerHtml . " +0300")->format('U');
                $articles[] = [
                    'url' => $article,
                    'title' => $headings[$i]->firstChild()->innerHtml,
                    'description' => $desc[$i]->firstChild()->innerHtml,
                    'date' => $date,
                    'image' => $images[$i]->getAttribute('src'),
                    'site' => 'Sport 5'
                ];
                $i = $i+1;
            }
        }

        return $articles;

    }

    // return an array of articles from one.txt
    public static function getOneArticles()
    {
        $dom = new Dom;
        $i = 0;
        $html = file_get_contents("one.txt");
        $html = iconv("windows-1255", "utf-8", $html);
        $html = str_replace("charset=windows-1255", "charset=utf-8", $html);

        $div = $dom->load($html)->getElementsByClass('leagues-right-column')[0]->outerHtml;
        $headings = $dom->load($div)->getElementsByTag('h2');
        $desc = $dom->load($div)->getElementsByTag('h3');
        $images = $dom->load($div)->getElementsByTag('img');
        $links = $dom->load($div)->getElementsByTag('a');

        $articles = array();
        foreach ($links as $link) {
            if ($i > 9)
                break;
            $article = html_entity_decode($link->getAttribute('href'));
            $a = substr($link->outerHtml, 0, 100);
            if (strpos($a, 'Article/') !== false & ! in_array("https://www.one.co.il" . $article, array_column($articles, 'url'))) {
                $date = self::getOneArticleDate("https://www.one.co.il" . $article);
                $date = \DateTime::createFromFormat('d/m/Y H:i P', $date . " +0300")->format('U');
                $articles[] = [
                    'url' => "https://www.one.co.il" . $article,
                    'title' => $headings[$i]->innerHtml,
                    'description' => $desc[$i]->innerHtml,
                    'date' => $date,
                    'image' => $images[$i]->getAttribute('src'),
                    'site' => 'One'
                ];
                $i = $i+1;
            }
        }

        return $articles;
    }

    // return the date of an article from One
    private static function getOneArticleDate($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'browser'
        ]);
        $article = curl_exec($curl);
        $article = iconv("windows-1255", "utf-8", $article);
        $article = str_replace("charset=windows-1255", "charset=utf-8", $article);
        curl_close($curl);

        $dom = new Dom;
        $date = $dom->load($article)->getElementsByClass('article-credit')[0]->firstChild()->innerHtml;
        return $date;
    }

    // return an array of articles from sport1.txt
    public static function getSport1Articles()
    {
        $dom = new Dom;
        $i = 0;

        $div = $dom->loadFromFile('sport1.txt')->getElementsByClass('category-article-list')[0]->outerHtml;
        $links = $dom->load($div)->getElementsByTag('a');

        $headings = $dom->load($div)->getElementsByClass('list-article-item-title');
        $desc = $dom->load($div)->getElementsByTag('h4');
        $dates = $dom->load($div)->getElementsbyClass('category-article-content');
        $images = $dom->load($div)->getElementsByTag('img');

        $articles = array();
        foreach ($links as $link) {
            if ($i > 9)
                break;
            $article = html_entity_decode($link->getAttribute('href'));
            if (strpos($link->outerHtml, 'Article-') !== false & !in_array("https://sport1.maariv.co.il" . $article, array_column($articles, 'url'))
                & strpos($link->outerHtml, 'best-player') == false) {
                $words = explode(" ", $dates[$i]->getChildren()[1]->getChildren()[7]->innerHtml);
                $date = array_pop($words) . " " . array_pop($words);
                $date = \DateTime::createFromFormat('H:i d/m/Y P', $date . " +0300")->format('U');
                $articles[] = [
                    'url' => "https://sport1.maariv.co.il" . $article,
                    'title' => $headings[$i]->innerHtml,
                    'description' => $desc[$i]->innerHtml,
                    'date' => $date,
                    'image' => $images[$i]->getAttribute('src'),
                    'site' => 'Sport 1'
                ];
                $i = $i+1;
            }
        }

        return $articles;
    }

    // return an array of articles from walla.txt
    public static function getWallaArticles()
    {
        $i = 0;
        $dom = new Dom;
        //$all = $dom->loadFromFile('walla.txt')->getElementsByTag('a');

        $div = $dom->loadFromFile('walla.txt')->getElementsByClass('common-articles')[0]->outerHtml;
        $div = $div . $dom->loadFromFile('walla.txt')->getElementsByClass('common-articles')[1]->outerHtml;
        $headings = $dom->load($div)->getElementsByClass('title');
        $desc = $dom->load($div)->getElementsByTag('p');
        $dates = $dom->load($div)->getElementsbyTag('time');
        $images = $dom->load($div)->getElementsByTag('img');
        $links = $dom->load($div)->getElementsByTag('a');

        $articles = array();
        foreach ($links as $link) {
            if ($i > 9)
                break;
            $article = html_entity_decode($link->getAttribute('href'));
            if (strpos($link->outerHtml, 'sports.walla.co.il/item/') !== false & ! in_array($article, array_column($articles, 'url'))
                & strpos($link->outerHtml, 'data-itemid') !== false) {
                $date = \DateTime::createFromFormat('H:i d/m/Y P', $dates[$i]->innerHtml . " +0300")->format('U');
                $articles[] = [
                    'url' => $article,
                    'title' => $headings[$i]->getChildren()[1]->getChildren()[1]->innerHtml,
                    'description' => $desc[$i]->innerHtml,
                    'date' => $date,
                    'image' => "https:" . $images[$i]->getAttribute('src'),
                    'site' => 'Walla'
                ];
                $i = $i + 1;
            }
        }
        return $articles;
    }

    // return an array of articles from ynet.txt
    public static function getYnetArticles()
    {
        $i = 0;
        $dom = new Dom;
        $div = $dom->loadFromFile('ynet.txt')->getElementsByClass('ghciTopicsGossipHeadlineList1')[0]->outerHtml;
        $articles = array();

        $headings = $dom->load($div)->getElementsByClass('smallheader');
        //$desc = $dom->load($div)->getElementsByClass('text12');
        $dates = $dom->load($div)->getElementsbyClass('gossipArtDetails');
        $images = $dom->load($div)->getElementsByTag('img');
        $links = $dom->load($div)->getElementsByTag('a');
        foreach ($links as $link) {
            $article = html_entity_decode($link->getAttribute('href'));
            if (strpos($link->outerHtml, 'articles/') !== false & !in_array("https://www.ynet.co.il" . $article, array_column($articles, 'url'))) {
                $date = rtrim(explode(" ", $dates[$i]->innerHtml)[3], ",)") . " " . rtrim(explode(" ", $dates[$i]->innerHtml)[5], ",)");
                $date = \DateTime::createFromFormat('d.m.y H:i P', $date . " +0300")->format('U');
                $articles[] = [
                    'url' => "https://www.ynet.co.il" . $article,
                    'title' => $headings[$i]->innerHtml,
                    'description' => self::getYnetArticleDesc("https://www.ynet.co.il" . $article),
                    'date' => $date,
                    'image' => $images[$i]->getAttribute('src'),
                    'site' => 'Ynet'
                ];
                $i = $i + 1;
            }
        }
        return $articles;
    }

    // return the description of an article from Ynet
    private static function getYnetArticleDesc($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'browser'
        ]);
        $article = curl_exec($curl);
        curl_close($curl);

        $dom = new Dom;
        $desc = $dom->load($article)->getElementsByClass('art_header_sub_title')[0]->innerHtml;
        return $desc;

    }

}
