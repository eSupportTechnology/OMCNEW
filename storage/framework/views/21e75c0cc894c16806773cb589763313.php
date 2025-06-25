<?php $__env->startSection('content'); ?>
<style>
   .btn-create {
        font-size: 0.8rem;
    }

    .form-group {
        margin-bottom: 1rem;
        display: flex;
         flex-direction: column;
    }

    .form-group label {
        font-weight: bold;
        display: block;
    }

    .form-control[readonly] {
        background-color: #e9ecef;
    }

    .card-body {
        padding: 1rem;
    }

    .card-container {
        display: flex;
        gap: 1rem;
    }

    .card-container .card {
        flex: 1;
    }

    .card-container .card:first-child {
        flex: 2;
    }

    .image-preview {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }

    .image-preview img {
        max-width: 100px;
        height: auto;
        border: 1px solid #ddd;
        padding: 5px;
    }

    .inventory-group {
        margin-bottom: 1rem;
        display: flex;
        flex-direction: column;
    }

    .drop-zone {
        border: 2px dashed #ddd;
        border-radius: 5px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        background-color: #f9f9f9;
    }

    .drop-zone p {
        margin: 0;
        color: #666;
    }

    .drop-zone img {
        position: relative;
    }

    .drop-zone .delete-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        border-radius: 50%;
        cursor: pointer;
    }
    .card1 {
    border: 1px solid #ddd;
    box-shadow: none;
}

    .remove-btn {
        border: 1px solid #b72626;
        color: #b72626;
        background-color: white;
        box-shadow: none;
    }


    .remove-btn:hover {
        background-color: #b72626;
        color: white;
    }

</style>



<main style="margin-top: 20px">
    <div class="container p-5">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="py-2 mb-0 ms-4">Edit Product</h4>
        </div>

        <div class="card-container px-4">
            <div class="card py-3 px-5">
                <div class="card-body">
                    <form id="productForm" action="<?php echo e(route('update_product', $product->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="productName">Product Name</label>
                                    <input type="text" id="productName" name="productName" class="form-control" placeholder="Enter product name" value="<?php echo e(old('productName', $product->product_name)); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="productDesc">Product Description</label>
                                    <div id="productDesc" style="height: 200px;"><?php echo old('productDesc', $product->product_description); ?></div>
                                    <textarea id="productDescInput" name="productDesc" style="display:none;"><?php echo e(old('productDesc', $product->product_description)); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="productImages">Product Images</label>
                                    <div id="dropZone" class="drop-zone">
                                        <p><i class="fas fa-images me-2"></i>Drag and drop images here or click to select</p>
                                        <input type="file" id="productImages" name="productImages[]" accept="image/*" multiple style="display: none;">
                                        <div class="image-preview" id="imagePreview">
                                            <?php if($product->images->isNotEmpty()): ?>
                                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="image-container" data-image-id="<?php echo e($image->id); ?>" style="position: relative; display: inline-block; margin-right: 10px;">
                                                        <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="Product Image" style="max-width: 100px;">
                                                        <button type="button" class="delete-btn" data-image-id="<?php echo e($image->id); ?>" style="position: absolute; top: 5px; right: 5px; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; text-align: center; line-height: 20px; cursor: pointer;">X</button>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <p>No images uploaded</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select id="category" name="category" class="form-control">
                                        <option value="">Select Category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $selectedCategoryId ? 'selected' : ''); ?>>
                                                <?php echo e($category->parent_category); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subcategory">Subcategory</label>
                                    <select id="subcategory" name="subcategory" class="form-control">
                                        <option value="">Select Subcategory</option>
                                        <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($subcategory->id); ?>" <?php echo e($subcategory->id == $selectedSubcategoryId ? 'selected' : ''); ?>>
                                                <?php echo e($subcategory->subcategory); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subsubcategory">Sub-Subcategory</label>
                                    <select id="subsubcategory" name="subsubcategory" class="form-control">
                                        <option value="">Select Sub-Subcategory</option>
                                        <?php $__currentLoopData = $subSubcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($subSubcategory->id); ?>" <?php echo e($subSubcategory->id == $product->sub_subcategory_id ? 'selected' : ''); ?>>
                                                <?php echo e($subSubcategory->sub_subcategory); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subsubcategory">Brand</label>
                                    <select name="brand_id" class="form-control" id="brandSelect">
                                        <option value="">Select a brand</option>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($brand->id); ?>"
                                            <?php echo e($brand->id == $product->brand_id ? 'selected' : ''); ?>><?php echo e($brand->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Total Quantity</label>
                                    <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Enter quantity" value="<?php echo e(old('quantity', $product->quantity)); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" id="tags" name="tags" class="form-control" placeholder="Enter tags separated by commas" value="<?php echo e(old('tags', $product->tags)); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="normalPrice">Normal Price</label>
                                    <input type="number" id="normalPrice" name="normalPrice" class="form-control" placeholder="Enter normal price" step="0.01" value="<?php echo e(old('normalPrice', $product->normal_price)); ?>">
                                </div>
                                <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" id="affiliateProduct" name="affiliateProduct" class="form-check-input" <?php echo e(old('affiliateProduct', $product->is_affiliate) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="affiliateProduct">Affiliate the Product</label>
                            </div>
                        </div>
                                <div class="form-group" id="affiliatePriceGroup" style="<?php echo e($product->is_affiliate ? 'display: flex;' : 'display: none;'); ?>">
                                    <label for="affiliatePrice">Affiliate Price</label>
                                    <input type="number" id="affiliatePrice" name="affiliatePrice" class="form-control" value="<?php echo e(old('affiliatePrice', $product->affiliate_price)); ?>" placeholder="Enter affiliate price" step="0.01">
                                </div>
                                <div class="form-group" id="commissionGroup" style="<?php echo e($product->is_affiliate ? 'display: flex;' : 'display: none;'); ?>">
                                    <label for="commissionPercentage">Commission %</label>
                                    <input type="number" id="commissionPercentage" name="commissionPercentage" class="form-control" value="<?php echo e(old('commissionPercentage', $product->commission_percentage)); ?>" placeholder="Enter commission percentage" step="0.01" min="0" max="100">
                                </div>
                                <div class="form-group">
                                    <label for="totalPrice">Total Price</label>
                                    <input type="text" id="totalPrice" name="totalPrice" class="form-control" value="<?php echo e(old('totalPrice', $product->total_price)); ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Product Variations Card -->
                        <div class="card1 px-2 py-2 mt-4">
                                <div class="card-body">
                                    <h5>Product Variations</h5>
                                    <div class="form-group">
                                        <label for="variations">Add Product Variations</label>
                                        <div id="variations-container">
                                            <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="variation-row row mb-3" data-index="<?php echo e($index); ?>">
                                                    <div class="col-md-3">
                                                        <select class="form-control variation-type" name="variation[<?php echo e($index); ?>][type]" onchange="handleVariationChange(this)">
                                                            <option value="Size" <?php echo e($variation->type === 'Size' ? 'selected' : ''); ?>>Size</option>
                                                            <option value="Color" <?php echo e($variation->type === 'Color' ? 'selected' : ''); ?>>Color</option>
                                                            <option value="Material" <?php echo e($variation->type === 'Material' ? 'selected' : ''); ?>>Material</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 variation-input-container">
                                                        <?php if($variation->type === 'Color'): ?>
                                                            <input type="color" class="form-control variation-input" name="variation[<?php echo e($index); ?>][value]" value="<?php echo e($variation->hex_value); ?>" onchange="updateHexValue(this)">
                                                            <input type="hidden" name="variation[<?php echo e($index); ?>][hex_value]" value="<?php echo e($variation->hex_value); ?>">
                                                        <?php else: ?>
                                                            <input type="text" class="form-control variation-input" name="variation[<?php echo e($index); ?>][value]" value="<?php echo e($variation->value); ?>" placeholder="Variation">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" class="form-control variation-input" name="variation[<?php echo e($index); ?>][quantity]" value="<?php echo e($variation->quantity); ?>" placeholder="Quantity">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn remove-btn" onclick="removeVariationRow(this)">X</button>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <button type="button" class="btn btn-secondary mt-3" id="addVariationBtn" style="width: 30%;">+ Add another variation</button>
                                    </div>
                                </div>
                            </div>

                        <button type="submit" class="btn btn-success btn-create mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>

    var quill = new Quill('#productDesc', {
        theme: 'snow',
        modules: {
            toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'image'],
                    ['clean']
                ]
        }
    });

    document.getElementById('productForm').onsubmit = function() {
        var description = quill.root.innerHTML;
        document.getElementById('productDescInput').value = description;
    };
</script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        const affiliateCheckbox = document.getElementById('affiliateProduct');
        const affiliatePriceGroup = document.getElementById('affiliatePriceGroup');
        const commissionGroup = document.getElementById('commissionGroup');
        const normalPriceInput = document.getElementById('normalPrice');
        const affiliatePriceInput = document.getElementById('affiliatePrice');
        const commissionPercentageInput = document.getElementById('commissionPercentage');
        const totalPriceInput = document.getElementById('totalPrice');

        affiliateCheckbox.addEventListener('change', function() {
            if (affiliateCheckbox.checked) {
                affiliatePriceGroup.style.display = 'flex';
                commissionGroup.style.display = 'flex';
            } else {
                affiliatePriceGroup.style.display = 'none';
                commissionGroup.style.display = 'none';
                affiliatePriceInput.value = '';
                commissionPercentageInput.value = '';
                updateTotalPrice();
            }
        });

        function updateTotalPrice() {
            let normalPrice = parseFloat(normalPriceInput.value) || 0;
            let affiliatePrice = parseFloat(affiliatePriceInput.value) || 0;
            let commissionPercentage = parseFloat(commissionPercentageInput.value) || 0;
            let totalPrice = normalPrice;

            if (affiliateCheckbox.checked) {
                totalPrice = affiliatePrice + (affiliatePrice * (commissionPercentage / 100));
            }

            totalPriceInput.value = totalPrice.toFixed(2);
        }

        normalPriceInput.addEventListener('input', updateTotalPrice);
        affiliatePriceInput.addEventListener('input', updateTotalPrice);
        commissionPercentageInput.addEventListener('input', updateTotalPrice);
    });



    //add images
    document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('productImages');
    const previewContainer = document.getElementById('imagePreview');

    dropZone.addEventListener('click', () => fileInput.click());

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.remove('dragover');
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        handleFiles(files);
    });

    function handleFiles(files) {
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';

                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = 'X';
                deleteBtn.className = 'delete-btn';
                deleteBtn.style.position = 'absolute';
                deleteBtn.style.top = '5px';
                deleteBtn.style.right = '5px';
                deleteBtn.style.color = 'white';
                deleteBtn.style.border = 'none';
                deleteBtn.style.borderRadius = '50%';
                deleteBtn.style.width = '20px';
                deleteBtn.style.height = '20px';
                deleteBtn.style.textAlign = 'center';
                deleteBtn.style.lineHeight = '20px';
                deleteBtn.style.cursor = 'pointer';
                deleteBtn.addEventListener('click', () => {
                    img.remove();
                    deleteBtn.remove();
                });

                const container = document.createElement('div');
                container.className = 'image-container';
                container.style.position = 'relative';
                container.style.display = 'inline-block';
                container.style.marginRight = '10px';
                container.appendChild(img);
                container.appendChild(deleteBtn);
                previewContainer.appendChild(container);
            };
            reader.readAsDataURL(file);
        });
    }

    previewContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn')) {
            const container = e.target.closest('.image-container');
            const imageId = container.dataset.imageId;

            if (imageId) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'deleteImages[]';
                hiddenInput.value = imageId;
                document.forms[0].appendChild(hiddenInput);
            }

            container.remove();
        }
    });
});

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category');
    const subcategorySelect = document.getElementById('subcategory');
    const subsubcategorySelect = document.getElementById('subsubcategory');

    function updateSubcategories(categoryId) {
        fetch(`/subcategories/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                data.subcategories.forEach(subcategory => {
                    subcategorySelect.innerHTML += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                });
                if (subcategorySelect.dataset.selected) {
                    updateSubSubcategories(subcategorySelect.dataset.selected);
                } else {
                    subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';
                }
            });
    }

    function updateSubSubcategories(subcategoryId) {
        fetch(`/sub-subcategories/${subcategoryId}`)
            .then(response => response.json())
            .then(data => {
                subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';
                data.sub_subcategories.forEach(subsubcategory => {
                    subsubcategorySelect.innerHTML += `<option value="${subsubcategory.id}">${subsubcategory.name}</option>`;
                });
            });
    }

    categorySelect.addEventListener('change', function () {
        const categoryId = this.value;
        if (categoryId) {
            updateSubcategories(categoryId);
        } else {
            subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
            subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';
        }
    });

    subcategorySelect.addEventListener('change', function () {
        const subcategoryId = this.value;
        if (subcategoryId) {
            updateSubSubcategories(subcategoryId);
        } else {
            subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';
        }
    });

    if (categorySelect.dataset.selected) {
        updateSubcategories(categorySelect.dataset.selected);
    }
    if (subcategorySelect.dataset.selected) {
        updateSubSubcategories(subcategorySelect.dataset.selected);
    }
});


</script>


<script>
let variationIndex = <?php echo e(count($variations)); ?>;

// Handle dynamic addition of variation rows
document.getElementById('addVariationBtn').addEventListener('click', function () {
    const container = document.getElementById('variations-container');
    const newRow = document.createElement('div');
    newRow.classList.add('variation-row', 'row', 'mb-3');
    newRow.setAttribute('data-index', variationIndex);

    newRow.innerHTML = `
        <div class="col-md-3">
            <select class="form-control variation-type" name="variation[${variationIndex}][type]" onchange="handleVariationChange(this)">
                <option value="Size">Size</option>
                <option value="Color">Color</option>
                <option value="Material">Material</option>
            </select>
        </div>
        <div class="col-md-4 variation-input-container">
            <input type="text" class="form-control variation-input" name="variation[${variationIndex}][value]" placeholder="Variation">
        </div>
        <div class="col-md-3">
            <input type="number" class="form-control" name="variation[${variationIndex}][quantity]" placeholder="Quantity" min="0" value="0">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn remove-btn" onclick="removeVariationRow(this)">X</button>
        </div>
    `;

    container.appendChild(newRow);
    variationIndex++;
});

function removeVariationRow(button) {
    const row = button.closest('.variation-row');
    row.remove();
}

function handleVariationChange(select) {
    const row = select.closest('.variation-row');
    const variationInputContainer = row.querySelector('.variation-input-container');

    // Check if the selected type is "Color"
    if (select.value === 'Color') {
        variationInputContainer.innerHTML = `<input type="color" class="form-control variation-input" name="${select.name.replace('type', 'value')}" onchange="updateHexValue(this)" value="#000000">`;
    } else {
        variationInputContainer.innerHTML = `<input type="text" class="form-control variation-input" name="${select.name.replace('type', 'value')}" placeholder="Variation">`;
    }
}

// Function to update the hex value when color changes
function updateHexValue(input) {
    const row = input.closest('.variation-row');
    const hexValueInput = document.createElement('input');
    hexValueInput.setAttribute('type', 'hidden');
    hexValueInput.setAttribute('name', input.name.replace('value', 'hex_value'));
    hexValueInput.setAttribute('value', input.value);
    row.appendChild(hexValueInput);
}



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/admin_dashboard/edit_products.blade.php ENDPATH**/ ?>