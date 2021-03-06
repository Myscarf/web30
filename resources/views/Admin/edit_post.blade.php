@extends('layout')

@section('title', 'Обновить пост')

@section('content')
    <main class="main">

        <h1 class="h1"> Обновить данные о выпуске {{$post->series}} #{{$post->issue}}</h1>

        @if(Auth::check())

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form  class="add-post" action="edit_post" method="post" enctype="multipart/form-data">
                @csrf
                <h3 class="add-post__h3">Выберите Художника</h3>
                <select class="add-post__penciler" name="penciler_id">
                    @foreach($pencilers as $penciler)
                        <option @if($penciler->id == $post->penciler_id) selected @endif value="{{$penciler->id}}">{{$penciler->name}}</option>
                    @endforeach
                </select>
                <h3 class="add-post__h3">Выберите Персонажей</h3>

                @foreach ($characters as $character)

                    <div class="characters-check">
                    <input class="characters-check__input" type="checkbox" name="character_id[]" value="{{$character->id}}"
                           @if ($post->character->contains($character)) checked @endif>
                        <label class="characters-check__label">
                            {{$character->name}}
                        </label>
                    </div>
                @endforeach
                    <input type="hidden" name="id" value="{{$post->id}}">
                <div class="add-post__issue-data">
                    <span>Добавить обложку</span>
                    <input type="file" name="image">
                </div>
                <div class="add-post__issue-data">
                    <span>Название серии</span>
                    <input type="text" name="series" value="{{$post->series}}">
                </div>
                <div class="add-post__issue-data">
                    <span>Номер выпуска</span>
                    <input type="text" name="issue" value="{{$post->issue}}">
                </div>
                <div class="add-post__issue-data">
                    <span>Название арки</span>
                    <input type="text" name="story_arc" value="{{$post->story_arc}}">
                </div>
                <div class="add-post__issue-data">
                    <span>Очередность выпуска в арке</span>
                    <input type="text" name="story_arc-part" >
                </div>
                <div class="add-post__issue-data">
                    <span>Событие</span>
                    <input type="text" name="event" value="{{$post->event}}">
                </div>


                <h3 class="add-post__h3">Описание выпуска</h3>
                <textarea class="add-post__text" name="synopsis">{{$post->synopsis}}</textarea>
                <button class="add-post__btn">Обновить пост</button>
            </form>
        @else
            <p>Войдите чтобы иметь возможность видеть комментарии и комментировать</p>
        @endif
    </main>
@endsection
