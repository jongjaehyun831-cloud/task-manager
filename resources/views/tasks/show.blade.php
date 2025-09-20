@extends('layouts.app')

@section('content')
<div class="container">
  <h1>{{ $task->title }}</h1>
  <p>{{ $task->description }}</p>
  <p>Tenggat: {{ optional($task->due_date)->format('Y-m-d') ?? '-' }}</p>
  <p>Status: {{ $task->is_done ? "Selesai" : "Belum" }}</p>
  <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
