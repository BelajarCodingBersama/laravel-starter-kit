@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="content p-0">
        <div class="row align-items-center m-0">
            <div class="col-6 d-none d-lg-flex justify-content-center vh-100 p-0">
                <img 
                    src="{{ asset('template/assets/img/ui-2.png') }}" 
                    class="img-fluid" 
                    alt="image"
                    style="object-fit: cover;"
                >
            </div>
            <div class="col-12 col-lg-6 d-flex vh-100 px-3 px-md-5 ">
                <div class="card align-self-center border-light vw-100">
                    <div class="card-body p-3 p-md-5">
                        <h1 class="mb-5">Welcome back!</h1>

                        @include('pages.partials.message')

                        <form action="{{ route('auth.login') }}" method="POST">
                            @csrf

                            <x-forms.input 
                                name="username_or_email"
                                label="Username or Email"
                                :message={{ $message }}
                                required=true
                            />

                            <x-forms.input 
                                type="password"
                                name="password"
                                label="Password"
                                :message={{ $message }}
                                required=true
                            />

                            <div class="mb-1">
                                {{-- <a href="{{ route('password.request') }}" class="text-danger">Forgot Password ?</a> --}}
                            </div>

                            <div class="mb-3">
                                Not a member ? <a href="{{ route('auth.register-page') }}" class="text-primary">Register now</a>
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection