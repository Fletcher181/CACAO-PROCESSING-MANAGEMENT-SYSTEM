@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fs-3">ACCOUNT MANAGEMENT</h4>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                        Add Account
                    </button>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fs-3">ACCOUNTS LIST</h4>
                    <!-- Search Bar -->
                    <form action="{{ route('staffs.index') }}" method="GET" class="mb-3 d-flex justify-content-end">
                        <div class="input-group w-50">
                            <input type="text" name="search" class="form-control" placeholder="Search accounts..."
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> {{-- Bootstrap search icon --}}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Add Account Modal -->
                <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAccountModalLabel">Add New Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form action="{{ route('staffs.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <input type="text" name="firstname" class="form-control"
                                            value="{{ old('firstname') }}" required>
                                        @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" name="lastname" class="form-control"
                                            value="{{ old('lastname') }}" required>
                                        @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Role</label>
                                        <input type="text" name="role" class="form-control"
                                            value="{{ old('role') }}" required>
                                        @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Contact Number</label>
                                        <input type="text" name="contact" class="form-control"
                                            value="{{ old('contact') }}" maxlength="11" pattern="\d{11}"
                                            title="Please enter exactly 11 digits" required>
                                        @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" required>
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>

                                    <input type="hidden" name="status" value="Active">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="card-body">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Staff ID</th>
                                <th>Fullname</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffs as $staff)
                            <tr>
                                <td>{{ $staff->staff_id }}</td>
                                <td>{{ $staff->staff_firstname }} {{ $staff->staff_lastname }}</td>
                                <td>{{ $staff->staff_role }}</td>
                                <td>                                            
                                    @if($staff->staff_status === 'Active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                <td>
                                    <!-- View Button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#viewModal{{ $staff->staff_id }}">
                                        View
                                    </button>
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $staff->staff_id }}">
                                        Edit
                                    </button>

                                    @if ($staff->staff_status === 'Active')
                                        <button type="button" class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmStatusModal"
                                            data-id="{{ $staff->staff_id }}"
                                            data-status="Inactive">
                                            Deactivate
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmStatusModal"
                                            data-id="{{ $staff->staff_id }}"
                                            data-status="Active">
                                            Activate
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $staff->staff_id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $staff->staff_id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="viewModalLabel{{ $staff->staff_id }}">Account Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-2"><strong>Staff ID:</strong> {{ $staff->staff_id }}</div>
                                            <div class="mb-2"><strong>Full Name:</strong> {{ $staff->staff_firstname }} {{ $staff->staff_lastname }}</div>
                                            <div class="mb-2"><strong>Role:</strong> {{ $staff->staff_role }}</div>
                                            <div class="mb-2"><strong>Contact:</strong> {{ $staff->staff_contact }}</div>
                                            <div class="mb-2"><strong>Email:</strong> {{ $staff->staff_email }}</div>
                                            <div class="mb-2"><strong>Status:</strong>
                                                @if($staff->staff_status === 'Active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </div>

                                            <hr>

                                            <div class="mb-2"><strong>Created At:</strong> {{ $staff->created_at->format('F d, Y h:i A') }}</div>
                                            <div class="mb-2"><strong>Updated At:</strong> {{ $staff->updated_at->format('F d, Y h:i A') }}</div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $staff->staff_id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $staff->staff_id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $staff->staff_id }}">Edit Account</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="{{ route('staffs.update', $staff->staff_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Firstname</label>
                                                    <input type="text" name="firstname" class="form-control"
                                                        value="{{ old('firstname', $staff->staff_firstname) }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Lastname</label>
                                                    <input type="text" name="lastname" class="form-control"
                                                        value="{{ old('lastname', $staff->staff_lastname) }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Role</label>
                                                    <input type="text" name="role" class="form-control"
                                                        value="{{ old('role', $staff->staff_role) }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Contact</label>
                                                    <input type="text" name="contact" class="form-control"
                                                        value="{{ old('contact', $staff->staff_contact) }}" maxlength="11"
                                                        pattern="\d{11}" title="Please enter exactly 11 digits" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ old('email', $staff->staff_email) }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>New Password (optional)</label>
                                                    <input type="password" name="password" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label>Confirm New Password</label>
                                                    <input type="password" name="password_confirmation" class="form-control">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-warning">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Confirm Activate/Deactivate Modal -->
                            <div class="modal fade" id="confirmStatusModal" tabindex="-1" aria-labelledby="confirmStatusLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header" id="statusModalHeader">
                                            <h5 class="modal-title" id="confirmStatusLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body" id="statusModalBody">
                                            <!-- Text is filled by script -->
                                        </div>
                                        <div class="modal-footer">
                                            <form id="statusForm" method="POST" action="">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" id="statusInput">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn" id="statusSubmitBtn"></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{$staffs->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {{-- Reopen Add Account Modal if validation fails --}}
    @if ($errors->any())
        <script>
            window.addEventListener('load', () => {
                const modal = new bootstrap.Modal(document.getElementById('addAccountModal'));
                modal.show();
            });
        </script>
    @endif

    {{-- Confirm Activate/Deactivate Modal Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusModal = document.getElementById('confirmStatusModal');
            statusModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const staffId = button.getAttribute('data-id');
                const newStatus = button.getAttribute('data-status');

                const modalTitle = document.getElementById('confirmStatusLabel');
                const modalBody = document.getElementById('statusModalBody');
                const submitBtn = document.getElementById('statusSubmitBtn');
                const modalHeader = document.getElementById('statusModalHeader');
                const statusInput = document.getElementById('statusInput');
                const form = document.getElementById('statusForm');

                // Set form action and hidden input
                form.action = `/staffs/${staffId}/status`;
                statusInput.value = newStatus;

                // Update modal text and style
                if (newStatus === 'Inactive') {
                    modalTitle.textContent = 'Confirm Deactivation';
                    modalBody.textContent = 'Are you sure you want to deactivate this account?';
                    modalHeader.className = 'modal-header bg-danger text-white';
                    submitBtn.className = 'btn btn-danger';
                    submitBtn.textContent = 'Yes, Deactivate';
                } else {
                    modalTitle.textContent = 'Confirm Activation';
                    modalBody.textContent = 'Are you sure you want to activate this account?';
                    modalHeader.className = 'modal-header bg-success text-white';
                    submitBtn.className = 'btn btn-success';
                    submitBtn.textContent = 'Yes, Activate';
                }
            });
        });
    </script>

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 2000);
    </script>
@endsection
