<div class="navbar px-6 bg-base-100 shadow-lg">
    <div class="navbar-start">
        <a class="btn btn-ghost normal-case text-xl">Task Application</a>
    </div>
    <div class="navbar-center hidden lg:flex">
        @auth
            <ul class="menu menu-horizontal px-6 space-x-5">
                <li>
                    <a href="/beranda" class="{{ $title == 'Dashboard' ? 'bg-slate-200' : '' }}">Dahsboard</a>
                </li>
                @if (auth()->user()->hak_akses == 'admin')
                    <li>
                        <a href="/user" class="{{ $title == 'User' ? 'bg-slate-200' : '' }}">User</a>
                    </li>
                    <li>
                        <a href="/category" class="{{ $title == 'Category' ? 'bg-slate-200' : '' }}">Category</a>
                    </li>
                @endif
                <div class="indicator">
                    @if (auth()->user()->hak_akses == 'Employee' && $countTask != 0)
                        <span class="indicator-item badge badge-primary">{{ $countTask }}</span>
                    @endif
                    <li>
                        <a href="/task" class="{{ $title == 'Task' ? 'bg-slate-200' : '' }}">Task</a>
                    </li>
                </div>
                <li>
                    <a href="/contact" class="{{ $title == 'Contact' ? 'bg-slate-200' : '' }}">Contact</a>
                </li>
            </ul>
        @endauth
    </div>
    <div class="navbar-end">
        @auth
            <div class="dropdown dropdown-end">
                <label tabindex="1" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src={{ asset('/storage/icons/person-circle.svg') }} />
                    </div>
                </label>
                <ul tabindex="1" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                    <li>
                        <a href="/changePassword">
                            Change Password
                        </a>
                    </li>
                    <li>
                        <button id="logout">
                            Logout
                        </button>
                    </li>
                </ul>
            </div>

            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                    <img src="{{ asset('storage/icons/list.svg') }}" alt="" srcset="">
                </label>
                <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                    <li>
                        <a href="/beranda" class="{{ $title == 'Dashboard' ? 'bg-slate-200' : '' }}">Dahsboard</a>
                    </li>
                    @if (auth()->user()->hak_akses == 'admin')
                        <li>
                            <a href="/user" class="{{ $title == 'User' ? 'bg-slate-200' : '' }}">User</a>
                        </li>
                        <li>
                            <a href="/category" class="{{ $title == 'Category' ? 'bg-slate-200' : '' }}">Category</a>
                        </li>
                    @endif
                    <div class="indicator w-full">
                        @if (auth()->user()->hak_akses == 'Employee' && $countTask != 0)
                            <span class="indicator-item badge badge-primary">{{ $countTask }}</span>
                        @endif
                        <li class="w-full">
                            <a href="/task" class="{{ $title == 'Task' ? 'bg-slate-200' : '' }}">Task</a>
                        </li>
                    </div>
                    <li>
                        <a href="/contact" class="{{ $title == 'Contact' ? 'bg-slate-200' : '' }}">Contact</a>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</div>

<script>
    $('#logout').click(function(e) {
        Swal.fire({
            title: 'PERINGATAN',
            text: 'APAKAH ANDA YAKIN INGIN LOGOUT?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Logout'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '/logout';
            }
        })
    });
</script>
