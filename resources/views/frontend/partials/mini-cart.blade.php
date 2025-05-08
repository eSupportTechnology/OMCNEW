<div class="cart-scroll">
    @forelse($miniCart as $item)
        <div class="cart-product">
            <div class="main-pro-details">
                <div class="product-img">

                    <img src="{{ Storage::url($item['image']) }}" alt="product">

                </div>
                <div class="product-title">{{ Str::limit($item['name'], 10) }}</div>
                <div class="product-title">Qty: {{ $item['quantity'] }}</div>
                <div class="product-title">Rs. {{ $item['subtotal'] }}</div>
            </div>
        </div>
    @empty
        <div class="cart-product">
            <div class="main-pro-details">
                <div class="product-img">
                    <img src="https://buyabans.com/vendor/webkul/ui/assets/images/product/small-product-placeholder.png"
                        alt="product">
                </div>
                <div class="product-title">No Product Added</div>
            </div>
        </div>
    @endforelse
</div>
