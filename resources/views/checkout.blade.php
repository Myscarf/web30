
@extends('layout')

@section('title', ' Оформление заказа')

@section('content')
    <main class="main">

        <form id="checkout" method="post" action="{{route('checkout')}}">
            @csrf
            @if (count($errors) > 0)
                <div class="alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Имя</span>
                </div>
                <input type="text" name="first_name" class="form-control" aria-label="Имя" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Фамилия</span>
                </div>
                <input type="text" name="last_name" class="form-control" aria-label="Фамилия" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Телефон</span>
                </div>
                <input type="tel" name="phone" class="form-control" aria-label="Телефон" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Адрес</span>
                </div>
                <input type="text" name="address" class="form-control" aria-label="Адрес" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Комментарии к заказу</span>
                </div>
                <textarea class="form-control" name="notes" aria-label="Комментарии к заказу"></textarea>
            </div>


            {{--Корзина--}}
            <br>
            <h3>Ваш заказ</h3>
            <br>
            <table border="1" style="width: 100%; text-align:center">
                <caption>Ваши покупки</caption>
                <tr>
                    <th>Превью</th>
                    <th>Серия</th>
                    <th>Выпуск</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Итого</th>

                </tr>
                @if (!Cart::isEmpty())
                    @foreach(\Cart::getContent() as $item)
                        <tr>
                            <td>
                                <img class="post_title"
                                     style="height: 175px; width: 114px; margin: 0 auto"
                                     src="../titles/{{$item->name}}/{{$item->attributes->cover}}">
                                </img>
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->attributes->issue}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->getPriceSum()}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                        <td>{{\Cart::getTotalQuantity()}}</td>
                        <td>{{\Cart::getTotal()}}</td>
                    </tr>
                @endif
            </table>
        <input type="submit" class="post__button" style="margin-top: 20px; height: auto">
        </form>
    </main>
@endsection
