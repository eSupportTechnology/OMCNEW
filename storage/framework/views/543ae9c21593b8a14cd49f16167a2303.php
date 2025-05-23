<?php $__env->startSection('content'); ?>

<style>
  
</style>

<main style="margin-top: 58px">
    <div class="container py-4 px-4">
    <div class="d-flex justify-content-between align-items-center">
            <h4 class="py-2 mb-0 ms-4">Edit Categories</h4>
        </div>
        <div class="card-container px-4">
            <div class="card py-3 px-5">
                <div class="card-body">
                    <form action="<?php echo e(route('update_category', $category->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label for="categoryName" class="form-label text-black">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="parent_category" value="<?php echo e(old('parent_category', $category->parent_category)); ?>" placeholder="Enter category name">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label text-black">Category Image</label>
                            <?php if($category->image): ?>
                                <div>
                                    <img src="<?php echo e(asset('storage/category_images/' . $category->image)); ?>" alt="Category Image" width="150">
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="mb-3">
                            <label for="subcategories" class="form-label text-black">Subcategories</label>
                            <button class="btn btn-primary mt-2 mb-2 sub-add-btn" type="button" id="addSubcategoryGroup"><i class="fas fa-plus"></i></button>
                            <div id="subcategories">
                                <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="subcategory-wrapper mb-3" data-index="<?php echo e($loop->index); ?>">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="subcategories[<?php echo e($loop->index); ?>][name]" value="<?php echo e(old('subcategories.' . $loop->index . '.name', $subcategory->subcategory)); ?>" placeholder="Enter subcategory name">
                                            <button class="btn btn-secondary add-subsubcategory" type="button"><i class="fas fa-plus"></i></button>
                                            <button class="btn btn-danger delete-subcategory" type="button"><i class="fas fa-trash"></i></button>
                                        </div>
                                        <div class="sub-subcategories ms-4">
                                            <?php $__currentLoopData = $subSubcategories[$subcategory->id] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="subcategories[<?php echo e($loop->parent->index); ?>][sub_subcategories][<?php echo e($loop->index); ?>][name]" value="<?php echo e(old('subcategories.' . $loop->parent->index . '.sub_subcategories.' . $loop->index . '.name', $subSubcategory->sub_subcategory)); ?>" placeholder="Enter sub-subcategory name">
                                                    <button class="btn btn-danger delete-sub-subcategory" type="button"><i class="fas fa-trash"></i></button>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let subcategoryIndex = document.querySelectorAll('.subcategory-wrapper').length;

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
    });

    // Delegated event handling for adding sub-subcategories
    subcategoriesContainer.addEventListener('click', function(e) {
        if (e.target.closest('.add-subsubcategory')) {
            const subcategoryWrapper = e.target.closest('.subcategory-wrapper');
            const subSubcategoriesContainer = subcategoryWrapper.querySelector('.sub-subcategories');
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
        }

        // Delegated event handling for deleting subcategories
        if (e.target.closest('.delete-subcategory')) {
            e.target.closest('.subcategory-wrapper').remove();
        }

        // Delegated event handling for deleting sub-subcategories
        if (e.target.closest('.delete-sub-subcategory')) {
            e.target.closest('.input-group').remove();
        }
    });
});


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/edit_category.blade.php ENDPATH**/ ?>