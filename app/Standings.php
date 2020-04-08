<?php

namespace App;

class Standings
{
    static function getStandings()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/leagueTable/637",
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
            $standings = json_decode($response)->api->standings[2];

            return $standings;
        }
    }

    static function getStandingsOff()
    {
        $my_arr = json_decode(file_get_contents('league.txt'), true);
        return $my_arr;
    }
}
