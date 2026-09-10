<x-layouts.app title="Edit Student">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Students</p>
            <h1 class="h3 mb-0">Edit Student</h1>
        </div>
        <a href="{{ route('students.show', $student) }}" class="btn btn-outline-secondary">View Student</a>
    </div>

    <form method="POST" action="{{ route('students.update', $student) }}" class="card card-body shadow-sm">
        @method('PUT')
        @include('students._form', ['buttonText' => 'Update Student'])
    </form>
</x-layouts.app>
