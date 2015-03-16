@extends('app')

@section('title')
Добро пожаловать!
@stop

@section('content')
<h2>Online poster print</h2>

<label for="url">Укажи ссылку на макет для печти:</label>
<div class="input-group input-group-lg">
	<span class="input-group-addon" id="sizing-addon1">URL</span>
	<input type="text" class="form-control" id="maket_url" placeholder="Ссылка на макет (ala Dropbox, etc)">
</div>
<br/>
<div class="row">
<script type="text/javascript">
$(document).ready(function(){
	function isUrl(s) {
    	var regexp = /[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])+(.[a-z])?/
    	if (regexp.test(s)) {
    		if(s.substr(0,7) != 'http://'){
 			   s = 'http://' + s;
			}
		return s;			
    	}
    	return false;
	}
	$("input#maket_url").change(function() {
		if(url = isUrl($(this).val())) {
			$(this).css({'border-color':'#d6e9c6', 'background-color':'#dff0d8'});
			$(this).val(url);
		}
		else{
			$(this).css({'border-color':'#ebccd1', 'background-color':'#f2dede'});
		}
	});
    $(".btn").click(function(){
    	
    	//alert(lkurl);
        //$("#loginModal").modal('show');
    });
    $("#google_login").click(function(){
    	var url = $("input#maket_url").val();
    	var lk = $(this).attr("href");
    	if(url) {
	    	lkurl = lk + '/?url=' + url;
	    	$(this).attr("href", lkurl);
    	}
    });

});
</script>
	<div class="col-md-2 col-md-offset-5">
		<button type="button" class="btn btn-primary btn-lg btn-block"data-toggle="modal" data-target=".bs-example-modal-sm">Start printing</button>
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h2>Представьтесь пожалуйста!</h2>
					</div>
					<div class="text-center modal-body">
						<p>Сделать это можно с помощью:</p>
						<script src="https://apis.google.com/js/client:platform.js" async defer></script>
						<a class="login" id="google_login" href="/login/google">
							<img src="https://developers.google.com/accounts/images/sign-in-with-google.png" width="200"/>
						</a>
						<p>или</p>
						<p>Facebook</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@stop