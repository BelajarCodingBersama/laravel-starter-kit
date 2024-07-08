<a href="{{ route($route) }}" class="sidebar-item @yield($className)">
    <img src="{{ url($icon) }}" width="18" height="18" alt="icon" class="me-3" />
    <span>{{ $name }}</span>
</a>