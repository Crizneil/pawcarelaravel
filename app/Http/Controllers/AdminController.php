<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pet;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Add stats for dashboard
        $totalPets = Pet::count();
        $totalOwners = User::where('role', 'owner')->count();
        $totalStaff = User::where('role', 'vet')->count();

        return view('admin.dashboard', compact('totalPets', 'totalOwners', 'totalStaff'));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'owner_email' => 'required|email',
            'pet_name' => 'required|string',
            'breed' => 'required|string',
            'next_date' => 'required|date',
        ]);

        // Find or Create Owner
        $owner = User::firstOrCreate(
            ['email' => $request->owner_email],
            [
                'name' => $request->owner_name ?? 'New Owner',
                'password' => Hash::make('password'), // Default password
                'role' => 'owner',
                'house_number' => 'N/A',
                'street' => 'N/A',
                'barangay' => 'N/A',
                'city' => 'Meycauayan',
            ]
        );

        // Generate Unique ID
        $year = date('Y');
        $count = Pet::count() + 1;
        $unique_id = 'PC-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

        // Create Pet
        Pet::create([
            'user_id' => $owner->id,
            'name' => $request->pet_name,
            'species' => 'Dog',
            'breed' => $request->breed,
            'age' => 1,
            'unique_id' => $unique_id,
        ]);

        return back()->with('success', 'Pet enrolled successfully! ID: ' . $unique_id);
    }

    public function petRecords()
    {
        $pets = Pet::with('user')->latest()->paginate(10);
        return view('admin.pet-records', compact('pets'));
    }

    public function employees()
    {
        $staff = User::where('role', 'vet')->latest()->paginate(10);
        return view('admin.employees', compact('staff'));
    }

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'vet',
            // Default address for staff (can be updated later)
            'house_number' => 'Clinic',
            'street' => 'MacArthur Hwy',
            'barangay' => 'Clinic Brgy',
            'city' => 'City of Meycauayan',
            'province' => 'Bulacan',
        ]);

        return redirect()->route('admin.employees')->with('success', 'Staff member added successfully.');
    }

    public function vaccines(Request $request)
    {
        $query = Vaccine::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        $vaccines = $query->paginate(10);
        return view('admin.vaccines', compact('vaccines'));
    }
}
