<?php

namespace App;

class Matches
{
    static function getMatches()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/fixtures/team/4501",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: api-football-v1.p.rapidapi.com",
                "x-rapidapi-key: dd5d8f5c1emsh0ebd4d9bccdee77p1c0d75jsn814da2560774"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $futureMatches = [];
            $pastMatches = [];
            $fixtures = json_decode($response)->api->fixtures;
            foreach ($fixtures as $fixture)
            {
                if ($fixture->goalsHomeTeam !== null){
                    $pastMatches[] = [
                        "teamName" => $fixture->homeTeam->team_id == 4501 ? $fixture->awayTeam->team_name : $fixture->homeTeam->team_name,
                        "away" => $fixture->homeTeam->team_id == 4501 ? false : true,
                        "GoalsFor" => $fixture->homeTeam->team_id == 4501 ? $fixture->goalsHomeTeam : $fixture->goalsAwayTeam,
                        "GoalsAgainst" => $fixture->homeTeam->team_id == 4501 ? $fixture->goalsAwayTeam : $fixture->goalsHomeTeam,
                        "rivalLogo" => $fixture->homeTeam->team_id == 4501 ? $fixture->awayTeam->logo : $fixture->homeTeam->logo,
                        "date" => $fixture->event_timestamp,
                        "league" => $fixture->league->name,
                        "location" => $fixture->venue
                    ];
                }
                else {
                    $futureMatches[] = [
                        "teamName" => $fixture->homeTeam->team_id == 4501 ? $fixture->awayTeam->team_name : $fixture->homeTeam->team_name,
                        "away" => $fixture->homeTeam->team_id == 4501 ? false : true,
                        "rivalLogo" => $fixture->homeTeam->team_id == 4501 ? $fixture->awayTeam->logo : $fixture->homeTeam->logo,
                        "date" => $fixture->event_timestamp,
                        "league" => $fixture->league->name,
                        "location" => $fixture->venue,
                        "postponed" => $fixture->event_timestamp < time()
                    ];
                }
            }
            $matches = [
                "pastMatches" => $pastMatches,
                "futureMatches" => $futureMatches
            ];

            file_put_contents('matches.txt', json_encode($matches));
            return $matches;
        }
    }

    static function getMatchesOffline()
    {
        $my_arr = json_decode(file_get_contents('matches.txt'), true);
        return $my_arr;
    }
}
