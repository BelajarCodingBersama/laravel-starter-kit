@extends('layouts.admin')

@section('title', 'Role')
@section('role', 'active')

@section('content')
    <div class="col-12 col-xl-9">
        <x-navbar name="Role" route="roles.index" />

        <div class="content">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <h2 class="content-title mb-4">List Roles</h2>
                    <div class="btn mb-2 mb-md-0">
                        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary"> Add new role </a>
                    </div>
                </div>

                <div class="col-12">
                    @include('pages.partials.message')
                </div>

                <div class="col-12">
                    <div class="statistics-card">
                        <x-table 
                            :headers="['Name','Permission Names']"
                            :items="$roles"
                            :cells="['name','permission_names']"
                            collspan="3"
                            :actions="['Delete','Add Permissions']"
                            routeDelete="roles.delete"
                            routeAddPermissions="roles.add-permissions-page"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('before-script')
    <script src="{{ url('template/libraries/popper/popper.min.js') }}"></script>
@endpush