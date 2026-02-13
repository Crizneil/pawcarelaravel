@extends('index')

@section('content')
<div class="container" style="margin-top: 150px; margin-bottom: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Vaccine Inventory</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    <!-- Search Filter -->
    <div class="card p-4 mb-4">
        <form action="{{ route('admin.vaccinations') }}" method="GET" class="row g-3">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" placeholder="Search vaccine name or description..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Search Filter</button>
            </div>
        </form>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Stock</th>
                        <th>Price (PHP)</th>
                        <th>Last Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vaccines as $vaccine)
                        <tr>
                            <td><strong>{{ $vaccine->name }}</strong></td>
                            <td>{{ Str::limit($vaccine->description, 50) }}</td>
                            <td>
                                @if($vaccine->stock < 20)
                                    <span class="text-danger fw-bold">{{ $vaccine->stock }} (Low)</span>
                                @else
                                    <span class="text-success">{{ $vaccine->stock }}</span>
                                @endif
                            </td>
                            <td>{{ number_format($vaccine->price, 2) }}</td>
                            <td>{{ $vaccine->updated_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No vaccines found matching your criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $vaccines->appends(['search' => request('search')])->links() }}
        </div>
    </div>
</div>
@endsection
