// Category management JavaScript for the admin panel
$(document).ready(function () {
    // show the modal when the button is clicked
    $('#createCategoryBtn').on('click', function () {
        $('#createCategoryForm')[0].reset();
        $('#createCategoryModal').modal('show');
    });

    // submit the form via AJAX
    $('#createCategoryForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: window.storeCategoryUrl,           // set in the Blade view
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    $('#createCategoryModal').modal('hide');
                    $('#category-table').DataTable().ajax.reload(null, false);
                    // Show success toast notification
                       // Show a success toast
                     var toastEl = document.getElementById('categoryToast');
                      if (toastEl) {
                         var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                             }

                } else {
                    console.error('Error creating category');
                }
            },
            error: function (xhr) {
                console.error(xhr.responseJSON);
            }
        });
    });


// handle delete button clicks (delegate because buttons are dynamic)
     
          
     $(document).on('click', '.btn_delete_category', function (e) {
        e.preventDefault();
        const id = $(this).data('category-id');
        if (!id) return console.error('Missing category id');

        if (!confirm('Are you sure you want to delete this category?')) return;

        const deleteUrl = window.deleteCategoryBaseUrl + '/' + id;
        $.ajax({
            url: deleteUrl,
            type: 'POST',
            data: {
                _method: 'DELETE',
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (res) {
                if (res.success) {
                    // reload DataTable without full page reload
                    $('#category-table').DataTable().ajax.reload(null, false);
                    // update and show toast
                    const toastEl   = document.getElementById('categoryToast');
                    const toastBody = toastEl.querySelector('.toast-body');
                    toastBody.innerHTML = '<span class="me-2">✅</span> Category deleted successfully!';
                    new bootstrap.Toast(toastEl).show();
                } else {
                    console.error('Failed to delete category', res);
                }
            },
            error: function (xhr) {
                console.error('AJAX error during deletion:', xhr.responseText);
            }
        });
    });

});



// ======================================================================================








































// // Open Create modal
// $('#createBtn').on('click', function() {
//     $('#crudModalLabel').text('Add New Category');
//     $('#crudForm')[0].reset();
//     $('#categoryId').val('');
//     $('#saveBtn').text('Save');
//     $('#crudModal').modal('show');
// });

// // Open Edit modal
// $(document).on('click', '.edit-btn', function() {
//     var rowId = $(this).data('id');
//     $.ajax({
//         url: '/categories/' + rowId,
//         type: 'GET',
//         success: function(data) {
//             $('#crudModalLabel').text('Edit Category');
//             $('#categoryId').val(data.id);
//             $('#categoryName').val(data.name);
//             $('#categoryDescription').val(data.description);
//             $('#saveBtn').text('Update');
//             $('#crudModal').modal('show');
//         },
//         error: function() {
//             alert('Failed to fetch data');
//         }
//     });
// });

// // Handle form submission for Create or Edit
// $('#crudForm').on('submit', function(e) {
//     e.preventDefault();

//     var formData = {
//         name: $('#categoryName').val(),
//         description: $('#categoryDescription').val(),
//     };

//     var categoryId = $('#categoryId').val();

//     var url = categoryId ? '/categories/' + categoryId : '/categories';
//     var method = categoryId ? 'PUT' : 'POST';

//     $.ajax({
//         url: url,
//         type: method,
//         data: formData,
//         success: function(response) {
//             $('#crudModal').modal('hide');
//             $('#dataTable').DataTable().ajax.reload();
//             alert('Category saved successfully');
//         },
//         error: function(xhr, status, error) {
//             alert('Error: ' + xhr.responseText);
//         }
//     });
// });

// // Handle Delete action
// $(document).on('click', '.delete-btn', function() {
//     var rowId = $(this).data('id'); // Get the category ID
    
//     // Show the confirmation modal
//     $('#deleteConfirmationModal').modal('show');
    
//     // When the "Confirm Delete" button is clicked
//     $('#confirmDeleteButton').off('click').on('click', function() {
//         // Send the DELETE request
//         $.ajax({
//             url: '/categories/' + rowId,  // The route for deleting the category
//             type: 'DELETE',
//             data: {
//                 _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token
//             },
//             success: function(response) {
//                 // Reload the DataTable after successful deletion
//                 $('#category-table').DataTable().ajax.reload();
//                 // Show success toast notification
//               var toast = new bootstrap.Toast(document.getElementById('deleteToast'));
//                 toast.show();  // Show the toast
//             },
//             error: function(xhr, status, error) {
//                 // If an error occurs, show the error message
//                 alert('Error: ' + xhr.responseText);
//             },
//             complete: function() {
//                 // Close the modal
//                 $('#deleteConfirmationModal').modal('hide');
//             }
//         });
//     });
// });

// // Initialize DataTable
// $(document).ready(function() {
//     $('#dataTable').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: '/categories', // Fetch categories data
//         columns: [
//             { data: 'name' },
//             { data: 'description' },
//             { data: 'id', render: function(data, type, row) {
//                 return `
//                     <button class="btn btn-warning btn-sm edit-btn" data-id="${data}"><i class="fas fa-edit"></i> Edit</button>
//                     <button class="btn btn-danger btn-sm delete-btn" data-id="${data}"><i class="fas fa-trash-alt"></i> Delete</button>
//                 `;
//             }},
//         ]
//     });
// });

