@extends('layout')

@section('title', $post->series . ' #' . $post->issue)

@section('content')
    <main class="main">

            <div class="post post_auto-height">
                <img class="post_title" src="../titles/{{$post->series}}/{{$post->cover}}"></img>
                <div class="post_description">
                    <h3 class="post_header">{{$post->series}} #{{$post->issue}}</h3>
                    <span class="post__text"><b>Серия: </b></span> <span>{{$post->series}}</span><br>
                    <span class="post__text"><b>Событие: </b></span> <span>{{$post->event}}</span><br>
                    <span class="post__text"><b>Арка: </b></span> <span>{{$post->story_arc}}</span><br>
                    <span class="post__text"><b>Главный редактор: </b></span><br>
                    <span class="post__text"><b>Автор обложки: </b></span><br>
                    <span class="post__text"><b>Сценарист: </b></span><br>
                    <span class="post__text"><b>Художник: </b></span>  <a  class="post__item" href="{{route('post_by_penciler', $post->penciler->key)}}">{{$post->penciler->name}}</a><br>
                    <div class="post__characters">
                        <b> Персонажи:</b>
                        @foreach($post->character as $char)
                            <a class="post__item" href="{{route('post_by_character', $char->key)}}">{{$char->name}}</a>
                        @endforeach
                    </div>
                    <span class="post__text"><b>Дата выхода :</b></span> <span>{{date('d-m-Y', strtotime($post->created_at))}}</span><br>
                    <span class="post__text"><b>Краткий обзор :</b></span> <span class="post__synopsis">{{$post->synopsis}}</span><br>
                </div>
            </div>
        @if(Auth::check())
            @if(count($comments) == 0)<p>Комментариев пока нет.</p>@endif
            @foreach($comments as $comment)
                <div class="post-comments">
                <div class="post-comments__author"> Автор: <b>{{$comment->author}}</b></div>
                <div class="post-comments__body">{{$comment->comment}}</div>
                <div class="post-comments__date">Добавлен {{$comment->created_at}}</div>
                </div>
            @endforeach
            <form class="save-comment" action="save_comment" method="post">
                @csrf
                <h2>Добавить коментарий</h2>
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <input type="hidden" name="author" value="{{Auth::user()->name}}">
                <textarea class="save-comment__text" name="comment"></textarea>
                <button class="save-comment__btn">Добавить комментарий</button>
            </form>
        @else
            <p>Войдите чтобы иметь возможность видеть комментарии и комментировать</p>
            @endif
    </main>
@endsection
