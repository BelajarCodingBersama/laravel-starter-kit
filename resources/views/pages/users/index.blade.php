@extends('layouts.admin')

@section('title', 'User')
@section('user', 'active')

@section('content')
    <div class="col-12 col-xl-9">
        <x-navbar name="User" route="users.index" />

        <div class="content">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <h2 class="content-title mb-4">List Users</h2>
                    <div class="btn mb-2 mb-md-0">
                        {{-- <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary"> Add new user </a> --}}
                    </div>
                </div>

                <div class="col-12 search-menu mb-4">
                    <form action="" method="GET">
                        <div class="row d-flex">
                            <div class="col-12 col-md-3 d-flex">
                                <input
                                    type="text"
                                    class="form-control border-0 shadow-sm"
                                    name="name"
                                    value="{{ request('name') }}"
                                    placeholder="Search name"
                                />
                            </div>
                            <div class="col-12 col-md-2 d-grid d-md-flex mt-3 mt-md-0">
                                <button class="btn btn-sm btn-warning">
                                    <img src="{{ url('template/assets/img/global/search.svg') }}" alt="icon" />
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12">
                    @include('pages.partials.message')
                </div>

                <div class="col-12">
                    <div class="statistics-card">
                        <x-table 
                            :headers="['Name','Username','Email']"
                            :items="$users"
                            :cells="['name','username','email']"
                            collspan="3"
                            {{-- :actions="['User Add Roles']"
                            routeUserAddRoles="users.add-roles-page" --}}
                            pagination=true
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