<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    @foreach ($cells as $cell)
                        @if (in_array($cell, ['description','parts_replaced','additional_notes']))
                            <td>{!! $item->$cell !!}</td>
                        @else
                            <td>{{ $item->$cell }}</td>
                        @endif
                    @endforeach
                    <td width="10%">
                        <div class="dropdown">
                            <button
                                class="btn btn-outline-primary dropdown-toggle"
                                type="button"
                                id="dropdownMenu"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            ></button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                @if (in_array('Edit', $actions))
                                    <li>
                                        <a
                                            href="{{ route($routeEdit, $item) }}"
                                            class="btn btn-sm btn-link w-100 text-start"
                                            >Edit</a
                                        >
                                    </li>
                                @endif
                                @if (in_array('Delete', $actions))
                                    <li>
                                        <form action="{{ route($routeDelete, $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Are you sure to delete?')"
                                                type="submit"
                                                class="btn btn-sm btn-link w-100 text-start"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </li>
                                @endif
                                @if (in_array('User Add Roles', $actions))
                                    <li>
                                        <a
                                            href="{{ route($routeUserAddRoles, $item) }}"
                                            class="btn btn-sm btn-link w-100 text-start"
                                            >User Add Roles</a
                                        >
                                    </li>
                                @endif
                                @if (in_array('Add Permissions', $actions))
                                    <li>
                                        <a
                                            href="{{ route($routeAddPermissions, $item) }}"
                                            class="btn btn-sm btn-link w-100 text-start"
                                            >Add Permissions</a
                                        >
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $collspan }}" class="text-center">No Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if ($pagination)
        <div class="d-flex mt-4 justify-content-end">
            {{ $items->links() }}
        </div>
    @endif
</div>