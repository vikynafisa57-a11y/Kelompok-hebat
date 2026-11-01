@extends('layouts.app')
@section('title', 'Dashboard')
@section('eyebrow', 'OVERVIEW')
@section('content')
<div class="page-heading"><div><span class="eyebrow-text">DASHBOARD</span><h1>Hai, {{ explode(' ', $user->name)[0] }} <span class="wave">✦</span></h1><p>Setiap skill yang kamu bangun adalah investasi untuk masa depan.</p></div><a class="btn btn-primary" href="{{ route('assessment.index') }}">Mulai assessment <span>→</span></a></div>
<div class="welcome-banner"><div><span class="banner-label">YOUR NEXT CHAPTER</span><h2>{{ $career ? 'Terus berkembang menuju '.$career->title : 'Mulai petakan potensi kariermu' }}</h2><p>{{ $career ? 'Lanjutkan langkah kecilmu hari ini. Konsistensi akan membawa perubahan.' : 'Pilih target karier, kenali kemampuanmu, lalu susun langkah belajar yang tepat.' }}</p><a class="banner-link" href="{{ route('careers.index') }}">{{ $career ? 'Lihat target karier' : 'Pilih target karier' }} <span>→</span></a></div><div class="banner-art"><div class="art-circle">✦</div><div class="art-spark spark-a">✧</div><div class="art-spark spark-b">✦</div></div></div>
<div class="stats-grid">
<div class="stat-card"><div class="stat-top"><span class="stat-icon purple">◎</span><span class="stat-caption">TARGET KARIER</span></div><strong class="stat-number">{{ $career ? 1 : 0 }}</strong><p>{{ $career ? $career->title : 'Belum dipilih' }}</p></div>
<div class="stat-card"><div class="stat-top"><span class="stat-icon blue">✓</span><span class="stat-caption">MATERI SELESAI</span></div><strong class="stat-number">{{ $completedResources }}</strong><p>Dari {{ $totalResources }} materi roadmap</p></div>
<div class="stat-card"><div class="stat-top"><span class="stat-icon green">↗</span><span class="stat-caption">LANGKAH BERIKUTNYA</span></div><strong class="stat-word">{{ $career ? 'Belajar' : 'Mulai' }}</strong><p>{{ $career ? 'Kembangkan skill utama' : 'Pilih karier yang kamu tuju' }}</p></div>
</div>
<div class="section-heading"><div><h2>Rencanakan langkahmu</h2><p>Empat langkah untuk mengembangkan kemampuan.</p></div></div>
<div class="steps-grid">
<a href="{{ route('careers.index') }}" class="step-card"><span class="step-number">01</span><span class="step-icon">◎</span><h3>Pilih target karier</h3><p>Tentukan bidang yang ingin kamu tekuni.</p><span class="step-arrow">→</span></a>
<a href="{{ route('assessment.index') }}" class="step-card"><span class="step-number">02</span><span class="step-icon">✓</span><h3>Ukur kemampuan</h3><p>Kenali level skill yang kamu miliki sekarang.</p><span class="step-arrow">→</span></a>
<a href="{{ route('skill-gap') }}" class="step-card"><span class="step-number">03</span><span class="step-icon">⌁</span><h3>Temukan skill gap</h3><p>Lihat kemampuan yang perlu ditingkatkan.</p><span class="step-arrow">→</span></a>
<a href="{{ route('roadmap.index') }}" class="step-card"><span class="step-number">04</span><span class="step-icon">↗</span><h3>Ikuti roadmap</h3><p>Belajar bertahap dan pantau progresmu.</p><span class="step-arrow">→</span></a>
</div>
@endsection
