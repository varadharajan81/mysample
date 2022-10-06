@php
	$arr = explode('/', Request::route()->uri);
@endphp

@section('title', Str::studly(Str::plural(ucfirst($arr[0]))))
