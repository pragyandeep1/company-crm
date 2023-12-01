<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use App\Notifications\NewCompanyNotification;
use Illuminate\Support\Facades\Notification;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10); // Paginate companies with 10 entries per page
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        // Validate request data

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'website' => 'nullable|url',
        ]);

        // Store company data
        $company = Company::create($validatedData);

        // Trigger email notification
        Notification::route('mail', 'admin@crm.com')
            ->notify(new NewCompanyNotification($company));

        // Store the logo if present
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('public/logos');

            // Store logo path in the database
            $company->logo = $path;
            $company->save();
        }

        // Redirect or perform actions after saving the company data
        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the company with the given ID from the database
        $company = Company::findOrFail($id);

        // Pass the company data to the view
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|string|max:255',
        ]);

        // Update the company details based on validated data
        $company->update($validatedData);

        // Handle logo update if provided in the request
        if ($request->hasFile('logo')) {
            // Store and update the company's logo
            $path = $request->file('logo')->store('public/logos');
            $company->logo = $path;
            $company->save();
        }

        // Redirect or return a response after successful update
        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }
}
