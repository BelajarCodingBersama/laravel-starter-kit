@extends('layouts.admin')

@section('title', 'Create Permission')
@section('permission', 'active')

@section('content')
    <div class="col-12 col-xl-9">
        <x-navbar name="Permission" route="permissions.index" />

        <div class="content">
            <div class="row">
                <div class="col-12">
                    <h2 class="content-title mb-4">Create New Permission</h2>
                </div>

                <div class="col-12 statistics-card">
                    <form action="{{ route('permissions.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="mb-2">
                                Name
                                <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control @error('name')
                                    is-invalid
                                @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                            />

                            @error('name')
                                <p class="text-danger text-sm mt-1">{{ $message }}</p>
                            @enderror
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