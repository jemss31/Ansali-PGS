<?php

namespace App\Http\Controllers;

use App\Models\Haircut;
use Illuminate\Http\Request;

class HaircutController extends Controller
{
    public function index()
    {
        return response()->json(Haircut::with('pet')->get());
    }

    public function show($id)
    {
        $haircut = Haircut::with('pet')->find($id);

        if (!$haircut) {
            return response()->json(['message' => 'Haircut not found'], 404);
        }

        return response()->json($haircut);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'style' => 'required|string|max:255',
            'groomer_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $haircut = Haircut::create($validated);

        return response()->json(['message' => 'Haircut created', 'haircut' => $haircut], 201);
    }

    public function update(Request $request, $id)
    {
        $haircut = Haircut::find($id);

        if (!$haircut) {
            return response()->json(['message' => 'Haircut not found'], 404);
        }

        $validated = $request->validate([
            'pet_id' => 'sometimes|exists:pets,id',
            'style' => 'sometimes|string|max:255',
            'groomer_name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $haircut->update($validated);

        return response()->json(['message' => 'Haircut updated', 'haircut' => $haircut]);
    }

    public function destroy($id)
    {
        $haircut = Haircut::find($id);

        if (!$haircut) {
            return response()->json(['message' => 'Haircut not found'], 404);
        }

        $haircut->delete();

        return response()->json(['message' => 'Haircut deleted']);
    }
}
