@extends('layouts.admin')

@section('title', 'Role Add Permissions')
@section('role', 'active')

@section('content')
    <div class="col-12 col-xl-9">
        <x-navbar name="Role" route="roles.index" />

        <div class="content">
            <div class="row">
                <div class="col-12">
                    <h2 class="content-title mb-4">Add Permissions</h2>
                </div>
                
                <div class="col-12">
                    @include('pages.partials.message')
                </div>

                <div class="col-12 statistics-card">
                    <form action="{{ route('roles.add-permissions', $role) }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="mb-2">
                                Role Name
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ old('name', $role->name) }}"
                                disabled
                            />

                            @error('name')
                                <p class="text-danger text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="permissions" class="mb-2">
                                Permissions
                            </label>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="form-check mb-2">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value="{{ $permission->id }}"
                                                id="permission{{ $permission->id }}"
                                                name="permission_IDs[]"
                                                @if (in_array($permission->id, $roleHasPermissions))
                                                    checked
                                                @endif
                                            />
                                            <label class="form-check-label" for="permission{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection