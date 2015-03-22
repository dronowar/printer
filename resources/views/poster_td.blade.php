<td class="col-md-6">
	<ul class="list-unstyled">
	<li><small>{{ Lang::get('messages.maket_url').': '.$poster['maket_url'] }}</small></li>
	<li><small>{{ Lang::get('messages.papers') }} : {{ Lang::get('messages.paper_id')[$poster['paper_id']] }}</small></li>
	<li><small>Размер макета:{{ $poster['w'].'x'.$poster['w'].' '.Lang::get('messages.paper_size_demension') }}, {{ Lang::get('messages.quantity').': '.$poster['quantity'] }}</small></li>
	</ul>
</td>