@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="full_name" class="form-label">Full name</label>
        <input id="full_name" name="full_name" type="text" value="{{ old('full_name', $portfolioDetail->full_name ?? '') }}" class="form-control" required>
        @error('full_name')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="professional_title" class="form-label">Professional title</label>
        <input id="professional_title" name="professional_title" type="text" value="{{ old('professional_title', $portfolioDetail->professional_title ?? '') }}" class="form-control" required>
        @error('professional_title')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $portfolioDetail->email ?? '') }}" class="form-control">
        @error('email')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="phone" class="form-label">Phone</label>
        <input id="phone" name="phone" type="text" value="{{ old('phone', $portfolioDetail->phone ?? '') }}" class="form-control">
        @error('phone')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="address" class="form-label">Address</label>
        <input id="address" name="address" type="text" value="{{ old('address', $portfolioDetail->address ?? '') }}" class="form-control">
        @error('address')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="bio" class="form-label">Bio</label>
        <textarea id="bio" name="bio" rows="5" class="form-control">{{ old('bio', $portfolioDetail->bio ?? '') }}</textarea>
        @error('bio')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="skills" class="form-label">Skills</label>
        <textarea id="skills" name="skills" rows="3" class="form-control">{{ old('skills', $portfolioDetail->skills ?? '') }}</textarea>
        @error('skills')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="project_url" class="form-label">Project URL</label>
        <input id="project_url" name="project_url" type="url" value="{{ old('project_url', $portfolioDetail->project_url ?? '') }}" class="form-control">
        @error('project_url')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="github_url" class="form-label">GitHub URL</label>
        <input id="github_url" name="github_url" type="url" value="{{ old('github_url', $portfolioDetail->github_url ?? '') }}" class="form-control">
        @error('github_url')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="linkedin_url" class="form-label">LinkedIn URL</label>
        <input id="linkedin_url" name="linkedin_url" type="url" value="{{ old('linkedin_url', $portfolioDetail->linkedin_url ?? '') }}" class="form-control">
        @error('linkedin_url')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="d-flex flex-wrap gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        {{ $buttonText }}
    </button>
    <a href="{{ route('portfolio-details.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
