<x-layouts.app title="Edit Portfolio Detail">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Portfolio</p>
            <h1 class="h3 mb-0">Edit detail</h1>
        </div>
        <a href="{{ route('portfolio-details.show', $portfolioDetail) }}" class="btn btn-outline-secondary">View detail</a>
    </div>

    <form method="POST" action="{{ route('portfolio-details.update', $portfolioDetail) }}" class="card card-body shadow-sm">
        @method('PUT')
        @include('portfolio-details._form', ['buttonText' => 'Update detail'])
    </form>
</x-layouts.app>
