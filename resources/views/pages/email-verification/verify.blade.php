@extends('layouts.admin')

@section('title', 'Verification Email')
@section('profile', 'active')

@section('content')
    <div class="col-12 col-xl-9">
        <div class="nav">
            <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
                <div class="d-flex justify-content-start align-items-center">
                    <button id="toggle-navbar" onclick="toggleNavbar()">
                        <img src="{{ url('template/assets/img/global/burger.svg') }}" class="mb-2" alt="" />
                    </button>
                    <h2 class="nav-title">Profile</h2>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-12">
                    <h2 class="content-title">Verification Email</h2>
                    <h5 class="content-desc mb-4">Please confirm your email first.</h5>
                </div>

                <div class="col-12">
                    @include('pages.partials.message')
                </div>

                <div class="col-12">
                    <div class="statistics-card">
                        <p>
                            If you don't get a message to verify your email, you can resend it. 
                        </p>
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf

                            <button class="btn btn-sm btn-primary">Resend Email Verification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection