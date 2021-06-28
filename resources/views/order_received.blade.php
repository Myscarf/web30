
@extends('layout')

@section('title', 'Заказ оформлен')

@section('content')
    <main class="main">


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
        <h3>Контактные данные заказщика</h3>
        <table>
        <tr>
            <th>ФИО</th>
                <td>{{$order->first_name}}{{$order->last_name}}</td>
        </tr>
        <tr>
            <th>Телефон</th>
                <td>{{$order->phone}}</td>
        </tr>
        <tr>
            <th>Адрес</th>
                <td>{{$order->address}}</td>
        </tr>
        <tr>
            <th>Комментарий</th>
                <td>{{$order->notes}}</td>
        </tr>
        </table>

        <button type="button" class="btn btn-outline-success">Оплатить</button>
    </main>
@endsection
