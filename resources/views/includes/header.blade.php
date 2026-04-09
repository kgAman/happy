<div class="header">
    <h1>@yield('title')</h1>
    <div class="header-actions">
        <div class="notification-icon">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">0</span>
        </div>
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight: 600;">{{ Auth::user()->name }}</div>
                <div style="font-size: 14px; color: #7f8c8d;">{{ Auth::user()->last_login_at ? Auth::user()->last_login_at->format('d M Y, h:i A') : 'First Login' }}</div>
            </div>
        </div>
        <!-- 🚪 Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="ms-3">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm rounded-pill d-flex align-items-center gap-1">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
    </div>
</div>
