@extends('layout')

@section('title', 'Новости')

@section('content')
    <main class="main">
        <h1 class="h1">Новости о новых выпусках</h1>

        @foreach($posts as $post)
        <div class="post">
            <img class="post_title" src="../titles/{{$post->series}}/{{$post->cover}}"></img>
            <div class="post_description">
                <h3 class="post_header">{{$post->series}} #{{$post->issue}}</h3>
                <span class="post__text"><b>Серия: </b></span> <span>{{$post->series}}</span><br>
                <span class="post__text"><b>Событие: </b></span> <span>{{$post->event}}</span><br>
                <span class="post__text"><b>Арка: </b></span> <span>{{$post->story_arc}}</span><br>
                <span class="post__text"><b>Художник: </b></span>  <a  class="post__item" href="{{route('post_by_penciler', $post->penciler->key)}}">{{$post->penciler->name}}</a><br>
                <div class="post__characters">
                    <b> Персонажи:</b>
                    @foreach($post->character as $char)
                        <a class="post__item" href="{{route('post_by_character', $char->key)}}">{{$char->name}}</a>
                    @endforeach
                </div>
                <span class="post__text"><b>Дата выхода :</b></span> <span>{{date('d-m-Y', strtotime($post->released))}}</span><br>
                <span class="post__text"><b>Краткий обзор :</b></span> <p class="post__synopsis">{{mb_substr($post->synopsis, 0, 400)}}...</p><br>
                <a href="{{route('single_post', $post->id)}}" class="post__button">Читать далее </a>
            </div>
        </div>
        @endforeach
    </main>
@endsection

