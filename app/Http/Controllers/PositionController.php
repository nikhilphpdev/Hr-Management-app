<?php

namespace App\Http\Controllers;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;
USE Inertia\Response;

class PositionController extends Controller
{
    
   public function index(Request $request): Response
     {
        $query = Position::with('department')->withCount('employees')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->input('search')}%");
        }

        if ($request->filled('department')) {
            $query->where('department_id', $request->integer('department'));
        }

        return Inertia::render('positions/index', [
            'positions' => $query->paginate(10)->withQueryString(),
            'departments' => Department::orderBy('name')->get(['id', 'name']),
            'filters' => $request->only(['search', 'department']),
        ]);
    }

   

    public function store(Request $request)
    {
        // Logic to create a new position
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing position
    }

    public function destroy($id)
    {
        // Logic to delete a position
    }
}
