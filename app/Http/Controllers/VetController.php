<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Vaccine;

class VetController extends Controller
{
    public function dashboard()
    {
        return view('vet.dashboard');
    }

    public function petRecords()
    {
        // Vets can view all pets, similar to Admin
        $pets = Pet::with('user')->latest()->paginate(10);
        // Reuse admin view for consistency, or we could create a vet-specific one
        return view('admin.pet-records', compact('pets'));
    }

    public function vaccines(Request $request)
    {
        // Vets can view vaccines
        $query = Vaccine::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $vaccines = $query->paginate(10);
        return view('admin.vaccines', compact('vaccines'));
    }

    public function searchPet(Request $request)
    {
        $search = $request->input('search');
        // Search by Unique ID (exact) or Name (partial)
        $pet = Pet::where('unique_id', $search)->first();

        if (!$pet) {
            return back()->with('error', 'Pet not found with ID: ' . $search);
        }

        // Redirect to a detail view (reusing digital card view or creating a new medical record view)
        // For now, let's show the digital card info as a "Record"
        return redirect()->route('pet-owner.digital-card', $pet->id); 
    }
}
