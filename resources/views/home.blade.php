@extends('app')

@section('title')
Моя страница
@stop

@section('content')
<h2>Мои заказы</h2>
{{ \Debugbar::info(Session::all()) }}
@if (Session::has('message.success'))
	<p class="alert alert-success">{{ Session::get('message.success') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	</p>
@elseif (Session::has('message.error'))
	<p class="alert alert-danger">{{ Session::get('message.error') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	</p>
@endif

<p><a href="{{ action('PosterController@create') }}" class="btn btn-success">+ Новый постер</a></p>

@foreach($orders as $order)
	<div class="panel panel-default">
		<div class="panel-heading">Номер заказа: {{ $order->id }} от {{ $order->created_at }}</div>
		<div class="panel-body">
			<table class="table">
			@if ($order['order_status'] == 0)
				@foreach($order->posters as $poster)
				<tr>
					@include('poster_td')
					<td class="col-md-6 text-center">
						<div class="
						@if ($poster['maket_status'] == 0) bg-info
						@elseif ($poster['maket_status'] == 1) bg-success
						@elseif ($poster['maket_status'] == 2) bg-danger
						@endif
						" style="padding:20px;">
							<p style="line-height:20px">{{ Lang::get('messages.maket_status')[$poster['maket_status']] }}</p>
							@if ($poster['maket_status'] == 2)
								{!! Form::open(['action' => array('PosterController@update', $poster->id), 'method' => 'get', 'class' => 'form-inline']) !!}
									<div class="form-group @if ($errors->has('maket_url')) has-error @endif">
										
										<div class="">
											{!! Form::text('maket_url', null, array('class' => 'form-control', 'placeholder' => 'Новая ссылка на макет')) !!}
										</div>
									</div>	
									<button type="submit" class="btn btn-default">Отправить</button>
									@if ($errors->has('maket_url'))
										<p class="bg-danger">{{ $errors->first('maket_url') }}</p>
									@endif
									<div>&nbsp;</div>
								{!! Form::close() !!}
							@endif
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#confirm{{ $poster->id }}">Удалить</button>
							<!-- <a href="{{ action('PosterController@destroy', $poster->id) }}" id="delete" class="btn btn-danger btn-xs">Отменить</a> -->
							<div id="confirm{{ $poster->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4>Вы уверены, что хотите удалить постер?</h4>
									</div>
								  	
								<div class="modal-footer">
								    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
								    <a href="{{ action('PosterController@destroy', $poster->id) }}" class="btn btn-danger">Удалить</a>
								</div>

								</div>
							</div>
							</div>
					</td>
				</tr>
				@endforeach
			@elseif ($order['order_status'] == 1)
				<tr>
					@include('poster_td', ['poster' => $order->posters[0]])
					<td class="text-center" rowspan="{{ count($order->posters) }}">
						<div class="bg-success" style="padding:20px;">
						<p style="line-height:20px">{{ Lang::get('messages.order_status')[$order['order_status']] }}</p>
						<!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center"><tbody><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/ru/webapps/mpp/paypal-popup" title="PayPal Как это работает" onclick="javascript:window.open('https://www.paypal.com/ru/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/ru_RU/mktg/business/pages/logo-center/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark" /></a></td></tr></tbody></table><!-- PayPal Logo -->
						<br/><a href="{{ route('payment', $order['id']) }}" class="btn btn-primary">Оплатить с помощью PayPal</a>
						</div>
					</td>
				</tr>
				@for ($i = 1; $i < count($order->posters); $i++)
				<tr>
					@include('poster_td', ['poster' => $order->posters[$i]])
				</tr>
				@endfor
			@elseif ($order['order_status'] == 2)
				<tr>
					@include('poster_td', ['poster' => $order->posters[0]])
					<td class="text-center" rowspan="{{ count($order->posters) }}">
						<div class="bg-primary" style="padding:20px;">
						<p style="line-height:20px">{{ Lang::get('messages.order_status')[$order['order_status']] }}</p>
						</div>
					</td>
				</tr>
				@for ($i = 1; $i < count($order->posters); $i++)
				<tr>
					@include('poster_td', ['poster' => $order->posters[$i]])
				</tr>
				@endfor
			@elseif ($order['order_status'] == 3)
				<tr>
					@include('poster_td', ['poster' => $order->posters[0]])
					<td class="text-center" rowspan="{{ count($order->posters) }}">
						<div class="bg-success" style="padding:20px;">
						<p style="line-height:20px">{{ Lang::get('messages.order_status')[$order['order_status']] }}</p>
						<p>Вы можете забрать его по адресу:<br/> {{ $order['delivery_adress']}}</p>
						</div>
					</td>
				</tr>
				@for ($i = 1; $i < count($order->posters); $i++)
				<tr>
					@include('poster_td', ['poster' => $order->posters[$i]])
				</tr>
				@endfor
			@endif

			</table>
			<div style="border-top:dotted 2px; border-color:#E0E0E0; padding-top:10px;"><strong>Стоимость заказа: {{ $order->order_price }} р.</strong></div>
		</div>
	</div>
@endforeach

<p><a href="#">Архив заказов</a></p>

@stop
