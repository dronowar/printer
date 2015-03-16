<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8" />
  	<link type="text/css" rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}"/>
  	<link type="text/css" rel="stylesheet" href="{{ asset("css/bootstrap-theme.min.css") }}"/>
  	<script src="{{ asset("js/jquery-2.1.3.min.js") }}"/></script>
  	<script src="{{ asset("js/bootstrap.min.js") }}"/></script>
    <title>Online poster</title>
  </head>
  <body>
  <div class="container text-right">
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
  </div>
  	<div class="container">
    	@yield('content')
    </div>
    <br/>
    <footer class="footer">
    	<div class="container">
    		<p class="text-muted text-center">&copy; 2015</p>
    	</div>
    </footer>
  </body>
</html>