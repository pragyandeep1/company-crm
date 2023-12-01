@extends('layouts/app')
@section('title', 'Companies')
@section('content')
    <div class="container">
        <h1>Edit Company</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('companies.update', $company->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $company->name) }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $company->email) }}">
            </div>

            <div class="form-group">
                <label for="logo">Logo (minimum 100x100):</label>
                <input type="file" class="form-control-file" id="logo" name="logo">
            </div>

            <div class="form-group">
                <label for="website">Website:</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $company->website) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
