@extends('layouts.auth')

@section('title', 'Forgot Password')

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
                        <h1>Forgot password</h1>
                        <p class="mb-5">No worries, we'll send you reset instructions.</p>

                        @include('pages.partials.message')

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf

                            <x-forms.input 
                                type="email"
                                name="email"
                                label="Email"
                                :message={{ $message }}
                                required=true
                            />

                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">Send</button>
                            </div>
                        </form>
                        
                        <div class="mt-4 text-center">
                            <a href="{{ route('auth.login-page') }}" class="fw-lighter">Back to log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection