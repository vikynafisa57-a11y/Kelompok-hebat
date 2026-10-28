@extends('layouts.app')
@section('title', 'Assessment')
@section('content')
<div class="page-heading"><div><span class="eyebrow-text">SKILL SELF-ASSESSMENT</span><h1>Kenali kemampuanmu</h1><p>Jawab sesuai kemampuanmu saat ini. Tidak ada jawaban benar atau salah.</p></div></div>
@if(!$career)<div class="notice-card"><strong>Target karier belum dipilih</strong><p>Pilih target karier terlebih dahulu agar hasil assessment lebih relevan.</p><a class="btn btn-primary" href="{{ route('careers.index') }}">Pilih target karier →</a></div>@endif
@if($questions->isEmpty())<div class="empty-state"><h3>Pertanyaan belum tersedia</h3><p>Jalankan <code>php artisan db:seed</code> untuk mengisi data contoh.</p></div>@else
<form method="POST" action="{{ route('assessment.submit') }}" class="assessment-form">@csrf
<div class="assessment-instructions"><strong>Bagaimana cara mengisi?</strong><p>1 = Belum pernah · 2 = Pemula · 3 = Cukup memahami · 4 = Mahir · 5 = Sangat mahir</p></div>
@foreach($questions as $index => $question)
<div class="question-card"><div class="question-index">PERTANYAAN {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} <span>{{ $question->skill->name }}</span></div><h3>{{ $question->question }}</h3><p>{{ $question->description }}</p><div class="rating-options">
@for($i=1;$i<=5;$i++)<label class="rating-option"><input type="radio" name="answers[{{ $question->id }}]" value="{{ $i }}" required><span class="rating-number">{{ $i }}</span><small>{{ [1=>'Belum',2=>'Pemula',3=>'Cukup',4=>'Mahir',5=>'Ahli'][$i] }}</small></label>@endfor
</div></div>
@endforeach
@error('answers')<div class="field-error">{{ $message }}</div>@enderror
<button class="btn btn-primary" type="submit">Simpan hasil assessment <span>→</span></button>
</form>
@endif
@endsection
