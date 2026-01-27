<ul class="metismenu" id="menu">

    {{-- DASHBOARD --}}
    <li class="menu-label">MAIN</li>
    <li class="{{ request()->is('dashboard') ? 'mm-active' : '' }}">
        <a href="/dashboard">
            <div class="parent-icon">
                <i class='bx bx-home-circle'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

    {{-- Kelola Akun Pribadi--}}
    <li class="menu-label">MANAGEMENT</li>
    <li class="{{ request()->is('profile') ? 'mm-active' : '' }}">
        <a href="/profile">
            <div class="parent-icon">
                <i class='bx bx-cog'></i>
            </div>
            <div class="menu-title">Profile Saya</div>
        </a>
    </li>

    {{-- ADMIN ONLY --}}
    @if(auth()->user()->role === 'admin')

        <li class="{{ request()->is('users*') ? 'mm-active' : '' }}">
            <a href="/users">
                <div class="parent-icon">
                    <i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Data User</div>
            </a>
        </li>
    @endif



</ul>
