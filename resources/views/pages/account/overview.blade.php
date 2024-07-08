@extends('layouts.admin')

@section('title', 'Overview')
@section('overview', 'active')

@section('content')
    <div class="col-12 col-xl-9">
        <x-navbar name="Overview" route="account.overview" />

        <div class="content">
            <div class="row">
                <div class="col-12">
                    <h2 class="content-title">Welcome, {{ $userName }}</h2>
                    <h5 class="content-desc mb-4">Your dashboard in here.</h5>
                </div>
            </div>
        </div>
    </div>
@endsection