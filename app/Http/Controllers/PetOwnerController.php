<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class PetOwnerController extends Controller
{
    public function dashboard()
    {
        $pets = Auth::user()->pets;
        return view('pet-owner.dashboard', compact('pets'));
    }

    public function digitalCard(Pet $pet)
    {
        // Ensure the authenticated user owns the pet
        if ($pet->user_id !== Auth::id()) {
            abort(403);
        }

        // Generate QR Code containing the pet's unique ID or a URL to check it
        // For now, let's encode the unique_id.
        // In a real scenario, this might be a URL like route('admin.scan', $pet->unique_id)
        $qrCode = QrCode::size(200)->generate($pet->unique_id);

        return view('pet-owner.digital-card', compact('pet', 'qrCode'));
    }
}
