<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        return response()->json(Pet::all());
    }

    public function show($id)
    {
        $pet = Pet::find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }

        return response()->json($pet);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $pet = Pet::create($validated);

        return response()->json(['message' => 'Pet created', 'pet' => $pet], 201);
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }

        $validated = $request->validate([
            'pet_name' => 'sometimes|string|max:255',
            'customer_name' => 'sometimes|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $pet->update($validated);

        return response()->json(['message' => 'Pet updated', 'pet' => $pet]);
    }

    public function destroy($id)
    {
        $pet = Pet::find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }

        $pet->delete();

        return response()->json(['message' => 'Pet deleted']);
    }
}
