<x-layouts.app title="Create Portfolio Detail">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Portfolio</p>
            <h1 class="h3 mb-0">Create detail</h1>
        </div>
        <a href="{{ route('portfolio-details.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>

    <form method="POST" action="{{ route('portfolio-details.store') }}" class="card card-body shadow-sm">
        @include('portfolio-details._form', ['buttonText' => 'Save detail'])
    </form>
</x-layouts.app>
