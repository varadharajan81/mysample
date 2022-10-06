@php
	$arr = explode('/', Request::route()->uri);
@endphp

<div class="card-header">
	<div class="d-flex align-items-center">
		<h4 class="card-title">Add {{ Str::studly(Str::singular(ucfirst($arr[0]))) }}</h4>
	</div>
</div>
