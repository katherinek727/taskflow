{{-- Shared form partial --}}

<div class="form-group">
    <label for="title">Title <span style="color:var(--rose-400)">*</span></label>
    <input type="text" id="title" name="title"
           class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
           value="{{ old('title', $task->title ?? '') }}"
           placeholder="What needs to be done?">
    @error('title')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description"
              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
              placeholder="Add a note or description…">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="status">Status <span style="color:var(--rose-400)">*</span></label>
    <select id="status" name="status"
            class="form-select {{ $errors->has('status') ? 'is-invalid' : '' }}">
        @foreach(\App\Models\Task::STATUSES as $value => $label)
            <option value="{{ $value }}"
                {{ old('status', $task->status ?? 'new') === $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('status')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
