@php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
@endphp


<div class="navbar-collapse collapse" id="navbarSupportedContent">
    <!-- toggle and nav items -->

    <ul class="navbar-nav float-left me-auto ms-3 ps-1">
        <!-- Notification -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)" id="bell" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span><i data-feather="bell" class="svg-icon"></i></span>
                <span class="badge text-bg-primary notify-no rounded-circle">5</span>
            </a>

            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                <ul class="list-style-none">
                    <li>
                        <div class="message-center notifications position-relative">
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                <div class="btn btn-danger rounded-circle btn-circle"><i data-feather="airplay" class="text-white"></i></div>
                                <div class="w-75 d-inline-block v-middle ps-2">
                                    <h6 class="message-title mb-0 mt-1">Luanch Admin</h6>
                                    <span class="font-12 text-nowrap d-block text-muted">Just see the my new admin!</span>
                                    <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
                                </div>
                            </a>

                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                <span class="btn btn-success text-white rounded-circle btn-circle"><i data-feather="calendar" class="text-white"></i></span>
                                <div class="w-75 d-inline-block v-middle ps-2">
                                    <h6 class="message-title mb-0 mt-1">Event today</h6>
                                    <span class="font-12 text-nowrap d-block text-muted text-truncate">Just a reminder that you have event</span>
                                    <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span>
                                </div>
                            </a>

                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                <span class="btn btn-info rounded-circle btn-circle"><i data-feather="settings" class="text-white"></i></span>
                                <div class="w-75 d-inline-block v-middle ps-2">
                                    <h6 class="message-title mb-0 mt-1">Settings</h6>
                                    <span class="font-12 text-nowrap d-block text-muted text-truncate">You can customize this template as you want</span>
                                    <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span>
                                </div>
                            </a>

                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                <span class="btn btn-primary rounded-circle btn-circle"><i data-feather="box" class="text-white"></i></span>
                                <div class="w-75 d-inline-block v-middle ps-2">
                                    <h6 class="message-title mb-0 mt-1">Pavan kumar</h6> <span class="font-12 text-nowrap d-block text-muted">Just see the my admin!</span>
                                    <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span>
                                </div>
                            </a>
                        </div>
                    </li>

                    <li>
                        <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
                            <strong>Check all notifications</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End Notification -->
    </ul>

    <!-- Right side toggle and nav items -->
    <ul class="navbar-nav float-end">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @auth
                <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" width="40" class="rounded-circle">
                @endauth
                <span class="ms-2 d-none d-lg-inline-block"><span
                        class="text-dark">{{ $user->name ?? 'User' }}</span> <i data-feather="chevron-down"
                        class="svg-icon"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-right user-dd animated flipInY">
                <a class="dropdown-item" href="{{ route('profile.edit', ['name' => $user->name]) }}"><i data-feather="settings" class="svg-icon me-2 ms-1"></i> Account Setting</a>

                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i data-feather="power" class="svg-icon me-2 ms-1"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-logout-trigger]').forEach(function(el) {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('logout-form').submit();
            });
        });
    });
</script>
