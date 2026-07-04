<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of all employees.
     */
    public function index()
    {
        // Get all users except owners
        $employees = User::where('role', '!=', 'owner')->get();

        return view('admin.employees.index', [
            'employees' => $employees,
            'active' => 'employees',
            'heading' => 'Employee Accounts',
            'title' => 'List and manage designated system employee credentials and modular permissions.'
        ]);
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('admin.employees.create', [
            'active' => 'employees',
            'heading' => 'Add Employee Account',
            'title' => 'Create a new employee profile and define their system access permissions.'
        ]);
    }

    /**
     * Store a newly created employee.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'permissions' => ['nullable', 'array'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'revenueOfficer', // Standard employee role
            'permissions' => $request->input('permissions', []),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee account created successfully!');
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit($id)
    {
        $employee = User::where('role', '!=', 'owner')->findOrFail($id);

        return view('admin.employees.edit', [
            'employee' => $employee,
            'active' => 'employees',
            'heading' => 'Edit Employee Account',
            'title' => 'Modify account credentials or change designated module access levels.'
        ]);
    }

    /**
     * Update the specified employee.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id)],
            'password' => ['nullable', 'string', 'min:6'],
            'permissions' => ['nullable', 'array'],
        ]);

        $employee = User::where('role', '!=', 'owner')->findOrFail($request->id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->permissions = $request->input('permissions', []);

        if ($request->filled('password')) {
            $employee->password = Hash::make($request->password);
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee account details updated successfully!');
    }

    /**
     * Remove the specified employee.
     */
    public function destroy($id)
    {
        $employee = User::where('role', '!=', 'owner')->findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee account deleted successfully!');
    }
}
