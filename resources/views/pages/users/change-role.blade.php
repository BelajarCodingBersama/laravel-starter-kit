@extends('layouts.admin')

@section('title', 'User Add Roles')
@section('user', 'active')

@section('content')
    <div class="col-12 col-xl-9">
        <x-navbar name="User" route="users.index" />

        <div class="content">
            <div class="row">
                <div class="col-12">
                    <h2 class="content-title mb-4">Add Roles</h2>
                </div>
                
                <div class="col-12">
                    @include('pages.partials.message')
                </div>

                <div class="col-12 statistics-card">
                    <form action="{{ route('users.add-roles', $user) }}" method="POST">
                        @csrf

                        <x-forms.input 
                            name="name"
                            label="User Name"
                            :message={{ $message }}
                            disabled=true
                            :value="$user->name"
                        />

                        <div class="form-group mb-3">
                            <label for="roles" class="mb-2">
                                Roles
                            </label>
                            <div class="row">
                                @foreach ($roles as $role)
                                    <div class="col-md-4">
                                        <div class="form-check mb-2">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value="{{ $role->id }}"
                                                id="role{{ $role->id }}"
                                                name="role_IDs[]"
                                                @if (in_array($role->name, $userHasRoles))
                                                    checked
                                                @endif
                                            />
                                            <label class="form-check-label" for="role{{ $role->id }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <x-forms.button type="submit" class-type="success" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection