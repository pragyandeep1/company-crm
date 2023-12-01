<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::paginate(10); // Paginate employees with 10 entries per page
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        // Validate the incoming request using EmployeeRequest rules
        $validatedData = $request->validated();

        // Create a new Employee instance with the validated data
        $employee = new Employee([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'company_id' => $validatedData['company_id'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);

        // Save the employee to the database
        $employee->save();

        // Redirect or return a response after successful storage
        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the employee with the given ID from the database
        $employee = Employee::findOrFail($id);

        // Pass the employee data to the view
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company_id' => 'required|exists:companies,id', 
        ]);

        // Update the employee with validated data
        $employee->update($validatedData);

        // Redirect or return a response after updating the employee
        return redirect()->route('employees.show', ['employee' => $employee->id])
            ->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
