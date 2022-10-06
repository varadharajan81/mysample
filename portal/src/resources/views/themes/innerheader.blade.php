@php
$arr = explode('/', Request::route()->uri)
@endphp
<div class="page-header">
	@if (is_array($arr))
		<h4 class="page-title">{{ Str::studly(Str::plural(ucfirst($arr[0]))) }}</h4>
	@endif
	<ul class="breadcrumbs">
		<li class="nav-home">
			<i class="flaticon-home"></i>
		</li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li class="nav-item">
			{{ Str::studly(Str::singular(ucfirst($arr[0]))) }}
		</li>
		@if(isset($arr[2]))
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li class="nav-item">
			{{ Str::studly(Str::singular(ucfirst($arr[2]))) }}
		</li>
		@elseif(isset($arr[1]))
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li class="nav-item">
			{{ Str::studly(Str::singular(ucfirst($arr[1]))) }}
		</li>
		@endif

	</ul>
</div>
