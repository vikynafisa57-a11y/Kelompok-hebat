@extends('layouts.app')
@section('title', 'Target Karier')
@section('content')
<div class="page-heading"><div><span class="eyebrow-text">CAREER DIRECTION</span><h1>Pilih target karier</h1><p>Pilih bidang yang paling ingin kamu kembangkan. Kamu bisa mengubahnya nanti.</p></div></div>
@if($careers->isEmpty())<div class="empty-state"><h3>Data karier belum tersedia</h3><p>Jalankan <code>php artisan db:seed</code> untuk menambahkan data awal.</p></div>@else
<div class="career-grid">
@foreach($careers as $career)
<div class="career-card"><div class="career-card-top"><span class="career-icon">{{ $career->icon === 'palette' ? '✧' : ($career->icon === 'chart' ? '▥' : '⌘') }}</span><span class="career-tag">{{ $career->skills->count() }} skill utama</span></div><h2>{{ $career->title }}</h2><p>{{ $career->description }}</p><div class="skill-chips">@foreach($career->skills as $skill)<span>{{ $skill->name }}</span>@endforeach</div><form method="POST" action="{{ route('careers.select') }}">@csrf<input type="hidden" name="career_target_id" value="{{ $career->id }}"><button class="btn {{ auth()->user()->career_target_id === $career->id ? 'btn-outline' : 'btn-primary' }} btn-full" type="submit">{{ auth()->user()->career_target_id === $career->id ? 'Target saat ini ✓' : 'Pilih karier ini →' }}</button></form></div>
@endforeach
</div>
@endif
@endsection