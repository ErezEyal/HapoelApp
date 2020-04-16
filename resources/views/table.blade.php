@extends('layouts.app')

@section('main')
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
@stop
