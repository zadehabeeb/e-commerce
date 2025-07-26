<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1"
     aria-labelledby="createCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCategoryModalLabel">Add New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="createCategoryForm" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
          <div class="mb-3">
            <label for="category-name" class="form-label">Name</label>
            <input type="text" class="form-control" id="category-name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="category-slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="category-slug" name="slug" required>
          </div>
          <div class="mb-3">
            <label for="category-description" class="form-label">Description</label>
            <textarea class="form-control" id="category-description" name="description"></textarea>
          </div>
          <!-- add file, is_active, sort_order, meta_title, meta_description fields as needed -->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Toast container for success messages add category -->
<div class="toast-container position-fixed top-50 start-50 translate-middle p-3" style="z-index: 1100;">
  <div id="categoryToast"
       class="toast align-items-center border-0"
       role="alert"
       aria-live="assertive"
       aria-atomic="true"
       style="background-color:#d4edda; color:#155724;">
    <div class="d-flex">
      <div class="toast-body">
        <span class="me-2">✅</span> New category added successfully!
      </div>
      <button type="button" class="btn-close me-2 m-auto"
              data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>