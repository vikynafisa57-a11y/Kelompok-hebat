@extends('layouts.app')
@section('title', 'Learning Roadmap')
@section('content')
<div class="page-heading"><div><span class="eyebrow-text">YOUR LEARNING PATH</span><h1>Learning roadmap</h1><p>Belajar satu langkah demi satu langkah. Tandai materi yang sudah kamu selesaikan.</p></div></div>
@if(!$career)<div class="empty-state"><div class="empty-icon">↗</div><h3>Roadmap kamu menunggu</h3><p>Pilih target karier agar kami bisa menampilkan materi belajar yang relevan.</p><a class="btn btn-primary" href="{{ route('careers.index') }}">Pilih target karier →</a></div>@elseif($resources->isEmpty())<div class="empty-state"><h3>Belum ada materi</h3><p>Jalankan <code>php artisan db:seed</code> untuk menambahkan materi contoh.</p></div>@else
<div class="roadmap-overview"><div><small>ROADMAP UNTUK</small><h2>{{ $career->title }}</h2><p>{{ $resources->count() }} materi rekomendasi untuk memulai.</p></div><a class="btn btn-outline" href="{{ route('progress.index') }}">Lihat progres →</a></div>
<div class="roadmap-list">
@foreach($resources as $index => $resource)
@php($isDone = (bool) optional($resource->userProgress->first())->completed)
<div class="roadmap-item"><div class="roadmap-step {{ $isDone ? 'done' : '' }}">{{ $isDone ? '✓' : str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div><div class="roadmap-content"><div class="roadmap-meta"><span>{{ $resource->level }}</span><span>STEP {{ $index + 1 }}</span></div><h3>{{ $resource->title }}</h3><p>{{ $resource->description }}</p><div class="roadmap-actions">@if($resource->url)<a class="text-link" href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer">Buka materi eksternal ↗</a>@endif<form method="POST" action="{{ route('roadmap.progress', $resource) }}">@csrf<button class="btn {{ $isDone ? 'btn-outline' : 'btn-primary' }} btn-small" type="submit">{{ $isDone ? 'Tandai belum selesai' : 'Tandai selesai ✓' }}</button></form></div></div></div>
@endforeach
</div>
@endif
@endsection
