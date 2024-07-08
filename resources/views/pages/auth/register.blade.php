@extends('layouts.auth')

@section('title', 'Register')

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
                        <h1 class="mb-5">Welcome to Starter Kit</h1>

                        @include('pages.partials.message')

                        <form action="{{ route('auth.register') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <x-forms.input 
                                        name="name"
                                        label="Name"
                                        :message={{ $message }}
                                        required=true
                                    />
                                </div>

                                <div class="col-12 col-md-6">
                                    <x-forms.input 
                                        name="username"
                                        label="Username"
                                        :message={{ $message }}
                                        required=true
                                    />
                                </div>
                            </div>


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

                            <div class="mb-3">
                                Already have an account ? <a href="{{ route('auth.login-page') }}" class="text-primary">Sign in</a>
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">Create account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection