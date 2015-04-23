@extends('emails.main')

@section('body')

<h4>Новый постер</h4>
<p>Вы заказали новый постер, и мы немедлено приступаем к проверке ссылки на макет, которую вы указали.</p>
<ul>
	<li>{{ Lang::get('messages.maket_url').': '.$poster_maket_url }}</li>
	<li>{{ Lang::get('messages.papers') }} : {{ Lang::get('messages.paper_id')[$poster_paper_id] }}</li>
	<li>Размер постера:{{ $poster_w.'x'.$poster_w.' '.Lang::get('messages.paper_size_demension') }}</li>
	<li>{{ Lang::get('messages.quantity').': '.$poster_quantity }}</li>
	<li>Цена постера: {{ $poster_price }}р.</li>
</ul>
<h4>Номер Вашего заказа: {{ $order_id }} от {{ $created_at }}. Стоимость заказа: {{ $order_price }}р.</h4>
<p>Если необходимо напечать и другие постеры, самое время добавить их к заказу.</p>
<p>Ожидайте следующих писем о состоянии заказа.<br/>
Спасибо.</p>
@stop