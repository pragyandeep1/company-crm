@extends('layouts/app')
@section('title', 'Employees')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Add Employee
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('employees.store') }}">
                            @csrf
                            <div class="d-flex">
                                <div class="row mb-3 col-md-6">
                                    <label for="first_name">First Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3 col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="row mb-3 col-md-6">
                                    <label for="company_id">Company</label>
                                    <div class="col-md-12">
                                        <select name="company_id" id="company_id" class="form-control" required>
                                            <!-- Options for companies fetched from database -->
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 col-md-6">
                                    <label for="email">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 col-md-6">
                                <label for="phone">Phone</label>
                                <div class="col-md-12">
                                    <input type="text" name="phone" id="phone" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3 col-md-6">
                                <label for="name" class="col-md-8 col-form-label text-md-end"></label>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Add Employee</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
