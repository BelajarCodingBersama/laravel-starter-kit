@extends('layouts.admin')

@section('title', 'Profile')
@section('profile', 'active')

@section('content')
    <div class="col-12 col-xl-9">
        <x-navbar name="Profile" route="account.profile" />

        <div class="content">
            <div class="row">
                <div class="col-12">
                    <h2 class="content-title">Profile Account</h2>
                    <h5 class="content-desc mb-4">Update your profile account</h5>
                </div>

                <div class="col-12">
                    @include('pages.partials.message')
                </div>

                <div class="col-12 statistics-card">
                    <form action="{{ route('account.update-profile') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <x-forms.input 
                                    name="name" 
                                    label="Name" 
                                    :message={{ $message }} 
                                    required=true
                                    :value="$profile->name" 
                                />
                            </div>
                            <div class="col-12 col-md-6">
                                <x-forms.input 
                                    name="username" 
                                    label="Username" 
                                    :message={{ $message }} 
                                    required=true
                                    :value="$profile->username" 
                                />
                            </div>
                        </div>

                        <x-forms.button type="submit" class-type="success" />
                    </form>
                </div>

                <div class="col-12 mt-3">
                    <h2 class="content-title">Password</h2>
                    <h5 class="content-desc mb-4">Change your password</h5>
                </div>

                <div class="col-12 statistics-card">
                    <form action="{{ route('account.change-password') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <x-forms.input 
                                    name="old_password" 
                                    label="Current Password" 
                                    :message={{ $message }} 
                                    type="password"
                                    required=true 
                                />
                            </div>
                            <div class="col-12 col-md-6">
                                <x-forms.input 
                                    name="new_password" 
                                    label="New Password" 
                                    :message={{ $message }} 
                                    type="password"
                                    required=true 
                                />
                            </div>
                        </div>

                        <x-forms.button type="submit" class-type="success" text="Change password" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection