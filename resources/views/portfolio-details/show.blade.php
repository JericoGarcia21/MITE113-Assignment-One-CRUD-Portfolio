<x-layouts.app title="{{ $portfolioDetail->full_name }}">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Portfolio detail</p>
            <h1 class="h3 mb-1">{{ $portfolioDetail->full_name }}</h1>
            <p class="text-muted mb-0">{{ $portfolioDetail->professional_title }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('portfolio-details.index') }}" class="btn btn-outline-secondary">Back</a>
            <a href="{{ route('portfolio-details.edit', $portfolioDetail) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card card-body shadow-sm h-100">
                <h2 class="h5">About</h2>
                <p class="mb-4" style="white-space: pre-line;">{{ $portfolioDetail->bio ?: 'No bio added yet.' }}</p>

                <h2 class="h5">Skills</h2>
                <p class="mb-0" style="white-space: pre-line;">{{ $portfolioDetail->skills ?: 'No skills added yet.' }}</p>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card card-body shadow-sm h-100">
                <h2 class="h5">Contact and links</h2>
                <dl class="mb-0">
                    <div>
                        <dt class="text-muted">Email</dt>
                        <dd class="text-break">{{ $portfolioDetail->email ?: 'Not added' }}</dd>
                    </div>
                    <div>
                        <dt class="text-muted">Phone</dt>
                        <dd class="text-break">{{ $portfolioDetail->phone ?: 'Not added' }}</dd>
                    </div>
                    <div>
                        <dt class="text-muted">Address</dt>
                        <dd class="text-break">{{ $portfolioDetail->address ?: 'Not added' }}</dd>
                    </div>
                    @foreach (['project_url' => 'Project', 'github_url' => 'GitHub', 'linkedin_url' => 'LinkedIn'] as $field => $label)
                        <div>
                            <dt class="text-muted">{{ $label }}</dt>
                            <dd class="text-break">
                                @if ($portfolioDetail->{$field})
                                    <a href="{{ $portfolioDetail->{$field} }}" target="_blank" rel="noopener noreferrer">{{ $portfolioDetail->{$field} }}</a>
                                @else
                                    Not added
                                @endif
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </div>
</x-layouts.app>
