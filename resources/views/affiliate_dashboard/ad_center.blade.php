@extends('layouts.affiliate_main.master')

@section('content')

<main style="margin-top: 58px">
    <div class="container pt-4 px-4">
        <h3 class="py-3">AD Center</h3>
        <ul class="nav nav-tabs mb-3" id="myTab0" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab0" data-bs-toggle="tab" data-bs-target="#hot_deals" type="button"
                    role="tab" aria-controls="hot_deals" aria-selected="true">
                    Hot Deals
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="commision-tab0" data-bs-toggle="tab" data-bs-target="#commision" type="button"
                    role="tab" aria-controls="commision" aria-selected="false">
                    Higher Commission
                </button>
            </li>
        </ul>

        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="myTabContent0">
                    <!-- Hot Deals -->
                    <div class="tab-pane fade show active" id="hot_deals" role="tabpanel" aria-labelledby="home-tab0">
                        <form id="hotDealsForm" method="GET" action="{{ route('ad_center') }}">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <select id="categoriesHotDeals" name="category" class="form-select" style="font-size: 0.8rem;">
                                        <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->parent_category }}" {{ request('category') == $category->parent_category ? 'selected' : '' }}>
                                                {{ $category->parent_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-1 mb-5">
                                    <label id="selectedCountLabel" style="font-size: 0.9rem;">
                                        Selected: <span id="selectedCount">0</span>
                                    </label>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button type="button" id="toggleSelectAll" class="btn btn-secondary btn-sm" style="font-size: 0.7rem;">
                                        Select All
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="container mt-6 mb-5">
                            <div class="row">
                                @foreach($hotDeals as $product)
                                    <div class="col-md-3 mb-7">
                                        <div class="deal-items">
                                            <input type="checkbox" class="select-item-checkbox" data-product-id="{{ $product->product_id }}" style="position: absolute; left: 12px;">
                                            <a href="#">
                                                @if($product->images->isNotEmpty())
                                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->product_name }}" class="img-fluid">
                                                @else
                                                    <img src="{{ asset('storage/default-image.png') }}" alt="Default Image" class="img-fluid">
                                                @endif
                                                <p>{{ $product->product_name }}</p>
                                                <div class="price mb-2">Rs.{{ $product->total_price }}</div>
                                                @php
                                                    $commissionPrice = $product->total_price - $product->affiliate_price;
                                                @endphp
                                                <div class="commission mb-2">
                                                    Est. Commission Rs. {{ $commissionPrice }} | {{ $product->commission_percentage }}%
                                                </div>
                                                <a href="#" class="btn btn-primary btn_promote" data-bs-toggle="modal" data-bs-target="#promoteModal-{{ $product->product_id }}">
                                                    Promote Now
                                                </a>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Promote Modal -->
                                    <div class="modal fade" id="promoteModal-{{ $product->product_id }}" tabindex="-1" aria-labelledby="promoteModalLabel-{{ $product->product_id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="promoteModalLabel-{{ $product->product_id }}">Promo Items for {{ $product->product_name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Product Images -->
                                                    @if($product->images->count() > 0)
                                                        <div class="d-flex mb-3">
                                                            <div class="me-3">
                                                                <p>Pictures:</p>
                                                            </div>
                                                            <div id="productImagesContainer-{{ $product->product_id }}" class="d-flex flex-wrap">
                                                                @foreach($product->images as $image)
                                                                    <div class="image-wrapper position-relative mb-2 me-2">
                                                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" class="img-fluid" width="100px" data-image-id="{{ $image->id }}" style="cursor: pointer;">
                                                                        <input type="checkbox" class="position-absolute top-0 start-0 m-2 image-checkbox" style="z-index: 1; display: none;">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <!-- Download Buttons -->
                                                        <div class="d-flex mb-3">
                                                            <button id="downloadAllBtn" class="btn btn-primary me-2">Download All Images</button>
                                                            <button id="downloadSelectedBtn" class="btn btn-secondary" disabled>Download Selected Images</button>
                                                        </div>
                                                    @else
                                                        <p>No images available for this product.</p>
                                                    @endif

                                                    <!-- Promo Link Section -->
                                                    <div class="mb-3">
                                                        <label for="promoLink-{{ $product->product_id }}" class="form-label">Product Link:</label>
                                                        <input type="text" id="promoLink-{{ $product->product_id }}" class="form-control" 
                                                            value="{{ url('product/' . $product->product_id) }}" readonly>
                                                        <button type="button" class="btn btn-secondary mt-2" onclick="copyLink('{{ $product->product_id }}')">Copy Link</button>
                                                    </div>

                                                    <!-- Promo Materials Section -->
                                                    <div class="mb-3">
                                                        <h5>Promo Materials</h5>
                                                        <p>Copy and share the promo materials below:</p>
                                                        <textarea id="promoMaterial-{{ $product->product_id }}" class="form-control" rows="5" readonly>
                                                            Product: {{ $product->product_name }}
                                                            Description: {{ $product->product_description }}
                                                            Original price: LKR {{ number_format($product->total_price, 2) }}
                                                        </textarea>
                                                        <button type="button" class="btn btn-primary mt-2" onclick="copyPromoMaterial('{{ $product->product_id }}')">Copy Promo Material</button>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Higher Commission -->
                    <div class="tab-pane fade" id="commision" role="tabpanel" aria-labelledby="commision-tab0">
                        <form id="highComForm" method="GET" action="{{ route('ad_center') }}#commision">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <select id="categoriesHighCom" name="category" class="form-select" style="font-size: 0.8rem;">
                                        <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->parent_category }}" {{ request('category') == $category->parent_category ? 'selected' : '' }}>
                                                {{ $category->parent_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-1 mb-3">
                                    <label id="selectedCountLabel" style="font-size: 0.9rem;">
                                        Selected: <span id="selectedCount2">0</span>
                                    </label>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button type="button" id="toggleSelectAll2" class="btn btn-secondary btn-sm" style="font-size: 0.7rem;">
                                        Select All
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            @foreach($highCom as $product)
                                <div class="col-md-3 mb-7">
                                    <div class="deal-items">
                                        <input type="checkbox" class="select-item-checkbox2" data-product-id="{{ $product->id }}" style="position: absolute; left: 12px;">
                                        <a href="#">
                                            @if($product->images->isNotEmpty())
                                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->product_name }}" class="img-fluid">
                                            @else
                                                <img src="{{ asset('storage/default-image.png') }}" alt="Default Image" class="img-fluid">
                                            @endif
                                            <p>{{ $product->product_name }}</p>
                                            <div class="price mb-2">Rs.{{ $product->total_price }}</div>
                                            @php
                                                $commissionPrice = $product->total_price - $product->affiliate_price;
                                            @endphp
                                            <div class="commission mb-2">
                                                Est. Commission Rs. {{ $commissionPrice }} | {{ $product->commission_percentage }}%
                                            </div>
                                            <a href="#" class="btn btn-primary btn_promote2" data-bs-toggle="modal" data-bs-target="#promoteModal2-{{ $product->id }}">
                                                Promote Now
                                            </a>
                                        </a>
                                    </div>
                                </div>

                                <!-- Higher Commission Promote Modal -->
                                <div class="modal fade" id="promoteModal2-{{ $product->id }}" tabindex="-1" aria-labelledby="promoteModalLabel2-{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="promoteModalLabel2-{{ $product->id }}">Promo Items for {{ $product->product_name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Product Images -->
                                                @if($product->images->count() > 0)
                                                    <div class="d-flex mb-3">
                                                        <div class="me-3">
                                                            <p>Pictures:</p>
                                                        </div>
                                                        <div id="productImagesContainer-{{ $product->product_id }}" class="d-flex flex-wrap">
                                                            @foreach($product->images as $image)
                                                                <div class="image-wrapper position-relative mb-2 me-2">
                                                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" class="img-fluid" width="100px" data-image-id="{{ $image->id }}" style="cursor: pointer;">
                                                                    <input type="checkbox" class="position-absolute top-0 start-0 m-2 image-checkbox" style="z-index: 1; display: none;">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <!-- Download Buttons -->
                                                    <div class="d-flex mb-3">
                                                        <button id="downloadAllBtn" class="btn btn-primary me-2">Download All Images</button>
                                                        <button id="downloadSelectedBtn" class="btn btn-secondary" disabled>Download Selected Images</button>
                                                    </div>
                                                @else
                                                    <p>No images available for this product.</p>
                                                @endif

                                                <!-- Promo Link Section -->
                                                <div class="mb-3">
                                                    <label for="promoLink-{{ $product->product_id }}" class="form-label">Product Link:</label>
                                                    <input type="text" id="promoLink-{{ $product->product_id }}" class="form-control" 
                                                        value="{{ url('product/' . $product->product_id) }}" readonly>
                                                    <button type="button" class="btn btn-secondary mt-2" onclick="copyLink('{{ $product->product_id }}')">Copy Link</button>
                                                </div>

                                                <!-- Promo Materials Section -->
                                                <div class="mb-3">
                                                    <h5>Promo Materials</h5>
                                                    <p>Copy and share the promo materials below:</p>
                                                    <textarea id="promoMaterial-{{ $product->product_id }}" class="form-control" rows="5" readonly>
                                                        Product: {{ $product->product_name }}
                                                        Description: {{ $product->product_description }}
                                                        Original price: LKR {{ number_format($product->total_price, 2) }}
                                                    </textarea>
                                                    <button type="button" class="btn btn-primary mt-2" onclick="copyPromoMaterial('{{ $product->product_id }}')">Copy Promo Material</button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>





<script>
    document.addEventListener('DOMContentLoaded', function() {
        var categorySelectHotDeals = document.getElementById('categoriesHotDeals');
        var categorySelectHighCom = document.getElementById('categoriesHighCom');

        categorySelectHotDeals.addEventListener('change', function() {
            document.getElementById('hotDealsForm').submit();
        });

        categorySelectHighCom.addEventListener('change', function() {
            document.getElementById('highComForm').submit();
        });
    });

    //Hot Deals selection
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.select-item-checkbox');
        const selectedCountLabel = document.getElementById('selectedCount');
        const toggleSelectAllButton = document.getElementById('toggleSelectAll');

        function updateSelectedCount() {
            const selectedCount = document.querySelectorAll('.select-item-checkbox:checked').length;
            selectedCountLabel.textContent = selectedCount;
        }

        toggleSelectAllButton.addEventListener('click', function () {
            const allSelected = [...checkboxes].every(checkbox => checkbox.checked);

            if (allSelected) {
                checkboxes.forEach(checkbox => checkbox.checked = false);
                toggleSelectAllButton.textContent = 'Select All';
            } else {
                checkboxes.forEach(checkbox => checkbox.checked = true);
                toggleSelectAllButton.textContent = 'Deselect All';
            }

            updateSelectedCount();
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });


    //Higher Commission selection
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.select-item-checkbox2');
        const selectedCountLabel = document.getElementById('selectedCount2');
        const toggleSelectAllButton = document.getElementById('toggleSelectAll2');

        function updateSelectedCount() {
            const selectedCount = document.querySelectorAll('.select-item-checkbox2:checked').length;
            selectedCountLabel.textContent = selectedCount;
        }

        toggleSelectAllButton.addEventListener('click', function () {
            const allSelected = [...checkboxes].every(checkbox => checkbox.checked);

            if (allSelected) {
                checkboxes.forEach(checkbox => checkbox.checked = false);
                toggleSelectAllButton.textContent = 'Select All';
            } else {
                checkboxes.forEach(checkbox => checkbox.checked = true);
                toggleSelectAllButton.textContent = 'Deselect All';
            }

            updateSelectedCount();
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });


//download images
document.addEventListener('DOMContentLoaded', function() {
    const imageWrappers = document.querySelectorAll('.image-wrapper');
    const downloadAllBtn = document.getElementById('downloadAllBtn');
    const downloadSelectedBtn = document.getElementById('downloadSelectedBtn');

    imageWrappers.forEach(wrapper => {
        const img = wrapper.querySelector('img');
        const checkbox = wrapper.querySelector('.image-checkbox');

        img.addEventListener('click', () => {
            checkbox.checked = !checkbox.checked;
            checkbox.style.display = checkbox.checked ? 'block' : 'none';
            updateDownloadSelectedBtn();
        });

        checkbox.addEventListener('change', () => {
            updateDownloadSelectedBtn();
        });
    });

    downloadAllBtn.addEventListener('click', () => {
        const allImageIds = Array.from(document.querySelectorAll('.image-wrapper img')).map(img => img.getAttribute('data-image-id'));
        downloadImages(allImageIds);
    });

    downloadSelectedBtn.addEventListener('click', () => {
        const selectedImageIds = Array.from(document.querySelectorAll('.image-checkbox:checked')).map(cb => cb.previousElementSibling.getAttribute('data-image-id'));
        if (selectedImageIds.length > 0) {
            downloadImages(selectedImageIds);
        }
    });

    function updateDownloadSelectedBtn() {
        const anyImageChecked = document.querySelector('.image-checkbox:checked') !== null;
        downloadSelectedBtn.disabled = !anyImageChecked;
    }

    function downloadImages(imageIds) {
        if (imageIds.length > 0) {
            window.location.href = `/affiliate/dashboard/ad_center/download-images?ids=${imageIds.join(',')}`;
        }
    }
});


//refreshing the tabs
    document.addEventListener('DOMContentLoaded', function() {
        var hash = window.location.hash;

        document.querySelectorAll('.nav-link').forEach(function(navLink) {
            navLink.classList.remove('active');
            navLink.setAttribute('aria-selected', 'false');
        });
        document.querySelectorAll('.tab-pane').forEach(function(tabPane) {
            tabPane.classList.remove('show', 'active');
        });

        if (hash) {
            var tabLink = document.querySelector('.nav-link[data-bs-target="' + hash + '"]');
            var tabPane = document.querySelector(hash);
            if (tabLink && tabPane) {
                tabLink.classList.add('active');
                tabLink.setAttribute('aria-selected', 'true');
                tabPane.classList.add('show', 'active');
            }
        } else {
            var defaultTab = document.querySelector('.nav-link[data-bs-target="#hot_deals"]');
            var defaultPane = document.querySelector('#hot_deals');
            if (defaultTab && defaultPane) {
                defaultTab.classList.add('active');
                defaultTab.setAttribute('aria-selected', 'true');
                defaultPane.classList.add('show', 'active');
            }
        }
    });
</script>

<script>
    function copyPromoMaterial(productId) {
        // Get the promo material textarea
        var promoMaterialTextarea = document.getElementById('promoMaterial-' + productId);

        // Select the text inside the textarea
        promoMaterialTextarea.select();
        promoMaterialTextarea.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text to the clipboard
        document.execCommand('copy');

        // Optionally, show an alert or notification
        alert('Promo material copied to clipboard!');
    }
</script>

<script>
    function copyPromoMaterial(productId) {
        // Get the promo material textarea
        var promoMaterialTextarea = document.getElementById('promoMaterial-' + productId);

        // Select the text inside the textarea
        promoMaterialTextarea.select();
        promoMaterialTextarea.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text to the clipboard
        document.execCommand('copy');

        // Optionally, show an alert or notification
        alert('Promo material copied to clipboard!');
    }
</script>

<script>
    function copyLink(productId) {
        const promoLink = document.getElementById(`promoLink-${productId}`);
        promoLink.select();
        document.execCommand("copy");
        alert("Product link copied to clipboard!");
    }

    function copyPromoMaterial(productId) {
        const promoMaterial = document.getElementById(`promoMaterial-${productId}`);
        promoMaterial.select();
        document.execCommand("copy");
        alert("Promo material copied to clipboard!");
    }
</script>


@endsection