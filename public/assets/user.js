// add class to header row
$(function () {
    $('#user-table thead tr').addClass('bg-header-row');
});

// store user
$(function () {
    $(document).on('click', '#store-user-btn', function () {
        const formData = new FormData($('#createUserForm')[0]);
        $.ajax({
            url: `/admin/users`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                showSuccessAlert(res);
                $('#createUserModal').modal('hide');
                $('#user-table').DataTable().ajax.reload();
            },
            error: function (err) {
                showErrorAlert(err);
            }
        });
    });
});

// edit user
$(function () {
    $(document).on('click', '.edit-user-btn', function () {
        const userId = $(this).data('id');
        $.ajax({
            url: `/admin/users/${userId}/edit`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            success: function (res) {
                formFilling(res);
                $('#update-user-btn').data('id', userId);
            },
            error: function (err) {
                showErrorAlert(err);
            }
        });
    });
});

// update user
$(function () {
    $(document).on('click', '#update-user-btn', function () {
        const userId = $(this).data('id');
        const formData = new FormData($('#editUserForm')[0]);
        $.ajax({
            url: `/admin/users/${userId}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                showSuccessAlert(res);
                $('#editUserModal').modal('hide');
                $('#user-table').DataTable().ajax.reload();
            },
            error: function (err) {
                showErrorAlert(err);
            }
        });
    });
});

// delete user
$(function () {
    $(document).on('click', '.delete-user-btn', function () {
        const btn = $(this);
        confirmDelete().then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/users/${btn.data('id')}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'DELETE',
                    success: function (res) {
                        showSuccessAlert(res);
                        btn.closest('tr').fadeOut(1000, function () {
                            $(this).remove();
                        });
                    },
                    error: function (err) {
                        showErrorAlert(err);
                    }
                });
            }
        });
    });
});

// helper functions (same as category.js)
function showSuccessAlert(res) {
    Swal.fire({
        icon: 'success',
        title: res.title,
        text: res.message,
        toast: true,
        position: 'top-end',
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: true,
    });
}

function showErrorAlert(err) {
    Swal.fire({
        icon: 'error',
        title: err.responseJSON?.title,
        text: err.responseJSON?.message || 'Something went wrong',
        toast: true,
        position: 'top-end',
        timer: 5000,
        showConfirmButton: false,
        timerProgressBar: true,
    });
}

function confirmDelete() {
    return Swal.fire({
        title: 'Are you sure you want to delete this user?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
    });
}

function formFilling(res) {
    $('#editUserForm input[name="name"]').val(res.user.name);
    $('#editUserForm input[name="email"]').val(res.user.email);
    $('#editUserForm input[name="phone"]').val(res.user.phone);
    $('#editUserForm textarea[name="address"]').val(res.user.address);
    $('#editUserForm input[name="city"]').val(res.user.city);
    $('#editUserForm input[name="postal_code"]').val(res.user.postal_code);
    $('#editUserForm input[name="country"]').val(res.user.country);
    $('#editUserForm input[name="avatar"]').val(res.user.avatar);
    $('#editUserForm input[name="is_active"]').prop('checked', res.user.is_active);
}
