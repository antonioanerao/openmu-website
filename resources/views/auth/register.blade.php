@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="LoginName" class="col-md-4 col-form-label text-md-end">Login Name</label>

                            <div class="col-md-6">
                                <input id="LoginName" type="text" class="form-control @error('LoginName') is-invalid @enderror" name="LoginName" value="{{ old('LoginName') }}" required autocomplete="LoginName" autofocus>

                                @error('LoginName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="EMail" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="EMail" type="email" class="form-control @error('EMail') is-invalid @enderror" name="EMail" value="{{ old('EMail') }}" required autocomplete="EMail">
                                @error('EMail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="SecurityCode" class="col-md-4 col-form-label text-md-end">{{ __('Security Code') }}</label>

                            <div class="col-md-6">
                                <input id="SecurityCode" type="password" class="form-control @error('SecurityCode') is-invalid @enderror" name="SecurityCode" value="{{ old('SecurityCode') }}" required autocomplete="SecurityCode">
                                @error('SecurityCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="PasswordHash" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="PasswordHash" type="password" class="form-control @error('PasswordHash') is-invalid @enderror" name="PasswordHash" required autocomplete="new-PasswordHash">
                                @error('PasswordHash')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="PasswordHash-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="PasswordHash-confirm" type="password" class="form-control" name="PasswordHash_confirmation" required autocomplete="new-PasswordHash">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
