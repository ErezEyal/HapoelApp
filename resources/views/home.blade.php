@extends('layouts.app')

@section('main')
    <div class="-mt-3 p-10 mx-auto" style="width: 1300px; min-height: 80%">
        <div class="flex mx-auto" style="width: 1300px">
            <div class="w-1/4 ">
{{--                <div class="-mt-10">--}}
{{--                    <img src="hapoel.png" class="block mx-auto" width="200px">--}}
{{--                </div>--}}

                <div class="p-3 pt-2 border-gray-300 bg-white rounded-md rounded-b-sm border-solid mb-6 overflow-hidden">
                    <div class="-mt-2 -ml-5 -mr-5 p-2" style="background-color: #F3F3F3">
                        <span class="bg-red-600 p-2 text-xs tracking-wide text-white">League Table</span>
                        <a href="/standings"><span class="pr-2 text-xs tracking-wide float-right text-gray-700 underline">Full table</span></a>
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
                <h2 style="font-family: Monospace" class="p-2 text-gray-700">Social Media</h2>
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
                        <a href="/matches"><span class="pr-2 text-xs tracking-wide float-right text-gray-700 underline">All matches</span></a>
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

                <div dir="rtl" class="overflow-hidden border-solid rounded-lg rounded-b-sm bg-white" style="border-color: #dfe1e5">
                    <div class="mb-4">
                        <a href="{{ $articles->first()->url}}" target="_blank" class="no-underline">
                            <img class="w-full" src="{{ $articles->first()->image}}">
                        </a>
                    </div>

                    <div class="p-2 pt-1">

                            <h2 class="font-bold m-1 text-gray-800">{{ html_entity_decode($articles->first()->title) }}</h2>
                            <div class="my-2 mx-1">
                                <span style="color: #70757a; font-size: 12px">{{ $articles->first()->date->format('F j, o - H:i') }}</span>
                            </div>
                            <p class="m-1 text-gray-800">
                                {{ strlen(html_entity_decode($articles->first()->description)) < 300 ? html_entity_decode($articles->first()->description) : substr(html_entity_decode($articles->first()->description),0,300) . '...' }}
                                <a class="px-1 text-sm no-underline" target="_blank" href="{{ $articles->first()->url}}"> לכתבה המלאה</a>
                            </p>

                        <div dir="ltr">
                         <span class="text-sm" style="color: #70757a">{{ $articles->first()->site }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bag-blue-200 w-1/4">

                <div style="width: 300px" class="p-3 px-0 pb-0 pt-2 border-gray-300 bg-white rounded-md rounded-b-sm border-solid mb-6 overflow-hidden">
                    <div class="-mt-2 -ml-5 -mr-5 p-2" style="background-color: #F3F3F3">
                        <span class="p-2 pl-5 text-xs tracking-wide text-white" style="background-color: #00ACEC">Hapoel On Twitter</span>
                    </div>

                    <div style="height: 720px; overflow: auto">
                        <a class="twitter-timeline" data-chrome="noheader nofooter" data-theme="light" href="https://twitter.com/ErezEyal/lists/hapoel-feed?ref_src=twsrc%5Etfw"></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
