@extends('layouts/app')
@section('title', 'Employees')
@section('content')
<div class="d-flex col-lg-12">
    <h2 class="h3 mb-4 text-gray-800 col-md-10 text-uppercase">Employee Details</h2>
    <nav class="page-breadcrumb right-0 col-md-2">
      <a href="{{route('employees.add')}}" class="btn btn-secondary right-0"><i class="fa fa-plus-circle"></i> Add Employee </a>
    </nav>
</div>

<!-- Display company information -->
<div class="card shadow mb-4 col-lg-12">
    <table id="dataTable" class="table table-striped">
        <thead>
            <tr>
                <th>Sl</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $key=>$employee)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->company->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td class="d-flex">
                    <a class="button btn btn-info" href="{{ route('employees.edit', ['employee' => $employee->id]) }}"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('employees.delete', ['employee' => $employee->id]) }}">
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

    <!-- Display pagination links -->
    {{ $employees->links() }}

    <script>
        $(document).ready(function () {
            $('#employeesTable').DataTable();
        });
    </script>
@endsection