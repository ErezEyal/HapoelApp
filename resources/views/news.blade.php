@extends('layouts.app')

@section('main')
    <div class="-mt-3 mx-auto bg-white border-gray-200 shadow-md rounded-sm" style="width: 752px; min-height: 80%">
        <div class="mx-6 py-6">
            @foreach($articles->slice(0, 20) as $article)
                <a href="{{ $article->url }}" class="no-underline">
                    <div class="p-4 flex border-solid rounded-lg mb-3" style="border-color: #dfe1e5">
                        <div class="w-3/4">
                            <div class="mb-3"><span class="hover:underline">{{ html_entity_decode($article->title) }}</span></div>
                            <div>
                                <span class="text-sm" style="color: #70757a">{{ $article->site }}</span>
                                <span style="color: #70757a; font-size: 14px;">&#183;</span>
                                <span style="color: #70757a; font-size: 12px">{{ $article->date->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="w-1/4">
                            <div>
                                <img class="float-right" src="{{ $article->image}}" width="137" height="77">
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
@stop
