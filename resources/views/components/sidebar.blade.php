<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item {{ request()->routeIs('journals.*') ? 'active' : '' }}"> <a class="sidebar-link sidebar-link" href="/dashboard" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Masters</span></li>
                <li class="sidebar-item {{ request()->routeIs('journals.*') ? 'active' : '' }}"> <a class="sidebar-link" href="{{ route('admin.journals.index') }}" aria-expanded="false"><i data-feather="book" class="feather-icon"></i><span class="hide-menu">Jurnal</span></a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('journals.*') ? 'active' : '' }}"> <a class="sidebar-link" href="/" aria-expanded="false"><i data-feather="archive" class="feather-icon"></i><span class="hide-menu">Penerbit</span></a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Letter of Acceptance</span></li>
                <li class="sidebar-item {{ request()->routeIs('loarequests.index') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.loarequests.index') }}" aria-expanded="false">
                        <i data-feather="file-minus" class="feather-icon"></i>
                        <span class="hide-menu">Permintaan LOA</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.loas.index') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.loas.index') }}" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu">Data LOA</span>
                    </a>
                </li>

                <li class="list-divider"></li>
                {{-- <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/logout" aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span class="hide-menu">Logout</span></a></li></li> --}}

                <!-- <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-expanded="false">
                        <i data-feather="log-out" class="feather-icon"></i>
                        <span class="hide-menu">Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li> -->
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i data-feather="log-out" class="feather-icon"></i>
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>