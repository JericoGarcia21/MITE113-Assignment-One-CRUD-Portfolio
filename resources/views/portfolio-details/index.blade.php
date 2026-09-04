<x-layouts.app title="Portfolio Details">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Portfolio</p>
            <h1 class="h3 mb-0">My details</h1>
        </div>
        <a href="{{ route('portfolio-details.create') }}" class="btn btn-primary">Add detail</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="list-group list-group-flush">
        @forelse ($portfolioDetails as $portfolioDetail)
            <div class="list-group-item">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                    <div>
                        <h2 class="h5 mb-1">{{ $portfolioDetail->full_name }}</h2>
                        <p class="text-primary fw-semibold small mb-2">{{ $portfolioDetail->professional_title }}</p>
                        <p class="text-muted mb-0">{{ $portfolioDetail->bio ?: 'No bio added yet.' }}</p>
                    </div>
                    <div class="d-flex flex-wrap align-items-start gap-2">
                        <a href="{{ route('portfolio-details.show', $portfolioDetail) }}" class="btn btn-sm btn-outline-primary">View</a>
                        <a href="{{ route('portfolio-details.edit', $portfolioDetail) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form method="POST" action="{{ route('portfolio-details.destroy', $portfolioDetail) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="list-group-item text-center py-5">
                <h2 class="h5">No portfolio details yet</h2>
                <p class="text-muted mb-0">Create your first record to start managing your portfolio information.</p>
            </div>
        @endforelse
        </div>
    </div>

    <div class="mt-4">
        {{ $portfolioDetails->links() }}
    </div>
</x-layouts.app>
