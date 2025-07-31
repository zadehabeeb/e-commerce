<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;">
        <div class="modal-content" style="width:50rem">
            <div class="modal-header">
                <h5 class="modal-title">Create User Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-9 mx-auto" style="width: 100%">
                        <div class="card">
                            <div class="card-body">
                                <form id="createUserForm" method="POST">
                                    @csrf
                                    <label class="mb-2">Name <span class="text-danger">*</span></label>
                                    <input class="form-control mb-3" type="text" name="name" required>

                                    <label class="mb-2">Email <span class="text-danger">*</span></label>
                                    <input class="form-control mb-3" type="email" name="email" required>

                                    <label class="mb-2">Password <span class="text-danger">*</span></label>
                                    <input class="form-control mb-3" type="password" name="password" required>

                                    <label class="mb-2">Phone</label>
                                    <input class="form-control mb-3" type="text" name="phone">

                                    <label class="mb-2">Address</label>
                                    <textarea class="form-control mb-3" name="address" rows="3"></textarea>

                                    <label class="mb-2">City</label>
                                    <input class="form-control mb-3" type="text" name="city">

                                    <label class="mb-2">Postal Code</label>
                                    <input class="form-control mb-3" type="text" name="postal_code">

                                    <label class="mb-2">Country</label>
                                    <input class="form-control mb-3" type="text" name="country">

                                    <label class="mb-2">Avatar</label>
                                    <input class="form-control mb-3" type="text" name="avatar">

                                    <label class="mb-2">Active</label>
                                    <input type="checkbox" name="is_active" value="1" checked>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button id="store-user-btn" type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
