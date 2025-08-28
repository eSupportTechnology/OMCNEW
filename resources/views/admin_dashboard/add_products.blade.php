@extends('layouts.admin_main.master')

@section('content')
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
        height: 250px;
        text-align: center;
        cursor: pointer;
        background-color: #f9f9f9;
        pointer-events: auto;
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

    #productImages {
        opacity: 0;
        width: 0;
        height: 0;
        position: absolute;
    }
</style>



<main style="margin-top: 20px">
    <div class="container p-5">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="py-2 mb-0 ms-4">Add Products</h4>
        </div>

        <div class="card-container px-4">
            <div class="card py-3 px-5">
                <div class="card-body">
                    <form id="productForm" action="{{ route('store_product') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="productName">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" id="productName" name="productName" class="form-control"
                                        placeholder="Enter product name" required>
                                </div>

                                <div class="form-group">
                                    <label for="productDesc">Product Description <span
                                            class="text-danger">*</span></label>
                                    <div id="productDesc" style="height: 200px;"></div>
                                    <textarea id="productDescInput" name="productDesc" style="display:none;"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="productImages">Product Images <span class="text-danger">*</span></label>
                                    <div id="dropZone" class="drop-zone">
                                        <p><i class="fas fa-images me-2"></i>Drag and drop images here or click to
                                            select</p>
                                        <input type="file" id="productImages" name="productImages[]" accept="image/*"
                                            multiple style="display: none;">
                                        <div class="image-preview" id="imagePreview"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category <span class="text-danger">*</span></label>
                                    <select id="category" name="category" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $selectedCategoryId ? 'selected' : '' }}>
                                            {{ $category->parent_category }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="subcategory">Subcategory</label>
                                    <select id="subcategory" name="subcategory" class="form-control">
                                        <option value="">Select Subcategory</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="subsubcategory">Sub-Subcategory</label>
                                    <select id="subsubcategory" name="subsubcategory" class="form-control">
                                        <option value="">Select Sub-Subcategory</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="subsubcategory">Brand</label>
                                    <select name="brand_id" class="form-control" id="brandSelect">
                                        <option value="">Select a brand</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="quantity">Total Quantity</label>
                                    <input type="number" id="quantity" name="quantity" class="form-control"
                                        placeholder="Enter quantity">
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" id="tags" name="tags" class="form-control"
                                        placeholder="Enter tags separated by commas ex: white, dress">
                                </div>

                                <div class="form-group">
                                    <label for="normalPrice">Normal Price <span class="text-danger">*</span></label>
                                    <input type="number" id="normalPrice" name="normalPrice" class="form-control"
                                        placeholder="Enter normal price" step="0.01" required>
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" id="affiliateProduct" name="affiliateProduct"
                                            class="form-check-input">
                                        <label class="form-check-label" for="affiliateProduct">Affiliate the
                                            Product</label>
                                    </div>
                                </div>

                                <div class="form-group" id="affiliatePriceGroup" style="display: none;">
                                    <label for="affiliatePrice">Affiliate Price</label>
                                    <input type="number" id="affiliatePrice" name="affiliatePrice"
                                        class="form-control" placeholder="Enter affiliate price" step="0.01">
                                </div>

                                <div class="form-group" id="commissionGroup" style="display: none;">
                                    <label for="commissionPercentage">Commission %</label>
                                    <input type="number" id="commissionPercentage" name="commissionPercentage"
                                        class="form-control" placeholder="Enter commission percentage" step="0.01"
                                        min="0" max="100">
                                </div>

                                <div class="form-group">
                                    <label for="totalPrice">Total Price</label>
                                    <input type="text" id="totalPrice" name="totalPrice" class="form-control"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card1 px-2 py-2 mt-4">
                                    <div class="card-body">
                                        <h5>Variations</h5>
                                        <div class="form-group">
                                            <label for="variations">Add Product Variations</label>
                                            <div id="variations-container">
                                                <div class="variation-row row mb-3" data-index="0">
                                                    <div class="col-md-3">
                                                        <select class="form-control variation-type"
                                                            name="variation[0][type]"
                                                            onchange="handleVariationChange(this)">
                                                            <option value="Size">Size</option>
                                                            <option value="Color">Color</option>
                                                            <option value="Material">Material</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 variation-input-container">
                                                        <input type="text" class="form-control variation-input"
                                                            name="variation[0][value]" placeholder="Variation">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" class="form-control"
                                                            name="variation[0][quantity]" placeholder="Quantity"
                                                            min="0" value="0">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn remove-btn"
                                                            onclick="removeVariationRow(this)">X</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary mt-3"
                                                id="addVariationBtn" style="width: 30%;">+ Add another
                                                variation</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card1 px-2 py-2 mt-4">
                                    <div class="card-body">
                                        <h5>Shipping Charges</h5>
                                        <div class="form-group">
                                            <label for="shipping_charges">Add Shipping Charges</label>
                                            <div id="shipping-charges-container">
                                                <div class="shipping-row row mb-3" data-index="0">
                                                    <div class="col-md-3">
                                                        <input type="number" class="form-control"
                                                            name="shipping[0][min_quantity]" placeholder="Min Qty"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" class="form-control"
                                                            name="shipping[0][max_quantity]" placeholder="Max Qty"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" class="form-control"
                                                            name="shipping[0][charge]" placeholder="Charge (LKR)"
                                                            step="0.01" required>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn remove-btn"
                                                            onclick="removeShippingRow(this)">X</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary mt-3" id="addShippingBtn"
                                                style="width: 30%;">+ Add another shipping charge</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-success btn-create mt-4">Add Product</button>
                            </div>
                        </div>
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
                [{
                    'header': [1, 2, false]
                }],
                ['bold', 'italic', 'underline'],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    quill.on('text-change', function() {
        var html = quill.root.innerHTML;
        $('#productDescInput').val(html);
    });
</script>


    <script>
document.addEventListener('DOMContentLoaded', function() {
    /** ---------------------------
     * Affiliate Price Logic
     * -------------------------- */
    const affiliateCheckbox = document.getElementById('affiliateProduct');
    const affiliatePriceGroup = document.getElementById('affiliatePriceGroup');
    const commissionGroup = document.getElementById('commissionGroup');
    const normalPriceInput = document.getElementById('normalPrice');
    const affiliatePriceInput = document.getElementById('affiliatePrice');
    const commissionPercentageInput = document.getElementById('commissionPercentage');
    const totalPriceInput = document.getElementById('totalPrice');

    if (affiliateCheckbox) {
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
    }

    function updateTotalPrice() {
        let normalPrice = parseFloat(normalPriceInput?.value) || 0;
        let affiliatePrice = parseFloat(affiliatePriceInput?.value) || 0;
        let commissionPercentage = parseFloat(commissionPercentageInput?.value) || 0;
        let totalPrice = normalPrice;

        if (affiliateCheckbox?.checked) {
            totalPrice = affiliatePrice + (affiliatePrice * (commissionPercentage / 100));
        }
        if (totalPriceInput) totalPriceInput.value = totalPrice.toFixed(2);
    }

    normalPriceInput?.addEventListener('input', updateTotalPrice);
    affiliatePriceInput?.addEventListener('input', updateTotalPrice);
    commissionPercentageInput?.addEventListener('input', updateTotalPrice);

    /** ---------------------------
     * Product Image Upload & Preview
     * -------------------------- */
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('productImages');
    const previewContainer = document.getElementById('imagePreview');
    let selectedFiles = [];

    dropZone?.addEventListener('click', () => fileInput.click());

    dropZone?.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone?.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });

    dropZone?.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        handleFiles(Array.from(e.dataTransfer.files));
    });

    fileInput?.addEventListener('change', (e) => {
        handleFiles(Array.from(e.target.files));
    });

    function handleFiles(files) {
        files.forEach(file => {
            if (!file.type.startsWith('image/')) return;

            // Avoid duplicates
            if (selectedFiles.some(f => f.name === file.name && f.size === file.size)) return;

            selectedFiles.push(file);

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;

                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = 'X';
                deleteBtn.className = 'delete-btn';
                deleteBtn.addEventListener('click', () => {
                    container.remove();
                    selectedFiles = selectedFiles.filter(f => f !== file);
                    updateFileInput();
                });

                const container = document.createElement('div');
                container.className = 'image-container';
                container.appendChild(img);
                container.appendChild(deleteBtn);

                previewContainer.appendChild(container);
            };
            reader.readAsDataURL(file);
        });

        updateFileInput();
    }

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }

    /** ---------------------------
     * Category / Subcategory Logic
     * -------------------------- */
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
                subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';
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

    categorySelect?.addEventListener('change', function() {
        const categoryId = this.value;
        if (categoryId) {
            updateSubcategories(categoryId);
        } else {
            subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
            subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';
        }
    });

    subcategorySelect?.addEventListener('change', function() {
        const subcategoryId = this.value;
        if (subcategoryId) {
            updateSubSubcategories(subcategoryId);
        } else {
            subsubcategorySelect.innerHTML = '<option value="">Select Sub-Subcategory</option>';
        }
    });

});
</script>



<script>
    let variationIndex = 1;

    // Handle dynamic addition of variation rows
    document.getElementById('addVariationBtn').addEventListener('click', function() {
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


    function handleVariationChange(selectElement) {
        const row = selectElement.closest('.variation-row');
        const inputContainer = row.querySelector('.variation-input-container');
        const inputElement = inputContainer.querySelector('.variation-input');

        if (selectElement.value === 'Color') {
            inputElement.type = 'color';
            inputElement.value = '#000000';
        } else {
            inputElement.type = 'text';
            inputElement.value = '';
        }
    }

    function removeVariationRow(button) {
        const row = button.closest('.variation-row');
        row.remove();
    }
</script>

<script>
    let shippingIndex = 1;

    document.getElementById('addShippingBtn').addEventListener('click', function() {
        const container = document.getElementById('shipping-charges-container');
        const newRow = document.createElement('div');
        newRow.classList.add('shipping-row', 'row', 'mb-3');
        newRow.setAttribute('data-index', shippingIndex);

        newRow.innerHTML = `
            <div class="col-md-3">
                <input type="number" class="form-control" name="shipping[${shippingIndex}][min_quantity]" placeholder="Min Qty" required>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control" name="shipping[${shippingIndex}][max_quantity]" placeholder="Max Qty" required>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control" name="shipping[${shippingIndex}][charge]" placeholder="Charge (LKR)" step="0.01" required>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn remove-btn" onclick="removeShippingRow(this)">X</button>
            </div>
        `;

        container.appendChild(newRow);
        shippingIndex++;
    });

    function removeShippingRow(button) {
        const row = button.closest('.shipping-row');
        row.remove();
    }
</script>
@endsection