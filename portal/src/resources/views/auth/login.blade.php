@extends('layouts.app')

@section('title', ucfirst(Request::route()->uri))

@section('content')

<div class="page-inner">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-md-8 col-lg-10">
              <div class="card-body">
                <div class="form-group row justify-content-center">
                  <img src="../assets/img/logo_full.png" width="50%" />
                </div>
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-alt"></i></span>
                      </div>
                      <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Username" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                    <small id="emailHelp2" class="form-text text-muted text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                      </div>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
