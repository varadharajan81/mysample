@extends('layouts.default')

@extends('themes.title')

@section('content')

<div class="page-inner">

	@include('errors.success')

	@include('themes.innerheader')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

				@include('themes.createheader')

				<form enctype="multipart/form-data" id="form_validation" novalidate="novalidate" role="form" method="post" action="{{ action('UserController@bank') }}">
					@csrf
	                <div class="card-body">
						<div class="row">
							<div class="col-md-6 col-lg-8">

								<input class="form-control" id="user_type_id" name="user_type_id" minlength="3" aria-required="true" type="hidden" value="1" />
			  					<div class="form-group">
									<label for="name">Name</label>
									<input class="form-control" id="name" name="name" minlength="3" aria-required="true" type="text" value="{{ old('name') }}" />
			                        @if($errors->has('name'))
			                          <small id="name-error" class="form-text text-danger text-muted">{{ $errors->first('name') }}</small>
									@else
									  <small class="form-text text-muted">{{ __('Enter user name') }}</small>
			                        @endif
			                    </div>

			  					<div class="form-group">
									<label for="mobile">Mobile</label>
									<input class="form-control" id="mobile" name="mobile" minlength="3" aria-required="true" type="text" value="{{ old('mobile') }}" />
			                        @if($errors->has('mobile'))
			                          <small id="mobile-error" class="form-text text-danger text-muted">{{ $errors->first('mobile') }}</small>
									@else
									  <small class="form-text text-muted">{{ __('Enter user mobile') }}</small>
			                        @endif
			                    </div>

			  					<div class="form-group">
									<label for="password">Password</label>
									<input class="form-control" id="password" name="password" minlength="3" aria-required="true" type="text" value="{{ old('password') }}" />
			                        @if($errors->has('password'))
			                          <small id="password-error" class="form-text text-danger text-muted">{{ $errors->first('password') }}</small>
									@else
									  <small class="form-text text-muted">{{ __('Enter user password') }}</small>
			                        @endif
			                    </div>

								<div class="form-check">
				                    <label for="status" class="form-check-label">
										<input name="status" id="status" class="form-check-input" {{ (old('status') == 'on') ? 'checked="checked"' : '' }} type="checkbox" />
				                        <span class="form-check-sign">Active</span>
				                    </label>
				                </div>

							</div>
						</div>
	                </div>
					<div class="card-action">
						<button type="submit" class="btn btn-success">Submit</button>
						<a href="{{ url('users') }}" class="btn btn-danger">Cancel</a>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>

@endsection
