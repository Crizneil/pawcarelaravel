@extends('layouts.dashboard')

@push('styles')
    <style>
        .flip-card {
            perspective: 1000px;
            height: 350px;
            cursor: pointer;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flip-card.flipped .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .flip-card-front {
            background: white;
            color: black;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .flip-card-back {
            background: #1f2937;
            color: white;
            transform: rotateY(180deg);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid fade-in">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="font-weight-bold mb-0">My Pet Registry</h2>
                <p class="text-muted">Manage your pets and view their digital cards.</p>
            </div>
            <a href="#" class="btn btn-primary rounded-pill px-4 font-weight-bold"><i data-lucide="calendar"
                    class="mr-2"></i> Book Appointment</a>
        </div>

        <div class="row">
            @forelse($pets as $pet)
                <div class="col-lg-6 mb-4">
                    <div class="flip-card" onclick="this.classList.toggle('flipped')">
                        <div class="flip-card-inner">
                            <!-- Front -->
                            <div class="flip-card-front p-4 text-left">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="mr-4">
                                        <img src="{{ $pet->image_url ?? 'https://ui-avatars.com/api/?name=' . $pet->name }}"
                                            class="rounded-circle"
                                            style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #fce7d6;">
                                    </div>
                                    <div>
                                        <h2 class="font-weight-bold mb-0">{{ $pet->name }}</h2>
                                        <p class="text-primary font-weight-bold mb-0">{{ $pet->breed ?? 'Unknown' }}</p>
                                        <small class="text-muted">Born: {{ $pet->birthday ?? 'N/A' }}</small>
                                    </div>
                                    <div class="ml-auto">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $pet->unique_id }}"
                                            style="width: 80px; opacity: 0.8;">
                                    </div>
                                </div>
                                <div class="bg-light p-3 rounded text-center">
                                    <small class="text-uppercase text-muted font-weight-bold">Click card to view details</small>
                                </div>
                            </div>
                            <!-- Back -->
                            <div class="flip-card-back p-4 text-left">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <img src="{{ asset('assets/images/newlogo.png') }}"
                                        style="filter: brightness(0) invert(1); height: 30px;">
                                    <small class="text-white-50">Official Digital ID</small>
                                </div>
                                <h3 class="font-weight-bold text-warning mb-4">{{ $pet->unique_id }}</h3>
                                <div class="mb-4">
                                    <p class="mb-1 text-white-50 small">Owner</p>
                                    <h5 class="font-weight-bold">{{ Auth::user()->name }}</h5>
                                    <p class="small text-white-50 mt-2">
                                        {{ Auth::user()->house_number }} {{ Auth::user()->street }},
                                        {{ Auth::user()->barangay }}<br>
                                        {{ Auth::user()->city }}, {{ Auth::user()->province }}
                                    </p>
                                </div>
                                <div class="mt-auto text-center">
                                    <small class="text-white-50">PawCare Veterinary Clinic • Meycauayan, Bulacan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center">
                    <div class="bg-white p-5 rounded-lg shadow-sm d-inline-block">
                        <i data-lucide="dog" class="w-16 h-16 text-muted mb-3 mx-auto" style="width: 64px; height: 64px;"></i>
                        <h3 class="font-weight-bold">No Pets Found</h3>
                        <p class="text-muted">Contact the clinic to register your pets.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection