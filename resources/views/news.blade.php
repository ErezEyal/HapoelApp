@extends('layouts.app')

@section('main')
    <div class="-mt-3 mx-auto bg-white border-gray-200 shadow-md rounded-sm" style="width: 752px; min-height: 80%">
        <div class="mx-10 py-6">
            @foreach($articles->slice(0, 20) as $article)
                <a href="{{ $article->url }}" class="no-underline">
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
@stop
