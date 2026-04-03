@extends('layouts.app')
@section('title', 'My Tasks')

@section('content')

{{-- Page header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="page-heading">My Tasks</h1>
        <p class="text-muted text-sm mt-1" style="font-style:italic;">
            {{ $tasks->total() }} {{ $tasks->total() === 1 ? 'task' : 'tasks' }} in your collection
        </p>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
            <path d="M6.5 1v11M1 6.5h11" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        New Task
    </a>
</div>

{{-- Filters --}}
<form method="GET" action="{{ route('tasks.index') }}">
    <div class="card mb-6">
        <div class="card-body" style="padding:1.1rem 1.5rem;">
            <div style="display:grid;grid-template-columns:1fr 190px auto auto;gap:0.75rem;align-items:end;">
                <div>
                    <label for="search">Search by title</label>
                    <input type="text" id="search" name="search" class="form-control"
                           placeholder="Search…" value="{{ request('search') }}">
                </div>
                <div>
                    <label for="status">Filter by status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">All statuses</option>
                        @foreach(\App\Models\Task::STATUSES as $value => $label)
                            <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="position: relative; top: -5px;">
                    <button type="submit" class="btn btn-primary btn-sm" style="border-radius:100px;padding:0.55rem 1.2rem;">Filter</button>
                </div>
                <div style="position: relative; top: -5px;">
                    <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">Reset</a>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Task list --}}
@if($tasks->isEmpty())
    <div class="card">
        <div class="empty-state">
            <div class="empty-state-icon">🌸</div>
            <p>
                No tasks found.<br>
                <a href="{{ route('tasks.create') }}" style="color:var(--status-new);text-decoration:none;font-weight:500;">
                    Create your first task →
                </a>
            </p>
        </div>
    </div>
@else
    <div class="card">
        <hr class="gold-line">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid var(--border-rose);">
                    <th style="padding:1rem 1.5rem;text-align:left;font-size:0.68rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;width:48px;">#</th>
                    <th style="padding:1rem;text-align:left;font-size:0.68rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;">Title</th>
                    <th style="padding:1rem;text-align:left;font-size:0.68rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;width:150px;">Status</th>
                    <th style="padding:1rem;text-align:left;font-size:0.68rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;width:120px;">Created</th>
                    <th style="padding:1rem 1.5rem;text-align:right;font-size:0.68rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;width:150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr class="task-row" style="border-bottom:1px solid rgba(253,160,180,0.1);">
                    <td style="padding:1.1rem 1.5rem;color:var(--text-muted);font-size:0.78rem;">{{ $task->id }}</td>
                    <td style="padding:1.1rem 1rem;">
                        <a href="{{ route('tasks.show', $task) }}"
                           style="color:var(--text);text-decoration:none;font-weight:500;font-size:0.9rem;transition:color 0.2s;"
                           onmouseover="this.style.color='var(--status-new)'"
                           onmouseout="this.style.color='var(--text)'">
                            {{ $task->title }}
                        </a>
                        @if($task->description)
                            <p class="text-muted text-sm mt-1"
                               style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;max-width:360px;font-style:italic;">
                                {{ $task->description }}
                            </p>
                        @endif
                    </td>
                    <td style="padding:1.1rem 1rem;">
                        <span class="badge badge-{{ $task->status }}">{{ $task->statusLabel() }}</span>
                    </td>
                    <td style="padding:1.1rem 1rem;color:var(--text-muted);font-size:0.82rem;">
                        {{ $task->created_at->format('M d, Y') }}
                    </td>
                    <td style="padding:1.1rem 1.5rem;">
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
        <hr class="gold-line">
    </div>

    @if($tasks->hasPages())
        <div>{{ $tasks->links() }}</div>
    @endif
@endif

@endsection
