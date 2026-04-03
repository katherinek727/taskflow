@extends('layouts.app')
@section('title', 'All Tasks')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="page-heading">My Tasks</h1>
        <p class="text-muted text-sm mt-1">{{ $tasks->total() }} task{{ $tasks->total() !== 1 ? 's' : '' }} total</p>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        New Task
    </a>
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('tasks.index') }}">
    <div class="card mb-6">
        <div class="card-body" style="padding:1rem 1.5rem;">
            <div style="display:grid;grid-template-columns:1fr 200px auto auto;gap:0.75rem;align-items:end;">
                <div>
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" class="form-control"
                           placeholder="Search by title…" value="{{ request('search') }}">
                </div>
                <div>
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">All statuses</option>
                        @foreach(\App\Models\Task::STATUSES as $value => $label)
                            <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="padding-top:1.3rem;">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div style="padding-top:1.3rem;">
                    <a href="{{ route('tasks.index') }}" class="btn btn-ghost">Reset</a>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Task list --}}
@if($tasks->isEmpty())
    <div class="card">
        <div class="empty-state">
            <div class="empty-state-icon">📋</div>
            <p>No tasks found. <a href="{{ route('tasks.create') }}" style="color:var(--brand-1)">Create your first one.</a></p>
        </div>
    </div>
@else
    <div class="card">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid var(--border);">
                    <th style="padding:0.9rem 1.5rem;text-align:left;font-size:0.72rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;width:48px;">#</th>
                    <th style="padding:0.9rem 1rem;text-align:left;font-size:0.72rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;">Title</th>
                    <th style="padding:0.9rem 1rem;text-align:left;font-size:0.72rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;width:140px;">Status</th>
                    <th style="padding:0.9rem 1rem;text-align:left;font-size:0.72rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;width:120px;">Created</th>
                    <th style="padding:0.9rem 1.5rem;text-align:right;font-size:0.72rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;width:140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr style="border-bottom:1px solid var(--border);transition:background var(--transition);"
                    onmouseover="this.style.background='var(--surface-hover)'"
                    onmouseout="this.style.background='transparent'">
                    <td style="padding:1rem 1.5rem;color:var(--text-muted);font-size:0.8rem;">{{ $task->id }}</td>
                    <td style="padding:1rem;">
                        <a href="{{ route('tasks.show', $task) }}"
                           style="color:var(--text);text-decoration:none;font-weight:500;font-size:0.9rem;"
                           onmouseover="this.style.color='var(--brand-1)'"
                           onmouseout="this.style.color='var(--text)'">
                            {{ $task->title }}
                        </a>
                        @if($task->description)
                            <p class="text-muted text-sm mt-1"
                               style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;max-width:380px;">
                                {{ $task->description }}
                            </p>
                        @endif
                    </td>
                    <td style="padding:1rem;">
                        <span class="badge badge-{{ $task->status }}">{{ $task->statusLabel() }}</span>
                    </td>
                    <td style="padding:1rem;color:var(--text-muted);font-size:0.82rem;">
                        {{ $task->created_at->format('M d, Y') }}
                    </td>
                    <td style="padding:1rem 1.5rem;">
                        <div class="flex gap-2" style="justify-content:flex-end;">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                  onsubmit="return confirm('Delete «{{ addslashes($task->title) }}»?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($tasks->hasPages())
        <div>{{ $tasks->links() }}</div>
    @endif
@endif

@endsection
