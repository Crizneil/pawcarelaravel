@extends('index')

@section('content')
<div class="container" style="margin-top: 150px; margin-bottom: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Pet Database</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pet Name</th>
                        <th>Species</th>
                        <th>Breed</th>
                        <th>Owner</th>
                        <th>Owner Address</th>
                        <th>Registered Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pets as $pet)
                        <tr>
                            <td>{{ $pet->unique_id }}</td>
                            <td>{{ $pet->name }}</td>
                            <td>{{ $pet->species }}</td>
                            <td>{{ $pet->breed ?? 'N/A' }}</td>
                            <td>
                                {{ $pet->user->name }}<br>
                                <small class="text-muted">{{ $pet->user->email }}</small>
                            </td>
                            <td><small>{{ $pet->user->city }}, {{ $pet->user->province }}</small></td>
                            <td>{{ \Carbon\Carbon::parse($pet->registry_date)->format('M d, Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-info">View</button>
                                <!-- Future: Edit/Delete -->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No pets registered yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $pets->links() }}
        </div>
    </div>
</div>
@endsection
