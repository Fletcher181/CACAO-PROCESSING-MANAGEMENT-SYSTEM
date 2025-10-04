@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Account
                        <a href="{{ url('staffs') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('staffs.update', $staff->staff_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Firstname</label>
                            <input type="text" name="firstname" class="form-control"
                                   value="{{ old('firstname', $staff->staff_firstname) }}">
                            @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Lastname</label>
                            <input type="text" name="lastname" class="form-control"
                                   value="{{ old('lastname', $staff->staff_lastname) }}">
                            @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Role</label>
                            <input type="text" name="role" class="form-control"
                                   value="{{ old('role', $staff->staff_role) }}">
                            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Contact</label>
                            <input type="tel" name="contact" class="form-control"
                                   value="{{ old('contact', $staff->staff_contact) }}">
                            @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $staff->staff_email) }}">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="mb-3">
                            <label>New Password (optional)</label>
                            <input type="password" name="password" class="form-control">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
