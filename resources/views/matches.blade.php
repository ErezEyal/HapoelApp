@extends('layouts.app')

@section('main')
    <div class="-mt-3 mx-auto shadow-md rounded-sm" style="border-bottom: 1px solid #737373; color: #757575; background-color: #edeff0;width: 752px">
        <span class="block pl-6 py-4 font-bold">Upcoming matches</span>
    </div>
    <div class="mx-auto bg-white border-gray-200 shadow-md rounded-sm" style="width: 752px;">
        <div>
            @foreach([0,1,2] as $number)
                <div class="hover:bg-gray-100">
                    <div class="p-3 {{ $number < 2 ? 'border-solid' : '' }} border-t-0 border-l-0 border-r-0" style="border-color: #dfe1e5">
                        <div class="text-center text-sm" style="color: #828282">
                            <span>{{ strstr($matches["futureMatches"][$number]["location"],'(',true) }}</span>
                        </div>
                        <div class="grid grid-cols-3">
                            <div>
                                @if ($matches["futureMatches"][$number]["away"])
                                <img class="mx-auto block" src="{{ $matches["futureMatches"][$number]["rivalLogo"] }}" width="50" height="50">
                                <div class="mt-3 text-center">
                                    <span>
                                            {{ $matches["futureMatches"][$number]["teamName"] }}
                                    </span>
                                </div>
                                @else
                                    <img class="mx-auto block" src="https://media.api-sports.io/teams/4501.png" width="50" height="50">
                                    <div class="mt-3 text-center">
                                        <span>
                                            Hapoel Tel Aviv
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="py-5 text-center text-l font-bold" style="color: #535454">

                                    <span>
                                        {{ date("l, m/d/Y",$matches["futureMatches"][$number]["date"]) }}
                                        {{ $matches["futureMatches"][$number]["date"] < time() ? ' (postponed)' : ''}}
                                    </span>
                                </div>

                                <div class="text-center text-sm">
                                    <span>
                                    {{ $matches["futureMatches"][$number]["league"] == "Ligat ha'Al" ? 'Israeli Premier League' : $matches["futureMatches"][$number]["league"]}}
                                    </span>
                                </div>
                            </div>
                            <div>
                                @if (! $matches["futureMatches"][$number]["away"])
                                    <img class="mx-auto block" src="{{ $matches["futureMatches"][$number]["rivalLogo"] }}" width="50" height="50">
                                    <div class="mt-3 text-center">
                                    <span>
                                            {{ $matches["futureMatches"][$number]["teamName"] }}
                                    </span>
                                    </div>
                                @else
                                    <img class="mx-auto block" src="https://media.api-sports.io/teams/4501.png" width="50" height="50">
                                    <div class="mt-3 text-center">
                                        <span>
                                            Hapoel Tel Aviv
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
        <div class="mx-auto border-gray-200 shadow-md rounded-sm" style="border-bottom: 1px solid #737373; color: #757575; background-color: #edeff0;width: 752px">
            <span class="inline-block pl-6 py-4 font-bold">Recent matches </span>
            <div class="inline-block pl-2 w-64">
{{--                @foreach(['W','W','L','D','W'] as $letter)--}}
{{--                    @switch($letter)--}}
{{--                        @case('W')--}}
{{--                        <span class="match-win text-center">&check;</span>--}}
{{--                        @break--}}

{{--                        @case('D')--}}
{{--                        <span class="match-draw text-center" style="font-size: 14px">&minus;</span>--}}
{{--                        @break--}}

{{--                        @default--}}
{{--                        <span class="match-lose text-center">&#10006;</span>--}}
{{--                    @endswitch--}}
{{--                @endforeach--}}
            </div>
{{--            TO DO !!!!--}}
        </div>
        <div class="mx-auto bg-white border-gray-200 shadow-md rounded-sm" style="width: 752px;">
        <div>
            @foreach(array_reverse(array_slice($matches['pastMatches'],-5)) as $match)
                @if ($match['GoalsFor'] > $match['GoalsAgainst'])
                    <div class="hover:bg-green-100">
                @elseif ($match['GoalsFor'] < $match['GoalsAgainst'])
                    <div class="hover:bg-red-100">
                @else
                    <div class="hover:bg-gray-100">
                @endif
                    <div class="p-3 border-solid border-t-0 border-l-0 border-r-0" style="border-color: #dfe1e5">
                    <div class="text-center" style="color: #828282">
                        <span>{{ date("l, m/d/Y",$match["date"]) }}</span>
                    </div>
                        <div class="grid grid-cols-3">
                            <div>
                                @if ($match["away"])
                                    <img class="mx-auto block" src="{{ $match["rivalLogo"] }}" width="50" height="50">
                                    <div class="mt-3 text-center">
                                    <span>
                                            {{ $match["teamName"] }}
                                    </span>
                                    </div>
                                @else
                                    <img class="mx-auto block" src="https://media.api-sports.io/teams/4501.png" width="50" height="50">
                                    <div class="mt-3 text-center">
                                        <span>
                                            Hapoel Tel Aviv
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="py-5 text-center text-xl font-bold" style="color: #535454">
                                    <span>{{ ! $match['away'] ? $match['GoalsFor'] : $match['GoalsAgainst'] }}</span>
                                    <span class="mx-6">:</span>
                                    <span>{{ $match['away'] ? $match['GoalsFor'] : $match['GoalsAgainst'] }}</span>
                                </div>

                                <div class="text-center text-sm">
                                    <span>
                                        {{ $match["league"] == "Ligat ha'Al" ? 'Israeli Premier League' : $match["league"]}}
                                    </span>
                                </div>
                            </div>
                            <div>
                                @if (! $match["away"])
                                    <img class="mx-auto block" src="{{ $match["rivalLogo"] }}" width="50" height="50">
                                    <div class="mt-3 text-center">
                                    <span>
                                            {{ $match["teamName"] }}
                                    </span>
                                    </div>
                                @else
                                    <img class="mx-auto block" src="https://media.api-sports.io/teams/4501.png" width="50" height="50">
                                    <div class="mt-3 text-center">
                                        <span>
                                            Hapoel Tel Aviv
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@stop
