@extends('layouts.app')
@section('title', 'Temukan Potensi Kariermu')
@section('content')
<div class="landing-hero">
    <div class="hero-copy">
        <span class="eyebrow-pill"><span class="dot"></span> CAREER DEVELOPMENT PLATFORM</span>
        <h1>Kenali potensimu.<br><span>Rancang masa depanmu.</span></h1>
        <p>Temukan skill yang perlu kamu kembangkan, susun roadmap belajar, dan pantau progres menuju karier impian.</p>
        <div class="hero-actions"><a class="btn btn-primary" href="{{ route('register') }}">Mulai perjalanan <span>→</span></a><a class="btn btn-outline" href="{{ route('login') }}">Saya sudah punya akun</a></div>
        <div class="hero-proof"><div class="proof-avatars"><span>A</span><span>B</span><span>C</span></div><span>Mulai langkah pertamamu hari ini</span></div>
    </div>