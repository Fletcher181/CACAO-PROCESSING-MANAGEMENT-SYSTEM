<!-- Add Account Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- modal-lg for wider form -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAccountModalLabel">Add New Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('staffs.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <!-- Firstname -->
          <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="firstname" class="form-control"
                   value="{{ old('firstname') }}" required>
            @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
          </div>

          <!-- Lastname -->
          <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="lastname" class="form-control"
                   value="{{ old('lastname') }}" required>
            @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror
          </div>

          <!-- Contact -->
          <div class="mb-3">
            <label>Contact Number</label>
            <input type="text" name="contact" class="form-control"
                   value="{{ old('contact') }}" maxlength="11" pattern="\d{11}" required>
            @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
          </div>

          <!-- Status (hidden default) -->
          <input type="hidden" name="status" value="Active">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>
