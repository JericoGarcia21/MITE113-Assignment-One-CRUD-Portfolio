@csrf

<div class="row g-3">
    <div class="col-12">
        <label for="name" class="form-label">Course Name</label>
        <input id="name" name="name" type="text"
               value="{{ old('name', $course->name ?? '') }}"
               class="form-control" required>
        @error('name')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" rows="4" class="form-control">{{ old('description', $course->description ?? '') }}</textarea>
        @error('description')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="d-flex flex-wrap gap-2 mt-4">
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
