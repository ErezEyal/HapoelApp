@extends('layouts.app')

@section('main')
{{-- Dashboard section   --}}
    <div id="dashboard" class="section -mt-3 p-10 mx-auto" style="width: 1300px; min-height: 80%">
        <div class="flex mx-auto" style="width: 1300px">
            <div class="w-1/4 ">

                <div class="p-3 pt-2 border-gray-300 bg-white rounded-md rounded-b-sm border-solid mb-4 overflow-hidden">
                    <div class="-mt-2 -ml-5 -mr-5 p-2" style="background-color: #F3F3F3">
                        <span class="bg-red-600 p-2 text-xs tracking-wide text-white">League Table</span>
                        <a href="javascript:showSection('table');"><span class="pr-2 text-xs tracking-wide float-right text-gray-700 underline">Full table</span></a>
                    </div>
                    <table class="table-auto border-collapse text-center">
                        <tbody>
                        @foreach ($teams as $team)
                            @if($team["rank"] < 15)
                            <tr style="color: #373737; font-size: 14px; border-top: 1px solid #f1f3f4;"
                                class="py-0 h-10 hover:bg-gray-100 {{ $team["teamName"] == 'Hapoel Tel Aviv' ? 'font-bold' : '' }}">
                                <td class="text-left pr-8">
                                    <div class="pl-1 w-8 inline-block text-center">{{ $team["rank"] }}</div>
                                    <div class="inline-block w-6"><img class="align-middle" src="{{ $team["logo"] }}" width="24" height="24"></div>
                                    <div class="inline-block pl-2">{{ $team["teamName"] }}</div>
                                </td>
                                <td class="px-2">{{ $team["points"] }}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <h2 style="font-family: Monospace" class="p-2 py-1 text-gray-700">Social Media</h2>
                <div class="grid grid-cols-4 gap-4">
                    <a href="https://www.facebook.com/HapoelTelAvivFC/" target="_blank" class="p-2 pt-3 border-gray-400 border-solid bg-white rounded-md"> <img src="facebook.png" width="40px" class="block mx-auto"> </a>
                    <a href="https://twitter.com/hapoeltelavivfc" target="_blank" class="p-2 pt-3 border-gray-400 border-solid bg-white rounded-md"> <img src="twitter.png" width="40px" class="block mx-auto"> </a>
                    <a href="https://www.youtube.com/user/HapoelTelAvivFC" target="_blank" class="p-2 pt-4 border-gray-400 border-solid bg-white rounded-md"> <img src="youtube.jpg" width="40px" class="block mx-auto"> </a>
                    <a href="https://www.instagram.com/hapoeltafc" target="_blank" class="p-2 border-gray-400 border-solid bg-white rounded-md"> <img src="instagram.png" width="40px" class="block mx-auto"> </a>
                </div>


            </div>
            <div class="w-1/2 px-12">
                <div name="matches" class="p-3 pt-2 border-gray-300 bg-white rounded-md rounded-b-sm border-solid mb-6 overflow-hidden">
                    <div class="-mt-2 -ml-5 -mr-5 p-2" style="background-color: #F3F3F3">
                        <span class="bg-red-600 p-2 text-xs tracking-wide text-white">Latest Matches</span>
                        <a href="javascript:showSection('matches');"><span class="pr-2 text-xs tracking-wide float-right text-gray-700 underline">All matches</span></a>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="pr-4 mt-2 border-solid border-gray-300 border-b-0 border-l-0 border-t-0">
                            <div class="flex pt-2 pr-2 mb-5">
                                <div class="w-11/12">
                                    <span class="text-xs leading-normal font-bold">
                                        {{ date("D, F d", array_slice($matches['pastMatches'],-1)[0]["date"]) }} <br>
                                    </span>
                                    <span class="text-sm text-gray-600 leading-normal">
                                            {{ array_slice($matches['pastMatches'],-1)[0]["league"] == "Ligat ha'Al" ? 'Israeli Premier League' : array_slice($matches['pastMatches'],-1)[0]["league"]}}
                                    </span>
                                </div>
                                <div class="mx-auto w-1/12 mt-2">
                                    @if (array_slice($matches['pastMatches'],-1)[0]["away"])
                                        <span class="p-2 mt-2 border-solid rounded-md border-gray-200 text-red-600 font-bold"> A </span>
                                    @else
                                        <span class="p-2 mt-2 border-solid rounded-md border-gray-200 text-red-600 font-bold"> H </span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3 flex">
                                <div class="w-1/5">
                                    <img class="align-middle" src="{{ array_slice($matches['pastMatches'],-1)[0]["rivalLogo"] }}" width="50">
                                </div>
                                <div class="w-1/2">
                                    <span class="ml-2 text-sm align-middle" style="line-height: 50px">{{ array_slice($matches['pastMatches'],-1)[0]["teamName"] }} </span>
                                </div>
                                <div class="w-1/3">
                                    <span class="ml-4 text-4xl font-mono align-middle {{ array_slice($matches['pastMatches'],-1)[0]["away"] ? 'text-gray-800' : 'text-red-600' }} ">{{ array_slice($matches['pastMatches'],-1)[0]["away"] ? array_slice($matches['pastMatches'],-1)[0]["GoalsAgainst"] : array_slice($matches['pastMatches'],-1)[0]["GoalsFor"]}}</span>
                                    <span class="text-2xl font-mono align-middle font-bold text-gray-600">-</span>
                                    <span class="text-4xl font-mono align-middle {{ array_slice($matches['pastMatches'],-1)[0]["away"] ? 'text-red-600' : 'text-gray-800' }} ">{{ array_slice($matches['pastMatches'],-1)[0]["away"] ? array_slice($matches['pastMatches'],-1)[0]["GoalsFor"] : array_slice($matches['pastMatches'],-1)[0]["GoalsAgainst"]}} </span>
                                </div>
                            </div>
                        </div>

                        <div class="px-2 mt-2">
                            <div class="flex pt-2 pl-2 pr-1 mb-5">
                                <div class="w-11/12">
                                    <span class="text-xs leading-normal font-bold">
                                        {{ date("D, F d", array_slice($matches['pastMatches'],-2)[0]["date"]) }} <br>
                                    </span>
                                    <span class="text-sm text-gray-600 leading-normal">
                                            {{ array_slice($matches['pastMatches'],-2)[0]["league"] == "Ligat ha'Al" ? 'Israeli Premier League' : array_slice($matches['pastMatches'],-2)[0]["league"]}}
                                    </span>
                                </div>
                                <div class="mx-auto w-1/12 mt-2">
                                    @if (array_slice($matches['pastMatches'],-2)[0]["away"])
                                        <span class="p-2 mt-2 border-solid rounded-md border-gray-200 text-red-600 font-bold"> A </span>
                                    @else
                                        <span class="p-2 mt-2 border-solid rounded-md border-gray-200 text-red-600 font-bold"> H </span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3 flex">
                                <div class="w-1/5">
                                    <img class="align-middle" src="{{ array_slice($matches['pastMatches'],-2)[0]["rivalLogo"] }}" width="50">
                                </div>
                                <div class="w-1/2">
                                    <span class="ml-2 text-sm align-middle" style="line-height: 50px">{{ array_slice($matches['pastMatches'],-2)[0]["teamName"] }} </span>
                                </div>
                                <div class="w-1/3">
                                    <span class="ml-4 text-4xl font-mono align-middle {{ array_slice($matches['pastMatches'],-2)[0]["away"] ? 'text-gray-800' : 'text-red-600' }} ">{{ array_slice($matches['pastMatches'],-2)[0]["away"] ? array_slice($matches['pastMatches'],-2)[0]["GoalsAgainst"] : array_slice($matches['pastMatches'],-2)[0]["GoalsFor"]}}</span>
                                    <span class="text-2xl font-mono align-middle font-bold text-gray-600">-</span>
                                    <span class="text-4xl font-mono align-middle {{ array_slice($matches['pastMatches'],-2)[0]["away"] ? 'text-red-600' : 'text-gray-800' }} ">{{ array_slice($matches['pastMatches'],-2)[0]["away"] ? array_slice($matches['pastMatches'],-2)[0]["GoalsFor"] : array_slice($matches['pastMatches'],-2)[0]["GoalsAgainst"]}} </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                    <div id="article" dir="rtl" class=" overflow-hidden border-solid rounded-lg rounded-b-sm bg-white relative" style="border-color: #dfe1e5">
                        <div class="mb-2 relative article-animation">
                            <a :href="article.url" target="_blank" class="no-underline">
                                <img class="w-full" height="360" :src="article.image">
                                <div class="h-full w-16" style="position: absolute; bottom: 0px; right: 0px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0) , rgba(0, 0, 0, 0.1));"></div>
                                <a v-on:click="indexUp" style="user-select: none; -webkit-user-select: none; -moz-user-select: none; position: absolute;top: 0; right: 0; line-height: 360px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0) , rgba(0, 0, 0, 0.2));" class="cursor-pointer hover:font-bold hover:text-red-500 pr-6 pl-10 text-3xl text-white no-underline">&#10094;</a>
                                <a v-on:click="indexDown" style="user-select: none; -webkit-user-select: none; -moz-user-select: none; position: absolute;top: 0; left: 0; line-height: 360px; background-image: linear-gradient(to left, rgba(0, 0, 0, 0) , rgba(0, 0, 0, 0.2));" class="cursor-pointer hover:font-bold hover:text-red-500 pl-6 pr-10 text-3xl text-white no-underline">&#10095;</a>
                                <a :href="article.url"><div v-text="article.site" target="_blank" style="position: absolute; top: 10px; left: 10px; background-color: rgba(128, 128, 128, 0.8); border-color: rgba(255, 255, 255, 0.5)" class="border-solid text-sm text-white px-2 py-1 rounded-md"></div></a>
                            </a>
                        </div>

                        <div class="p-2 article-animation" style="height: 155px; position: relative">

                                <h2 id="articletitle" v-text="article.title" class="font-bold m-1 mt-0 text-gray-800"></h2>
                                <div class="my-2 mx-1">
                                    <span v-text="article.date" style="color: #70757a; font-size: 12px"></span>
                                </div>
                                <p class="m-1 text-gray-800">
                                    @{{ article.description }}
    {{--                                {{ strlen(html_entity_decode($articles->first()->description)) < 300 ? html_entity_decode($articles->first()->description) : substr(html_entity_decode($articles->first()->description),0,300) . '...' }}--}}
                                    <a class="px-1 text-sm no-underline text-indigo-700" target="_blank" :href="article.url"> לכתבה המלאה</a>
                                </p>

                            <div dir="ltr" style="position: absolute; bottom: 10px; left: 10px">
    {{--                         <span class="text-sm" v-text="article.site" style="color: #70757a"></span>--}}
                            </div>
                        </div>
                    </div>
            </div>
            <div class="w-1/4">

                <div style="width: 300px" class="p-3 px-0 pb-0 pt-2 border-gray-300 bg-white rounded-md rounded-b-sm border-solid mb-6 overflow-hidden">
                    <div class="-mt-2 -ml-5 -mr-5 p-2" style="background-color: #F3F3F3">
                        <span class="p-2 pl-5 text-xs tracking-wide text-white" style="background-color: #00ACEC">Hapoel On Twitter</span>
                    </div>

                    <div style="height: 705px; overflow: auto">
                        <a class="twitter-timeline" data-chrome="noheader nofooter" data-theme="light" href="https://twitter.com/ErezEyal/lists/hapoel-feed?ref_src=twsrc%5Etfw"></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>

            </div>
        </div>
    </div>

{{-- Table section   --}}
    <div id="table" class="section">
        <div class="-mt-3 mx-auto border-gray-200 shadow-md rounded-sm" style="border-bottom: 1px solid #e7e7e7; color: #757575; font-size: 12px; background-color: #f1f3f4;width: 752px">
            <span class="block pl-6 pt-4">Season</span>
            <span class="block pl-6 pt-1 pb-2 font-bold" style="font-size: 14px; color: #4286f4">2019-20 </span>
        </div>
        <div class="mx-auto border-gray-200 shadow-md rounded-sm bg-white" style="border-bottom: 1px solid #e7e7e7; color: black; font-size: 12px; width: 752px">
            <div class="flex">
                <div class="w-1/2" style="border-bottom: 2px solid #e7e7e7; border-color: black">
                    <span class="block w-32 mx-auto pl-10 pt-4 pb-4 font-bold">Regular season</span>
                </div>
                <div class="w-1/2">
                    <span class="pl-2 block w-32 mx-auto pl-20 pt-4 pb-4 font-bold" style="color: #70757a">Playoff</span>
                </div>
            </div>
        </div>
        <div class="pt-1 pb-6 mx-auto bg-white border-gray-200 shadow-md rounded-sm" style="width: 752px">
            <div>
                <table class="table-auto border-collapse text-center">
                    <thead>
                    <tr style="color: #757575; font-size: 12px">
                        <td></td>
                        <th class="pl-4 pr-2 py-2 font-normal"><p style="margin-right: 19rem">Club</p></th>
                        <th class="px-2 py-2 font-normal">MP</th>
                        <th class="px-2 py-2 font-normal">W</th>
                        <th class="px-2 py-2 font-normal">D</th>
                        <th class="px-2 py-2 font-normal">L</th>
                        <th class="px-2 py-2 font-normal">GF</th>
                        <th class="px-2 py-2 font-normal">GA</th>
                        <th class="px-2 py-2 font-normal">GD</th>
                        <th class="pl-2 py-2 font-normal">Pts</th>
                        <th class="px-2 py-2 font-normal">Last 5</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teams as $team)
                        <tr style="color: #373737; font-size: 14px; border-top: 1px solid #f1f3f4;"
                            class="py-0 h-10 hover:bg-gray-100">
                            @if($team["rank"] < 7)
                                <td style="background-color: #4286f4; width: 0.1em"></td>
                            @else
                                <td style="background-color: #ea4435; width: 0.1em"></td>
                            @endif
                            <td class="text-left pr-2">
                                <div class="pl-4 w-6 inline-block text-center">{{ $team["rank"] }}</div>
                                <div class="inline-block w-6"><img class="align-middle" src="{{ $team["logo"] }}" width="24" height="24"></div>
                                <div class="inline-block pl-2">{{ $team["teamName"] }}</div>
                            </td>
                            <td class="px-2">{{ $team["all"]["matchsPlayed"] }}</td>
                            <td class="px-2">{{ $team["all"]["win"] }}</td>
                            <td class="px-2">{{ $team["all"]["draw"] }}</td>
                            <td class="px-2">{{ $team["all"]["lose"] }}</td>
                            <td class="px-2">{{ $team["all"]["goalsFor"] }}</td>
                            <td class="px-2">{{ $team["all"]["goalsAgainst"] }}</td>
                            <td class="px-2">{{ $team["goalsDiff"] }}</td>
                            <td class="pl-2">{{ $team["points"] }}</td>
                            <td class="pl-2 w-64">
                                @foreach(str_split($team["forme"]) as $letter)
                                    @switch($letter)
                                        @case('W')
                                        <span class="match-win">&check;</span>
                                        @break

                                        @case('D')
                                        <span class="match-draw">&minus;</span>
                                        @break

                                        @default
                                        <span class="match-lose">&#10006;</span>
                                    @endswitch
                                @endforeach
                            </td>
                            <td class="w-24 overflow-hidden border-solid border-white border-b-0 border-r-0 border-l-0"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

{{-- News section   --}}
    <div id="news" class="section -mt-3 mx-auto bg-white border-gray-200 shadow-md rounded-sm" style="width: 752px; min-height: 80%">
        <div class="mx-10 py-6">
            @foreach($articles->slice(0, 20) as $article)
                <a href="{{ $article->url }}" target="_blank" class="no-underline">
                    <div class="py-4 flex border-solid border-t-0 border-r-0 border-l-0 mb-3" style="border-color: #dfe1e5">
                        <div class="w-2/3" dir="rtl">
                            <div><h3 class="text-gray-800 my-0">{{ html_entity_decode($article->title) }}</h3></div>
                            <div class="mb-3"><p class="text-gray-700">{{ html_entity_decode($article->description) }}</p></div>
                            <div>
                                <span class="text-sm" style="color: #70757a">{{ $article->site }}</span>
                                <span style="color: #70757a; font-size: 14px;">&#183;</span>
                                <span style="color: #70757a; font-size: 12px">{{ $article->date->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="w-1/3">
                            <div>
                                <img class="float-right" src="{{ $article->image}}" width="200" height="150">
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>

{{-- Matches section--}}

    <div id="matches" class="section">
            <div class="mx-auto" style="width: 800px">
                <div class="pt-3 pb-1 ml-6">
                    <button id="recentButton" onclick="recentMatches()" class="cursor-pointer hover:bg-gray-700 outline-none px-3 mr-2 py-2 font-bold shadow-sm text-sm bg-gray-700 text-gray-200 rounded-md border-gray-400 border-solid">Recent Matches</button>
                    <button id="nextButton" onclick="nextMatches()" class="cursor-pointer hover:bg-gray-700 outline-none px-3 py-2 font-bold shadow-sm text-sm bg-gray-500 text-gray-200 rounded-md border-gray-400 border-solid">Next Matches</button>
                </div>
                <div id="futureMatches" class="hidden">
                @foreach($matches['futureMatches'] as $match)
                    <div class="flex borader-solid border-gray-400 my-6 bg-white rounded-lg rounded-b-none shadow-md">

                        <div class="w-1/3 text-center px-6">
                            <div class="mt-10">
                                            <span class="" style="color: #828282">
                                                {{ strstr($match["location"], '(', true) }} <br>
                                            </span>
                                <div class="py-3">
                                                <span class="py-3 font-bold text-gray-800">
                                                    {{ date("l, m/d/Y",$match["date"]) }} <br>
                                                    {{ $match["date"] < time() ? ' (postponed)' : ''}}
                                                    @if($match["date"] < time())
                                                        <br>
                                                    @endif
                                                </span>
                                </div>
                                <span class="text-sm text-gray-600 leading-normal">
                                                    {{ $match["league"] == "Ligat ha'Al" ? 'Israeli Premier League' : $match["league"]}}
                                            </span>
                            </div>
                        </div>

                        <div class="w-1/3 -ml-3 pl-1">
                            <div class="mt-8">
                                <img class="align-middle block mx-auto" src="{{ $match["rivalLogo"] }}" width="60">
                            </div>
                            <div class="text-center mb-8 mt-2">
                                <span class="text-lg align-middle">{{ $match["teamName"] }} </span>
                            </div>
                        </div>



                        <div class="px-2 -mr-8 mt-2 relative w-1/3">
                            <div class="text-center m-6">
                                @if ($match["away"])
                                    <span class="p-1 px-3 mt-2 border-solid text-sm rounded-md border-gray-200 text-white bg-red-600 font-bold"> Away </span>
                                @else
                                    <span class="p-1 px-3 mt-2 border-solid text-sm rounded-md border-gray-200 text-white bg-red-600 font-bold"> Home </span>
                                @endif
                            </div>
                            <div class="text-center m-6">
{{--                                <span style="font-size: 50px" class="font-mono align-middle {{ $match["away"] ? 'text-gray-800' : 'text-red-600' }} ">{{ $match["away"] ? $match["GoalsAgainst"] : $match["GoalsFor"]}}</span>--}}
                                <span class="text-3xl mx-2 font-mono align-middle font-bold text-gray-600">-</span>
{{--                                <span style="font-size: 50px" class="font-mono align-middle {{ $match["away"] ? 'text-red-600' : 'text-gray-800' }} ">{{ $match["away"] ? $match["GoalsFor"] : $match["GoalsAgainst"]}} </span>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <div id="recentMatches">
                    @foreach(array_reverse(array_slice($matches['pastMatches'],-20)) as $match)
                        <div class="flex borader-solid border-gray-400 my-6 bg-white rounded-lg rounded-b-none shadow-md">

                            <div class="w-1/3 text-center px-6">
                                <div class="mt-12">
                                            <span class="" style="color: #828282">
                                                {{ strstr($match["location"], '(', true) }} <br>
                                            </span>
                                    <div class="py-3">
                                                <span class="py-3 font-bold text-gray-800">
                                                    {{ date("l, m/d/Y",$match["date"]) }} <br>
                                                </span>
                                    </div>
                                    <span class="text-sm text-gray-600 leading-normal">
                                                    {{ $match["league"] == "Ligat ha'Al" ? 'Israeli Premier League' : $match["league"]}}
                                            </span>
                                </div>
                            </div>

                            <div class="w-1/3 -ml-3 pl-1">
                                    <div class="mt-8">
                                        <img class="align-middle block mx-auto" src="{{ $match["rivalLogo"] }}" width="60">
                                    </div>
                                    <div class="text-center mb-8 mt-2">
                                        <span class="text-lg align-middle">{{ $match["teamName"] }} </span>
                                    </div>
                            </div>



                            <div class="px-2 -mr-8 mt-2 relative w-1/3">
                                <div class="text-center m-6 mb-6">
                                    @if ($match["away"])
                                        <span class="p-1 px-3 mt-2 border-solid text-sm rounded-md border-gray-200 text-white bg-red-600 font-bold"> Away </span>
                                    @else
                                        <span class="p-1 px-3 mt-2 border-solid text-sm rounded-md border-gray-200 text-white bg-red-600 font-bold"> Home </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <span style="font-size: 50px" class="font-mono align-middle {{ $match["away"] ? 'text-gray-800' : 'text-red-600' }} ">{{ $match["away"] ? $match["GoalsAgainst"] : $match["GoalsFor"]}}</span>
                                    <span class="text-3xl mx-2 font-mono align-middle font-bold text-gray-600">-</span>
                                    <span style="font-size: 50px" class="font-mono align-middle {{ $match["away"] ? 'text-red-600' : 'text-gray-800' }} ">{{ $match["away"] ? $match["GoalsFor"] : $match["GoalsAgainst"]}} </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

@stop
