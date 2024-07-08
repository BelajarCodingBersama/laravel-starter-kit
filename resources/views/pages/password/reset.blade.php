@extends('layouts.auth')

@section('title', 'Reset Password')

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
                        <h1>Set your new password</h1>
                        <p class="mb-5">Your new password should be different from passwords previously used.</p>
                        
                        @include('pages.partials.message')

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf

                            <x-forms.input 
                                type="email"
                                name="email"
                                label="Email"
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

                            <x-forms.input 
                                type="password"
                                name="password_confirmation"
                                label="Password Confirmation"
                                :message={{ $message }}
                                required=true
                            />

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">Reset password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection