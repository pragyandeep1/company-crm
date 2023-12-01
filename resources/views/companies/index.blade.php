@extends('layouts/app')
@section('title', 'Companies')
@section('content')
<div class="d-flex col-lg-12">
	<h2 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Company Details</h2>
    <nav class="page-breadcrumb right-0 col-md-2">
      <a href="{{route('companies.add')}}" class="btn btn-secondary right-0"><i class="fa fa-plus-circle"></i> Add Company </a>
    </nav>
</div>
<div class="card shadow mb-4 col-lg-12">
    <!-- Display company information -->
    <table id="dataTable" class="table table-striped">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Company Name</th>
                <th>Company Email</th>
                <th>Company Website</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $key=>$company)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->emai }}</td>
                <td>{{ $company->website }}</td>
                <td class="d-flex">
                    <a class="button btn btn-info" href="{{ route('companies.edit', ['company' => $company->id]) }}"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('companies.delete', ['company' => $company->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Display company logo -->
@if(isset($company->logo))
    <img src="{{ asset($company->logo) }}" alt="Company Logo">
@else
    <p>No logo available</p>
@endif

<!-- Display pagination links -->
{{ $companies->links() }}

<script>
    $(document).ready(function () {
        $('#companiesTable').DataTable();
    });
</script>
@endsection