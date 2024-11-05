{{-- Edit --}}
<div class="modal fade" id="edit-category-{{ $category->id }}" >
  <div class="modal-dialog">

      <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="modal-content border-warning">
          <div class="modal-header border-warning">
            <h3 class="h5 modal-title border-warning">
              <i class="fa-regular fa-pen-to-square ms-2 text-warning"></i> Edit Category
            </h3>
          </div>
          <div class="modal-body">
            <input type="text" name="new_name" id="" class="form-control" placeholder="Category name" value="{{ $category->name }}">
          </div> 
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning btn-sm" data-bs-dismiss="modal">Update</button>
          </div> 
        </div>
      </form>
  </div>
</div>

{{-- Delete --}}
<div class="modal fade" id="delete-category-{{ $category->id }}" >
  <div class="modal-dialog">

      <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
        @csrf
        @method('DELETE')
        <div class="modal-content border-danger">
          <div class="modal-header border-danger ">
            <h3 class="h5 modal-title border-danger text-muted">
              <i class="fa-regular fa-trash-can ms-2 text-danger"></i> Delete Category
            </h3>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete <span class="fw-bold">{{ $category->name }} </span>?</p>
            <br>
            <p>This action will affect all the post under this category. Posts without a category will fall under uncategorized.</p>
          </div> 
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Delete</button>
          </div> 
        </div>
      </form>
  </div>
</div>