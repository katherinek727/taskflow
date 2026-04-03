@extends('layouts.app')
@section('title', $task->title)

@section('content')

<div style="max-width:660px;margin:0 auto;">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">← All Tasks</a>
    </div>

    <div class="card">
        <hr class="gold-line">

        {{-- Header --}}
        <div style="padding:2.25rem 2rem 1.75rem;border-bottom:1px solid var(--border-rose);">
            <div class="flex items-center justify-between mb-4">
                <span class="badge badge-{{ $task->status }}">{{ $task->statusLabel() }}</span>
                <span class="text-muted text-sm" style="font-style:italic;">#{{ $task->id }}</span>
            </div>
            <h2 style="font-family:'Playfair Display',serif;font-size:1.65rem;font-weight:700;line-height:1.3;color:var(--text);letter-spacing:-0.01em;">
                {{ $task->title }}
            </h2>
        </div>

        {{-- Body --}}
        <div class="card-body">
            @if($task->description)
                <p style="color:var(--text-soft);line-height:1.9;white-space:pre-wrap;font-size:0.95rem;">
                    {{ $task->description }}
                </p>
            @else
                <p class="text-muted text-sm" style="font-style:italic;">No description provided.</p>
            @endif

            <hr class="divider">

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                <div style="background:var(--blush);border-radius:var(--radius-xs);padding:1rem 1.1rem;border:1px solid var(--border-rose);">
                    <p class="text-muted text-sm" style="text-transform:uppercase;letter-spacing:0.08em;font-size:0.68rem;margin-bottom:0.35rem;font-weight:600;">Created</p>
                    <p class="font-semibold text-sm">{{ $task->created_at->format('M d, Y') }}</p>
                    <p class="text-muted" style="font-size:0.78rem;">{{ $task->created_at->format('H:i') }}</p>
                </div>
                <div style="background:var(--champagne);border-radius:var(--radius-xs);padding:1rem 1.1rem;border:1px solid rgba(201,169,110,0.2);">
                    <p class="text-muted text-sm" style="text-transform:uppercase;letter-spacing:0.08em;font-size:0.68rem;margin-bottom:0.35rem;font-weight:600;">Last Updated</p>
                    <p class="font-semibold text-sm">{{ $task->updated_at->format('M d, Y') }}</p>
                    <p class="text-muted" style="font-size:0.78rem;">{{ $task->updated_at->format('H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div style="padding:1.25rem 1.75rem;border-top:1px solid var(--border-rose);display:flex;gap:0.6rem;background:rgba(253,160,180,0.03);">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit Task</a>
            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                  onsubmit="return confirm('Delete «{{ addslashes($task->title) }}»?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

        <hr class="gold-line">
    </div>

</div>

@endsection
