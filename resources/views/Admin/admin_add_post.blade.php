@extends('layout')

@section('title', 'Добавить пост')

@section('content')
    <main class="main">

        <h1 class="h1"> Добавить пост</h1>

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

            <form  class="add-post" action="add_post" method="post" enctype="multipart/form-data">
                @csrf
                <h3 class="add-post__h3">Выберите Художника</h3>
                <select class="add-post__penciler" name="penciler_id">
                    @foreach($pencilers as $penciler)
                        <option value="{{$penciler->id}}">{{$penciler->name}}</option>
                    @endforeach
                </select>
                <h3 class="add-post__h3">Выберите Персонажей</h3>

                    @foreach($characters as $character)
                        <div class="characters-check">
                            <input class="characters-check__input" type="checkbox" name="character_id[]" value="{{$character->id}}">
                            <label class="characters-check__label">
                                {{$character->name}}
                            </label>
                        </div>
                    @endforeach
                <div class="add-post__issue-data">
                    <span>Добавить обложку</span>
                    <input type="file" name="image">
                </div>
                <div class="add-post__issue-data">
                    <span>Название серии</span>
                    <input type="text" name="series">
                </div>
                <div class="add-post__issue-data">
                    <span>Номер выпуска</span>
                    <input type="text" name="issue">
                </div>
                <div class="add-post__issue-data">
                    <span>Название арки</span>
                    <input type="text" name="story_arc">
                </div>
                <div class="add-post__issue-data">
                    <span>Очередность выпуска в арке</span>
                    <input type="text" name="story_arc-part">
                </div>
                <div class="add-post__issue-data">
                    <span>Событие</span>
                    <input type="text" name="event">
                </div>


                <h3 class="add-post__h3">Описание выпуска</h3>
                <textarea class="add-post__text" name="synopsis"></textarea>
                <button class="add-post__btn">Добавить пост</button>
            </form>
        @else
            <p>Войдите чтобы иметь возможность видеть комментарии и комментировать</p>
        @endif
    </main>
@endsection
