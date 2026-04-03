@extends('layouts.app')
@section('title', 'Edit Task')

@section('content')

<div style="max-width:640px;margin:0 auto;">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('tasks.show', $task) }}" class="btn btn-ghost btn-sm">← Back</a>
        <div>
            <h1 class="page-heading" style="font-size:1.4rem;">Edit Task</h1>
            <p class="text-muted text-sm mt-1">#{{ $task->id }} · Last updated {{ $task->updated_at->diffForHumans() }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Task Details</div>
        <div class="card-body">
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf @method('PUT')
                @include('tasks._form')
                <hr class="divider">
                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
