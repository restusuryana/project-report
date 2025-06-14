<ul class="metismenu" id="menu">
    <li class="menu-label">DASHBOARD</li>
    <li>
        <a href="/dashboard">
            <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
            <div class="menu-title">DASHBOARD</div>
        </a>
    </li>
    @if (auth()->user()->role == 'admin')
    <li class="menu-label">DATA</li>
    <li>
        <a href="/users">
            <div class="parent-icon"><i class='bx bx-user'></i></div>
            <div class="menu-title">DATA USER</div>
        </a>
    </li>
    @endif
</ul>
