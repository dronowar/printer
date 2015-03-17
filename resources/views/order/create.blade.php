@extends('app')

@section('title')
Мой новый постер
@stop

@section('content')
{!! Form::open(['url' => 'order/store', 'class' => 'form-horizontal']) !!}

<div class="form-group">
	<label for="maket_url" class="col-sm-2 control-label">{{ Lang::get('messages.maket_url') }}</label>
	<div class="col-sm-5">
		{!! Form::text('maket_url', null, array('class' => 'form-control', 'placeholder' => 'Ссылка на макет (ala Dropbox, etc)')) !!}
	</div>
</div>
<div class="form-group">
	<label for="paper_id" class="col-sm-2 control-label">{{ Lang::get('messages.paper_id') }}</label>
	<div class="col-sm-5">
		{!! Form::select('paper_id', array('' => Lang::get('messages.papers')), null, array('class' => 'form-control')) !!}
	</div>
</div>
<div class="form-group">
	<label for="colors" class="col-sm-2 control-label">{{ Lang::get('messages.colors') }}</label>
	<div class="col-sm-5">
		{!! Form::select('colors', array('' => Lang::get('messages.color_count')), null, array('class' => 'form-control')) !!}
	</div>
</div>
<div class="form-group">
	<label for="paper_size_w" class="col-sm-2 control-label">{{ Lang::get('messages.paper_size_w') }}</label>
	<div class="col-sm-2">
		{!! Form::text('paper_size_w', null, array('class' => 'form-control', 'placeholder' => 'мм')) !!}
	</div>
</div>
<div class="form-group">
	<label for="paper_size_h" class="col-sm-2 control-label">{{ Lang::get('messages.paper_size_h') }}</label>
	<div class="col-sm-2">
		{!! Form::text('paper_size_h', null, array('class' => 'form-control', 'placeholder' => 'мм')) !!}
	</div>
</div>
<div class="form-group">
	<label for="copies" class="col-sm-2 control-label">Число копий</label>
	<div class="col-sm-2">
		{!! Form::text('copies', 1, array('class' => 'form-control', 'placeholder' => 'шт.')) !!}
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