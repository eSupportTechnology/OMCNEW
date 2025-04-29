@extends('layouts.admin_main.master')

@section('content')

<style>
    .subcategory-item {
        cursor: pointer;
        list-style: none;
        margin-bottom: 10px;
    }
    .arrow-toggle {
        margin-right: 5px;
    }
    .subcategory-item .subsubcategory-list {
        padding-left: 20px;
    }
    .subcategory-item .fas.fa-chevron-down {
        transform: rotate(90deg);
    }
</style>

<main style="margin-top: 58px">
    <div class="container py-4 px-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Manage Categories</h3>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add New Category</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table category-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Subcategories</th>
                                <th style="width:20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->parent_category }}</td>
                                    <td>
                                        @if ($category->image)
                                        <img src="{{ asset('storage/category_images/' . basename($category->image)) }}" alt="Category Image" style="max-width: 70px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="subcategory-list">
                                            @foreach ($category->subcategories as $subcategory)
                                                <li class="subcategory-item">
                                                    <span class="arrow-toggle">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </span>
                                                    {{ $subcategory->subcategory }}
                                                    @if ($subcategory->subSubcategories->count() > 0)
                                                        <ul class="subsubcategory-list d-none">
                                                            @foreach ($subcategory->subSubcategories as $subsubcategory)
                                                                <li class="subsubcategory-item">- {{ $subsubcategory->sub_subcategory }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <div class="category-actions">
                                            <a href="{{ route('edit_category', $category->id ) }}" class="btn btn-sm btn-warning" >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger delete-category" data-id="{{ $category->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>







<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm" method="POST" action="{{ route('category_add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="parentCategory" class="form-label text-black">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="parentCategory" name="parent_category" placeholder="Enter category name" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryImage" class="form-label text-black">Category Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="categoryImage" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="subcategories" class="form-label text-black">Subcategories</label>
                        <button class="btn btn-primary mt-2 mb-2 sub-add-btn" type="button" id="addSubcategoryGroup"><i class="fas fa-plus"></i></button>
                        <div id="subcategories">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Edit Category Modal 
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="categoryName" class="form-label text-black">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" placeholder="Enter category name">
                    </div>
                    <div class="mb-3">
                        <label for="subcategories" class="form-label text-black">Subcategories</label>
                        <button class="btn btn-primary mt-2 mb-2 sub-add-btn" type="button" id="editSubcategoryGroup"><i class="fas fa-plus"></i></button>
                        <div id="subcategories">
                            <div class="subcategory-wrapper mb-3">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Enter subcategory name">
                                    <button class="btn btn-secondary edit-subsubcategory" type="button"><i class="fas fa-plus"></i></button>
                                    <button class="btn btn-danger delete-subcategory" type="button"><i class="fas fa-trash"></i></button>
                                </div>
                                <div class="sub-subcategories ms-4"></div>
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>-->



<script>
// add modal
document.addEventListener('DOMContentLoaded', function() {
    let subcategoryIndex = 0; 

    const addSubcategoryButton = document.getElementById('addSubcategoryGroup');
    const subcategoriesContainer = document.getElementById('subcategories');

    addSubcategoryButton.addEventListener('click', function() {
        const subcategoryWrapper = document.createElement('div');
        subcategoryWrapper.className = 'subcategory-wrapper mb-3';
        subcategoryWrapper.dataset.index = subcategoryIndex;

        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-3';

        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.name = `subcategories[${subcategoryIndex}][name]`; 
        input.placeholder = 'Enter subcategory name';

        const addSubSubcategoryButton = document.createElement('button');
        addSubSubcategoryButton.className = 'btn btn-secondary add-subsubcategory';
        addSubSubcategoryButton.type = 'button';
        addSubSubcategoryButton.innerHTML = '<i class="fas fa-plus"></i>';

        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-danger delete-subcategory';
        deleteButton.type = 'button';
        deleteButton.innerHTML = '<i class="fas fa-trash"></i>';

        inputGroup.appendChild(input);
        inputGroup.appendChild(addSubSubcategoryButton);
        inputGroup.appendChild(deleteButton);
        subcategoryWrapper.appendChild(inputGroup);

        const subSubcategoriesContainer = document.createElement('div');
        subSubcategoriesContainer.className = 'sub-subcategories ms-4';
        subcategoryWrapper.appendChild(subSubcategoriesContainer);

        subcategoriesContainer.appendChild(subcategoryWrapper);

        subcategoryIndex++; 

        addSubSubcategoryButton.addEventListener('click', function() {
            const subSubcategoryIndex = subSubcategoriesContainer.children.length;

            const subSubInputGroup = document.createElement('div');
            subSubInputGroup.className = 'input-group mb-3';

            const subSubInput = document.createElement('input');
            subSubInput.type = 'text';
            subSubInput.className = 'form-control';
            subSubInput.name = `subcategories[${subcategoryWrapper.dataset.index}][sub_subcategories][${subSubcategoryIndex}][name]`; 
            subSubInput.placeholder = 'Enter sub-subcategory name';

            const subSubDeleteButton = document.createElement('button');
            subSubDeleteButton.className = 'btn btn-danger';
            subSubDeleteButton.type = 'button';
            subSubDeleteButton.innerHTML = '<i class="fas fa-trash"></i>';

            subSubDeleteButton.addEventListener('click', function() {
                subSubInputGroup.remove();
            });

            subSubInputGroup.appendChild(subSubInput);
            subSubInputGroup.appendChild(subSubDeleteButton);
            subSubcategoriesContainer.appendChild(subSubInputGroup);
        });
    });

    subcategoriesContainer.addEventListener('click', function(e) {
        if (e.target.closest('.delete-subcategory')) {
            e.target.closest('.subcategory-wrapper').remove();
        }
    });
});


//delete the categories
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-category').forEach(function(button) {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                customClass: {
                    container: 'delete-confirm-modal' 
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/category/${categoryId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {                     
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status) {
                            Swal.fire(
                                'Deleted!',
                                'Category and its subcategories have been deleted.',
                                'success'
                            ).then(() => {
                                this.closest('tr').remove();
                            });
                        } else {
                            console.error('Server response does not indicate success:', data);
                            Swal.fire(
                                'Failed!',
                                data.message || 'Failed to delete the category.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the category.',
                            'error'
                        );
                    });
                }
            });
        });
    });
});


</script>



<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>

document.querySelectorAll('.arrow-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const subSubcategoryList = this.parentElement.querySelector('.subsubcategory-list');
            const icon = this.querySelector('.fas');
            if (subSubcategoryList) {
                subSubcategoryList.classList.toggle('d-none');
                icon.classList.toggle('fa-chevron-right');
                icon.classList.toggle('fa-chevron-down');
            }
        });
    });

    document.querySelectorAll('.subcategory-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.stopPropagation(); 
            item.classList.toggle('open');
        });
    });

</script>



@endsection