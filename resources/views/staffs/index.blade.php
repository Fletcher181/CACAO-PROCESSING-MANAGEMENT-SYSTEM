@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Accounts List
                            <a href="{{ url('staffs/create')}}" class="btn btn-primary float-end">Add Account</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-stiped table-bordered">
                            <thead>
                                <tr>
                                    <th>Staff ID</th>
                                    <th>Fullname</th>
                                    <th>Role</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Created_At</th>
                                    <th>Updated_At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs as $staff)
                                <tr>
                                    <td>{{ $staff->staff_id }}</td>
                                    <td>{{ $staff->staff_firstname }} {{ $staff->staff_lastname }}</td>
                                    <td>{{ $staff->staff_role }}</td>
                                    <td>{{ $staff->staff_contact }}</td>
                                    <td>{{ $staff->staff_email }}</td>
                                    <td>{{ $staff->staff_status }}</td>
                                    <td>{{ $staff->created_at->format('d-m-Y H:i') }}</td>
                                    <td>{{ $staff->updated_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('staffs.edit', $staff->staff_id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ route('staffs.destroy', $staff->staff_id) }}" class="btn btn-danger">Deactivate</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection