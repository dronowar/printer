@extends('emails.main')

@section('body')
<p>Добрый день, {{ $name }}</p>
<p>Клиент измененил макет</p>
<p>Новая ссылка на макет:</p>
<h4><a href="{{ $maket_url }}">{{ $maket_url }}</a></h4>
<p>Заказ №: {{ $order_id }}</p>
<p>Нужно перепроверить макет для печати.</p>
@stop