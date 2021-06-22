@extends('layout')

@section('title', 'Редактирование / Удаление')

@section('content')
    <main class="main">

        <h1 class="h1">Редактирование / Удаление постов</h1>

        @if (\Session::has('flash'))
            <p>
                {{\Session::get('flash')}}
            </p>
        @endif

        <a class="post__button" href="{{route('add_post_get')}}">ADD POST</a>
        @if(Auth::check())
            <table class="post-table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td scope="row">{{$post->id}}</td>
                        <td><a class="post__button" href="{{route('single_post', $post->id)}}">{{$post->series}} #{{$post->issue}}</a></td>
                        <td>
                            <form action="/admin/edit_post/{{$post->id}}" method="get">
                                <input type="hidden" name="id" value="{{$post->id}}">
                                <button class="post-table__bnt" type="submit">EDIT</button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <input type="hidden" name="id" value="{{$post->id}}">
                                <button class="post-table__bnt" type="submit">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </main>
@endsection
