@extends('emails.main')

@section('body')
<p>Добрый день, {{ $name }}</p>
<p>Ваш заказ №: {{ $order_id }} от {{ $created_at }} на сумму {{ $order_price }} успешно оплачен.</p>
<p>Вы можете следить за состоянием заказа на своей странице, о готовности заказа мы также уведомим на e-mail</p>
<p>Спасибо за сотрудничество!</p>
@stop