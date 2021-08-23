
@extends('layouts.login')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-8 col-10">
            <div class="card-group">
                <div class="card p-2">
                    <div class="card-body pt-3">
                        <form action="{{ route('login') }}" method="POST">
                            <h1 class="text-center mb-3">{{ __('Kirish oynasi') }}</h1>
                            @error('username')
                                <p class="p-0 mt-1 mb-1 text-center text-danger text-bold">{{'Login yoki parolda xatolik bor'}}</p>
                            @enderror
                            @csrf

                            <div role="group" class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg class="c-icon">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-user') }}"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Login">
{{--                                    @error('username')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
                                </div>

                            </div>

                            <div role="group" class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg class="c-icon">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-lock-locked') }}"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control @error('username') is-invalid @enderror" name="password" placeholder="Parol">

{{--                                    @error('password')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-right col-12">
                                    <button type="submit" class="btn px-4 btn-block btn-primary">{{ __('Kirish') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
