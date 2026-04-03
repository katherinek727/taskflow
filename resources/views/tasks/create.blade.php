@extends('layouts.app')
@section('title', 'New Task')

@section('content')

<div style="max-width:620px;margin:0 auto;">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">← Back</a>
        <div>
            <h1 class="page-heading-sub">New Task</h1>
            <p class="text-muted text-sm mt-1" style="font-style:italic;">Add something beautiful to your list</p>
        </div>
    </div>

    <div class="card">
        <hr class="gold-line">
        <div class="card-header">Task Details</div>
        <div class="card-body">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf
                @include('tasks._form')
                <hr class="divider">
                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">Create Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-ghost">Cancel</a>
                </div>
            </form>
        </div>
        <hr class="gold-line">
    </div>

</div>

@endsection
