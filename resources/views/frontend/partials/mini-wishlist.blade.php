<div class="cart-scroll">
    @forelse($miniWishlist as $item)
    <div class="cart-product d-flex align-items-center mb-3">
        <!-- Product image -->
        <div class="product-img me-3">
            <img src="{{ $item['image'] ? Storage::url($item['image']) : 'https://buyabans.com/vendor/webkul/ui/assets/images/product/small-product-placeholder.png' }}"
                alt="product" class="img-fluid" style="width:60px; height:60px; object-fit:cover; border-radius:5px;">
        </div>

        <!-- Product details -->
        <div class="product-details flex-grow-1">
            <div class="product-title mb-1" style="font-size:14px; font-weight:500;">{{ Str::limit($item['name'], 25) }}</div>
            <div class="product-price mb-1" style="font-size:13px; color:#333;">Rs. {{ $item['price'] }}</div>
            <!-- View product button -->
            <a href="{{ route('product-description', $item['product_id']) }}" class="btn btn-sm btn-primary">View Product</a>
        </div>

        <!-- Remove from wishlist -->
        <div class="product-remove ms-2">
            <form action="{{ route('wishlist.remove', $item['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to remove this product from your wishlist?');">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;">
                    <i class="fa fa-trash" style="color:red; font-size:16px;"></i>
                </button>
            </form>
        </div>

    </div>
    @empty
    <div class="cart-product d-flex align-items-center mb-3">
        <div class="product-img me-3">
            <img src="https://buyabans.com/vendor/webkul/ui/assets/images/product/small-product-placeholder.png"
                alt="product" class="img-fluid" style="width:60px; height:60px; object-fit:cover; border-radius:5px;">
        </div>
        <div class="product-title" style="font-size:14px;">No Product in Wishlist</div>
    </div>
    @endforelse
</div>