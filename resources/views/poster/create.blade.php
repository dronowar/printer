@extends('app')

@section('title')
Мой новый постер
@stop

@section('content')
{!! Form::open(['url' => 'poster/store', 'method' => 'post', 'class' => 'form-horizontal']) !!}

<div class="form-group @if ($errors->has('maket_url')) has-error @endif">
	<label for="maket_url" class="col-sm-2 control-label">{{ Lang::get('messages.maket_url') }}</label>
	<div class="col-sm-5">
		{!! Form::text('maket_url', null, array('class' => 'form-control', 'placeholder' => 'Ссылка на макет (ala Dropbox, etc)')) !!}
		@if ($errors->has('maket_url'))
			<p class="bg-danger">{{ $errors->first('maket_url') }}</p>
		@endif
	</div>
</div>

<div class="form-group @if ($errors->has('papers')) has-error @endif">
	<label for="paper_id" class="col-sm-2 control-label">{{ Lang::get('messages.papers') }}</label>
	<div class="col-sm-5">
		{!! Form::select('paper_id', array('' => Lang::get('messages.paper_id')), null, array('class' => 'form-control')) !!}
		@if ($errors->has('papers'))
			<p class="bg-danger">{{ $errors->first('papers') }}</p>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('colors')) has-error @endif">
	<label for="colors" class="col-sm-2 control-label">{{ Lang::get('messages.colors') }}</label>
	<div class="col-sm-5">
		{!! Form::select('colors', array('' => Lang::get('messages.color_count')), null, array('class' => 'form-control')) !!}
		@if ($errors->has('colors'))
			<p class="bg-danger">{{ $errors->first('colors') }}</p>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('w')) has-error @endif">
	<label for="w" class="col-sm-2 control-label">{{ Lang::get('messages.w') }}</label>
	<div class="col-sm-2">
		{!! Form::text('w', null, array('class' => 'form-control', 'placeholder' => 'мм')) !!}
		@if ($errors->has('w'))
			<p class="bg-danger">{{ $errors->first('w') }}</p>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('h')) has-error @endif">
	<label for="h" class="col-sm-2 control-label">{{ Lang::get('messages.h') }}</label>
	<div class="col-sm-2">
		{!! Form::text('h', null, array('class' => 'form-control', 'placeholder' => 'мм')) !!}
		@if ($errors->has('h'))
			<p class="bg-danger">{{ $errors->first('h') }}</p>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('quantity')) has-error @endif">
	<label for="quantity" class="col-sm-2 control-label">{{ Lang::get('messages.quantity') }}</label>
	<div class="col-sm-2">
		{!! Form::text('quantity', 1, array('class' => 'form-control', 'placeholder' => 'шт.')) !!}
		@if ($errors->has('quantity'))
			<p class="bg-danger">{{ $errors->first('quantity') }}</p>
		@endif
	</div>
</div>

<div class="form-group">
<div class="col-sm-2">&nbsp;</div>
<div class="col-sm-2">
		<div class="panel panel-info">
		<div class="panel-heading">
			<div class="panel-title">Цена</div>
		</div>
			<div id="price" class="panel-body">2 200 р.</div>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-2">&nbsp;</div>
	<div class="col-sm-3">
		<button type="submit" class="btn btn-primary submit-button">Заказать постер</button>
	</div>
</div>

{!! Form::close() !!}
@stop