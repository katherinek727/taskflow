@extends('layouts.app')
@section('title', $task->title)

@section('content')

<div style="max-width:680px;margin:0 auto;">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">← All Tasks</a>
    </div>

    <div class="card">
        {{-- Header --}}
        <div style="padding:2rem 2rem 1.5rem;border-bottom:1px solid var(--border);">
            <div class="flex items-center justify-between mb-4">
                <span class="badge badge-{{ $task->status }}">{{ $task->statusLabel() }}</span>
                <span class="text-muted text-sm">#{{ $task->id }}</span>
            </div>
            <h2 style="font-size:1.5rem;font-weight:700;letter-spacing:-0.02em;line-height:1.3;">
                {{ $task->title }}
            </h2>
        </div>

        {{-- Body --}}
        <div class="card-body">
            @if($task->description)
                <p style="color:var(--text);line-height:1.8;white-space:pre-wrap;font-size:0.95rem;">
                    {{ $task->description }}
                </p>
            @else
                <p class="text-muted text-sm" style="font-style:italic;">No description provided.</p>
            @endif

            <hr class="divider">

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div>
                    <p class="text-muted text-sm" style="text-transform:uppercase;letter-spacing:0.05em;font-size:0.7rem;margin-bottom:0.3rem;">Created</p>
                    <p class="text-sm font-semibold">{{ $task->created_at->format('M d, Y · H:i') }}</p>
                </div>
                <div>
                    <p class="text-muted text-sm" style="text-transform:uppercase;letter-spacing:0.05em;font-size:0.7rem;margin-bottom:0.3rem;">Last Updated</p>
                    <p class="text-sm font-semibold">{{ $task->updated_at->format('M d, Y · H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div style="padding:1.25rem 1.75rem;border-top:1px solid var(--border);display:flex;gap:0.5rem;">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit Task</a>
            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                  onsubmit="return confirm('Delete «{{ addslashes($task->title) }}»?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

</div>

@endsection
