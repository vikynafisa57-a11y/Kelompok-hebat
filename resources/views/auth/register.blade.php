```blade
@extends('layouts.app')

@section('title', 'Buat Akun')

@section('content')

<div class="auth-wrap">

    <div class="auth-intro">

        <span class="eyebrow-pill">
            <span class="dot"></span>
            START YOUR JOURNEY
        </span>

        <h1>
            Potensi besar dimulai dari
            <span>satu langkah.</span>
        </h1>

        <p>
            Buat akun SkillGap dan mulai rancang pengembangan
            skill sesuai tujuan kariermu.
        </p>

        <div class="auth-note">
            Bukan harus langsung ahli. Yang penting terus bertumbuh.
        </div>

    </div>

    <div class="auth-card">

        <div class="auth-card-heading">

            <span class="brand-mark">S</span>

            <h2>Buat akun SkillGap</h2>

            <p>
                Isi data berikut untuk memulai perjalananmu.
            </p>

        </div>

        <form
            method="POST"
            action="{{ route('register.store') }}"
            class="form-stack"
        >

            @csrf

            <label>
                Nama lengkap

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Nama kamu"
                    required
                    autocomplete="name"
                >
            </label>

            @error('name')
                <small class="field-error">
                    {{ $message }}
                </small>
            @enderror

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
                    placeholder="Minimal 8 karakter"
                    required
                    autocomplete="new-password"
                >
            </label>

            @error('password')
                <small class="field-error">
                    {{ $message }}
                </small>
            @enderror

            <label>
                Konfirmasi kata sandi

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi kata sandi"
                    required
                    autocomplete="new-password"
                >
            </label>

            <button
                class="btn btn-primary btn-full"
                type="submit"
            >
                Buat akun
                <span>→</span>
            </button>

        </form>

        <p class="auth-switch">
            Sudah punya akun?

            <a href="{{ route('login') }}">
                Masuk
            </a>
        </p>

    </div>

</div>

@endsection
```