
@extends('layout')

@section('title', 'Корзина')

@section('content')
    <main class="main">

        @if (\Session::has('flash'))
            <p>
                {{\Session::get('flash')}}
            </p>
        @endif
                @if (!Cart::isEmpty())
        <form id="checkout" method="post" action="{{route('update_cart')}}">
            @csrf
            <table border="1" style="width: 100%; text-align:center">
                <caption>Ваши покупки</caption>
                <tr>
                    <th>ID</th>
                    <th>Превью</th>
                    <th>Серия</th>
                    <th>Выпуск</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Итого</th>
                    <th>Удалить</th>
                </tr>

                    @foreach(\Cart::getContent() as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>
                                <img class="post_title"
                                     style="height: 175px; width: 114px; margin: 0 auto"
                                     src="../titles/{{$item->name}}/{{$item->attributes->cover}}">
                                </img>
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->attributes->issue}}</td>
                            <td>{{$item->price}}</td>
                            <td><input type="number" name="items [{{$item->id}}]"
                                       value="{{$item->quantity}}">
                            </td>
                            <td>{{$item->getPriceSum()}}</td>
                            <td>
                                <a class="post__button"
                                   style="background-color: aquamarine"
                                   href="{{route('delete_from_cart', $item->id)}}">Удалить</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5"></td>
                        <td>{{\Cart::getTotalQuantity()}}</td>
                        <td>{{\Cart::getTotal()}}</td>
                        <td></td>
                    </tr>

            </table>
            <a><div class="post__button"
                    style="background-color: aquamarine; height: auto"
                    href="#"
                    onclick="document.getElementById('checkout').submit()">Обновить корзину</div></a>
        </form>
        <a href="{{route('checkout')}}"><div class="post__button" style="margin-top: 20px; height: auto; width: 210px">Перейти к оформлению</div></a>
            @else
                <p>Ваша корзина пуста</p>
            @endif
    </main>
@endsection
