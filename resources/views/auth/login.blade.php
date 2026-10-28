```blade
@extends('layouts.app')

@section('title', 'Masuk')

@section('content')

<div class="auth-wrap">

    <div class="auth-intro">

        <span class="eyebrow-pill">
            <span class="dot"></span>
            WELCOME BACK
        </span>

        <h1>
            Lanjutkan perjalanan
            <span>kariermu.</span>
        </h1>

        <p>
            Masuk untuk melihat roadmap dan perkembangan
            skill yang sedang kamu bangun.
        </p>

        <div class="auth-note">
            “Masa depan dibangun dari kemampuan yang kamu
            kembangkan hari ini.”
        </div>

    </div>

    <div class="auth-card">

        <div class="auth-card-heading">

            <span class="brand-mark">S</span>

            <h2>Selamat datang kembali</h2>

            <p>
                Masukkan detail akunmu untuk melanjutkan.
            </p>

        </div>

        <form
            method="POST"
            action="{{ route('login.store') }}"
            class="form-stack"
        >

            @csrf

            <label>
                Email

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    required
                    autocomplete="email"
                >
            </label>

            @error('email')
                <small class="field-error">
                    {{ $message }}
                </small>
            @enderror

            <label>
                Kata sandi

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan kata sandi"
                    required
                    autocomplete="current-password"
                >
            </label>

            @error('password')
                <small class="field-error">
                    {{ $message }}
                </small>
            @enderror

            <label class="check-label">
                <input
                    type="checkbox"
                    name="remember"
                >

                Ingat saya
            </label>

            <button
                class="btn btn-primary btn-full"
                type="submit"
            >
                Masuk ke SkillGap
                <span>→</span>
            </button>

        </form>

        <p class="auth-switch">
            Belum punya akun?

            <a href="{{ route('register') }}">
                Daftar sekarang
            </a>
        </p>

    </div>

</div>

@endsection
```