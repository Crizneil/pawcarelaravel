@extends('index')

@section('content')
<style>
    .digital-card-container {
        perspective: 1000px;
        width: 100%;
        max-width: 600px;
        margin: 150px auto 100px;
        cursor: pointer;
    }

    .digital-card {
        width: 100%;
        min-height: 400px;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.8s;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }

    .digital-card.flipped {
        transform: rotateY(180deg);
    }

    .card-face {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 20px;
        display: flex;
        flex-direction: row;
        overflow: hidden;
        background: white;
    }

    .card-front {
        background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
    }

    .card-back {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
        color: white;
        transform: rotateY(180deg);
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 30px;
        text-align: center;
    }

    /* Left side of front card: Info */
    .card-left {
        flex: 1.5;
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Right side of front card: QR Code */
    .card-right {
        flex: 1;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-left: 2px dashed #ddd;
    }

    .pet-name {
        font-size: 2.5rem;
        font-weight: 800;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .pet-info {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 0.5rem;
    }

    .registry-date {
        margin-top: 1.5rem;
        font-size: 0.9rem;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .registry-date span {
        display: block;
        font-weight: 700;
        color: #333;
        font-size: 1.1rem;
    }

    .qr-label {
        margin-top: 10px;
        font-size: 0.8rem;
        color: #999;
        text-align: center;
    }

    .backup-id {
        font-family: monospace;
        background: #eee;
        padding: 5px 10px;
        border-radius: 5px;
        margin-top: 10px;
        display: none; /* User requested removal of backup ID text in favor of scanner, but we keep structure */
    }

    .tap-hint {
        position: absolute;
        bottom: 20px;
        width: 100%;
        text-align: center;
        font-size: 0.8rem;
        color: #aaa;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
        40% {transform: translateY(-5px);}
        60% {transform: translateY(-3px);}
    }

</style>

<div class="digital-card-container" onclick="this.querySelector('.digital-card').classList.toggle('flipped')">
    <div class="digital-card">
        <!-- Front Side -->
        <div class="card-face card-front">
            <div class="card-left">
                <div class="pet-name">{{ $pet->name }}</div>
                <div class="pet-info">{{ $pet->species }} • {{ $pet->breed }}</div>
                <div class="pet-info">Born: {{ $pet->birthdate ? \Carbon\Carbon::parse($pet->birthdate)->format('M d, Y') : 'Unknown' }}</div>
                
                <div class="registry-date">
                    Date of Registry
                    <span>{{ \Carbon\Carbon::parse($pet->registry_date)->format('F d, Y') }}</span>
                </div>

                <div class="tap-hint">Tap card to flip</div>
            </div>
            <div class="card-right">
                <div style="text-align: center;">
                    {{ $qrCode }}
                    <!-- User requested: "Right-side of Digital Card show QR Scanner instead back-up Pet ID Number" 
                         Since this is a static card view, showing the QR code itself acts as the scannable element. 
                         The "Scanner" function is separate (for Admin/Vet). 
                         So here we just show the QR Code prominently. -->
                    <div class="qr-label">Scan Me</div>
                </div>
            </div>
        </div>

        <!-- Back Side -->
        <div class="card-face card-back">
            <img src="{{ asset('assets/images/newlogo.png') }}" alt="PawCare" style="height: 60px; margin-bottom: 20px; filter: brightness(0) invert(1);">
            <h2>Official Digital ID</h2>
            <p>This digital card certifies that {{ $pet->name }} is a registered member of the PawCare system.</p>
            <p style="margin-top: 20px; font-size: 0.9rem; opacity: 0.8;">
                Owner: {{ Auth::user()->name }}<br>
                {{ Auth::user()->house_number }} {{ Auth::user()->street }}, {{ Auth::user()->barangay }}<br>
                {{ Auth::user()->city }}, {{ Auth::user()->province }}
            </p>
        </div>
    </div>
</div>
@endsection
