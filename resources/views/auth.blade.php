@if (!empty($user))
    	<p>Добро пожаловать,
    	<img src="{{ $user['photo'] }}" alt="{{ $user['name'] }}" class="img-circle" width="30px" height="30px">
    	{{{ $user['name'] }}}
    	<span> | </span>
    	<a href="/logout">Logout</a>
    	</p>
@else
	<p>Войти с помощью 
		<a href="/login/google">Google</a> или Facebook
	</p>
@endif