@extends('app')

@section('title')
Моя страница
@stop

@section('content')
<h2>Моя страница</h2>
{{ \Debugbar::info(Session::all()) }}
@if(Session::has('flash_message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('flash_message') }}</p>
@endif
@foreach($orders as $order)
	<div class="panel panel-default">
		<div class="panel-heading">Номер заказа: {{ $order->id }} от {{ $order->created_at }}</div>
		<div class="panel-body">
			<table class="table">
				@foreach($order->posters as $poster)
				<tr>
					<td class="col-md-6">
						<ul class="list-unstyled">
						<li><small>{{ Lang::get('messages.maket_url').': '.$poster['maket_url'] }}</small></li>
						<li><small>{{ Lang::get('messages.papers') }} : {{ Lang::get('messages.paper_id')[$poster['paper_id']] }}</small></li>
						<li><small>{{ $poster['w'].'x'.$poster['w'].' '.Lang::get('messages.paper_size_demension') }}</small></li>
						<li><small>{{ Lang::get('messages.quantity').': '.$poster['quantity'] }}</small></li>
						</ul>
					</td>
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
							<a href="{{ action('PosterController@destroy', $poster->id) }}" class="btn btn-danger btn-xs">Отменить</a>
						</div>
					</td>
				</tr>
				@endforeach
			</table>
			<div>Стоимость заказа: {{ $order->order_price }} р.</div>
		</div>
	</div>
	
@endforeach
<a href="{{ action('PosterController@create') }}" class="btn btn-success">Новый постер</a>
@stop