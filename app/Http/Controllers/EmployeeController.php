<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        // Search berdasarkan nama atau email
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan departemen
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        // Pagination 15 data per halaman
        $employees = $query
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        // Daftar departemen untuk pilihan filter
        $departments = Employee::select('department')
            ->distinct()
            ->orderBy('department')
            ->pluck('department');

        return view('employees.index', compact(
            'employees',
            'departments'
        ));
    }
}
