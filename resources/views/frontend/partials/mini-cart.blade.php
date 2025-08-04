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
                <div class="product-title btn-delete-item remove">
                    <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                            <i class="fa fa-trash" style="color: red;"></i>
                        </button>
                    </form>
                </div>

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
