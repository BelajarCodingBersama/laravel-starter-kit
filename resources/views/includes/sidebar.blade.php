<div class="col-12 col-lg-3 col-navbar d-none d-xl-block">
    <aside class="sidebar">
        <a href="#" class="sidebar-logo">
            <div class="d-flex justify-content-start align-items-center">
                <img src="{{ url('template/assets/img/global/logo.svg') }}" alt="" />
                <span>PondLink</span>
            </div>

            <button id="toggle-navbar" onclick="toggleNavbar()">
                <img src="{{ url('template/assets/img/global/navbar-times.svg') }}" alt="" />
            </button>
        </a>

        <x-sidebar-title title="Daily Use" />

        <x-sidebar-item 
            name="Overview" 
            className="overview" 
            route="auth.overview" 
            icon="template/assets/img/global/grid.svg" 
        />

        {{-- <x-sidebar-item 
            name="Account" 
            className="account" 
            route="auth.account" 
            icon="template/assets/img/global/settings.svg" 
        /> --}}

        {{-- @role('Developer')
            <x-sidebar-title title="Developer" />

            <x-sidebar-item 
                name="Role" 
                className="role" 
                route="roles.index" 
                icon="template/assets/img/global/shield-lock-fill.svg" 
            />

            <x-sidebar-item 
                name="Permission" 
                className="permission" 
                route="permissions.index" 
                icon="template/assets/img/global/key.svg" 
            />
        @endrole

        @role('Admin')
            <x-sidebar-title title="Admin" />

            <x-sidebar-item 
                name="Priority Type" 
                className="priorityType" 
                route="priority-types.index" 
                icon="template/assets/img/global/list-task.svg" 
            />

            <x-sidebar-item 
                name="Wishlist Type" 
                className="wishlistType" 
                route="wishlist-types.index" 
                icon="template/assets/img/global/card-list.svg" 
            />
        @endrole

        @role('Member')
            <x-sidebar-title title="Member" />

            <x-sidebar-item 
                name="Funding Source" 
                className="fundingSource" 
                route="funding-sources.index" 
                icon="template/assets/img/global/credit-card.svg" 
            />

            <x-sidebar-item 
                name="Financial Transaction" 
                className="financialTransaction" 
                route="financial-transactions.index" 
                icon="template/assets/img/global/clipboard2-data.svg" 
            />

            <x-sidebar-item 
                name="Wishlist" 
                className="wishlist" 
                route="wishlists.index" 
                icon="template/assets/img/global/suit-heart-fill.svg" 
            />

            <x-sidebar-item 
                name="Service Histories" 
                className="serviceHistory" 
                route="service-histories.index" 
                icon="template/assets/img/global/calendar3.svg" 
            />

            <x-sidebar-item 
                name="Service Schedule" 
                className="serviceSchedule" 
                route="recommended-service-schedules.index" 
                icon="template/assets/img/global/bicycle.svg" 
            />

            <x-sidebar-item 
                name="Task" 
                className="task" 
                route="to-do-lists.index" 
                icon="template/assets/img/global/file-text.svg" 
            />

            <x-sidebar-item 
                name="Daily Activity" 
                className="dailyActivity" 
                route="daily-activity-logs.index" 
                icon="template/assets/img/global/clock.svg" 
            />
        @endrole

        <x-sidebar-title title="Others" />

        @hasanyrole('Developer|Admin')
            <x-sidebar-item 
                name="User" 
                className="user" 
                route="users.index" 
                icon="template/assets/img/global/users.svg" 
            />
        @endhasanyrole --}}

        <a href="#" class="sidebar-item" onclick="return confirm('Are you sure to logout?')">
            <img src="{{ url('template/assets/img/global/log-out.svg') }}" width="18" height="18" alt="icon" class="me-3" />
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf

                <button type="submit" class="p-0 btn btn-sm btn-link hover-off">Logout</button>
            </form>
        </a>
    </aside>
</div>