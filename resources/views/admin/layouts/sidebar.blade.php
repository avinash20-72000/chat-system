<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link text-center">
        {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">Chat - System</span>
    </a>
    <div class="sidebar">
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view',new App\Models\User())
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="nav-link {{ str_contains(request()->path(), 'user') ? 'active' : '' }} )">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </li>
                        @endcan
                        @can('view',new App\Models\Role())
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}"
                                    class="nav-link {{ str_contains(request()->path(), 'role') ? 'active' : '' }} )">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Role</p>
                                </a>
                            </li>
                        @endcan
                        @can('view',new App\Models\Permission())
                            <li class="nav-item">
                                <a href="{{ route('permission.index') }}"
                                    class="nav-link {{ str_contains(request()->path(), 'permission') ? 'active' : '' }} )">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permission</p>
                                </a>
                            </li>
                        @endcan
                        @can('view',new App\Models\Module())
                        <li class="nav-item">
                            <a href="{{ route('module.index') }}"
                                class="nav-link {{ str_contains(request()->path(), 'module') ? 'active' : '' }} )">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Module</p>
                            </a>
                        </li>
                        @endcan
                        @can('assignRole',new App\Models\User())
                            <li class="nav-item">
                                <a href="{{ route('roleAssign') }}"
                                    class="nav-link {{ request()->is('assign') ? 'active' : ''}} )">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Assign Role</p>
                                </a>
                            </li>
                        @endcan
                        @can('restore',new App\Models\User())
                            <li class="nav-item">
                                <a href="{{ route('trashList') }}"
                                    class="nav-link {{ str_contains(request()->path(), 'trash') ? 'active' : '' }} )">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Trash User</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('logView',new App\Models\User())
                    <li class="nav-item">
                        <a href="{{ route('laravelLogs') }}"
                            class="nav-link {{ request()->is('logs') ? 'active' : ''}}  )">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laravel Logs</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="nav-link text-white btn btn-primary">
                            <i class="fa fa-power-off "></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>

        </nav>
    </div>
</aside>
