@extends('layouts/app')
@section('title', 'Companies')
@section('content')
    <h1>Add a New Company</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        <div class="d-flex">
            <div class="row mb-3 col-md-6">
                <label for="name">Company Name:</label>
                <div class="col-md-12">
                    <input type="text" id="name" name="name">
                </div>
            </div>
            <div class="row mb-3 col-md-6">
                <label for="email">Email:</label>
                <div class="col-md-12">
                    <input type="text" id="email" name="email">
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="row mb-3 col-md-6">
                <label for="logo">Logo:</label>
                <div class="col-md-12">
                    <input type="file" id="logo" name="logo">
                </div>
            </div>
            <div class="row mb-3 col-md-6">
                <label for="website">Website:</label>
                <div class="col-md-12">
                    <input type="text" id="website" name="website">
                </div>
            </div>
        </div>
        <div class="row mb-3 col-md-6">
            <label for="name" class="col-md-8 col-form-label text-md-end"></label>
            <div class="col-md-12">
                <button type="submit">Add Company</button>
            </div>
        </div>
    </form>
@endsection
