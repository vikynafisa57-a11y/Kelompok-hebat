@extends('layouts.app')
@section('title', 'Temukan Potensi Kariermu')
@section('content')
    <div class="landing-hero">
        <div class="hero-copy">
            <span class="eyebrow-pill"><span class="dot"></span> CAREER DEVELOPMENT PLATFORM</span>
            <h1>Kenali potensimu.<br><span>Rancang masa depanmu.</span></h1>
            <p>Temukan skill yang perlu kamu kembangkan, susun roadmap belajar, dan pantau progres menuju karier impian.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="{{ route('register') }}">Mulai perjalanan
                    <span>→</span></a><a class="btn btn-outline" href="{{ route('login') }}">Saya sudah punya akun</a></div>
            <div class="hero-proof">
                <div class="proof-avatars"><span>A</span><span>B</span><span>C</span></div><span>Mulai langkah pertamamu
                    hari ini</span>
            </div>
        </div>
        <div class="hero-visual">
            <div class="orb orb-one"></div>
            <div class="orb orb-two"></div>
            <div class="preview-card">
                <div class="preview-head">
                    <div><small>YOUR CAREER OVERVIEW</small>
                        <h3>Perjalanan skill</h3>
                    </div><span class="preview-icon">✦</span>
                </div>
                <div class="preview-score">
                    <div><small>Skill readiness</small><strong>72<small>/100</small></strong></div>
                    <div class="score-ring"><span>72%</span></div>
                </div>
                <div class="mini-progress">
                    <div><span>Technical skills</span><b>78%</b></div>
                    <div class="progress-track"><i style="width:78%"></i></div>
                </div>
                <div class="mini-progress">
                    <div><span>Problem solving</span><b>64%</b></div>
                    <div class="progress-track"><i style="width:64%"></i></div>
                </div>
                <div class="preview-bottom"><span class="preview-check">✓</span>
                    <div><b>Keep your momentum</b><small>One step at a time.</small></div>
                </div>
            </div>
            <div class="floating-note"><span>↗</span>
                <div><b>Growth mindset</b><small>Progress over perfection</small></div>
            </div>
        </div>
    </div>
    <div class="feature-grid">
        <div class="feature-card"><span class="feature-icon purple">◎</span>
            <h3>Kenali skill gap</h3>
            <p>Bandingkan kemampuanmu dengan kebutuhan karier yang dituju.</p>
        </div>
        <div class="feature-card"><span class="feature-icon blue">↗</span>
            <h3>Roadmap personal</h3>
            <p>Ikuti tahapan belajar yang lebih terarah dan mudah dipantau.</p>
        </div>
        <div class="feature-card"><span class="feature-icon green">▥</span>
            <h3>Pantau progres</h3>
            <p>Lihat perkembanganmu dan rayakan setiap langkah kecil.</p>
        </div>
    </div>
@endsection