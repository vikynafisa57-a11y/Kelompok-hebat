<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SkillGap') · SkillGap</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div class="app-shell">
    @auth
    <aside class="sidebar" id="sidebar">
        <a class="brand" href="{{ route('dashboard') }}"><span class="brand-mark">S</span><span>Skill<span class="brand-light">Gap</span></span></a>
        <p class="nav-caption">MENU UTAMA</p>
        <nav class="nav-list">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><span>⌂</span> Dashboard</a>
            <a class="nav-link {{ request()->routeIs('careers.*') ? 'active' : '' }}" href="{{ route('careers.index') }}"><span>◎</span> Target Karier</a>
            <a class="nav-link {{ request()->routeIs('assessment.*') ? 'active' : '' }}" href="{{ route('assessment.index') }}"><span>✓</span> Assessment</a>
            <a class="nav-link {{ request()->routeIs('skill-gap') ? 'active' : '' }}" href="{{ route('skill-gap') }}"><span>⌁</span> Skill Gap</a>
            <a class="nav-link {{ request()->routeIs('roadmap.*') ? 'active' : '' }}" href="{{ route('roadmap.index') }}"><span>↗</span> Learning Roadmap</a>
            <a class="nav-link {{ request()->routeIs('progress.*') ? 'active' : '' }}" href="{{ route('progress.index') }}"><span>▥</span> Progress Saya</a>
        </nav>
        <div class="sidebar-bottom">
            <div class="help-card"><span class="help-icon">✦</span><strong>Terus berkembang!</strong><p>Langkah kecil hari ini membawa kamu lebih dekat ke karier impian.</p></div>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="nav-link logout-btn" type="submit"><span>↪</span> Keluar</button></form>
        </div>
    </aside>
    @endauth

    <main class="main-area">
        <header class="topbar">
            <button class="menu-toggle" type="button" data-menu-toggle aria-label="Buka menu">☰</button>
            <div class="topbar-label">@yield('eyebrow', 'CAREER DEVELOPMENT PLATFORM')</div>
            <div class="topbar-user">
                @auth
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div class="user-meta"><strong>{{ auth()->user()->name }}</strong><span>Member SkillGap</span></div>
                @else
                    <a class="btn btn-outline btn-small" href="{{ route('login') }}">Masuk</a>
                @endauth
            </div>
        </header>
        <section class="page-content">
            @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
            @if (session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif
            @yield('content')
            <footer class="footer">© {{ date('Y') }} SkillGap <span>·</span> Bangun skill, buka peluang.</footer>
        </section>
    </main>
</div>
</body>
</html>
