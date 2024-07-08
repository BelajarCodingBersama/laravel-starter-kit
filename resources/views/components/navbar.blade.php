<div class="nav">
    <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
        <div class="d-flex justify-content-start align-items-center">
            <button id="toggle-navbar" onclick="toggleNavbar()">
                <img src="{{ url('template/assets/img/global/burger.svg') }}" class="mb-2" alt="" />
            </button>
            <h2 class="nav-title">
                <a href="{{ route($route) }}">{{ $name }}</a>
            </h2>
        </div>
    </div>
</div>