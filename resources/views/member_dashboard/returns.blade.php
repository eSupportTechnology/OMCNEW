@extends('member_dashboard.user_sidebar')

@section('dashboard-content')

<style>
    .returns-container {
        background-color: #f4f6f8;
        padding: 20px;
        border-radius: 8px;
        width: 100%;
    }

    .return-item {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #e1e1e1;
        border-radius: 8px;
        margin-top: 20px;
    }

    .return-header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .return-header p {
        margin: 0;
        font-size: 14px;
        color: #555;
    }

    .return-location {
        font-weight: bold;
        color: #333;
        margin-left: 90px;
    }

    .more-details-link {
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
    }

    .order-link {
        color: #007bff;
        text-decoration: none;
    }

    /* Updated review-product section for responsive design */
    .review-product {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
        /* Ensure wrapping on smaller screens */
    }

    .review-product img {
        width: 100%;
        max-width: 70px;
        /* Ensure responsive image size */
        height: auto;
    }

    .review-product-info {
        flex-grow: 1;
        font-size: 13px;
    }

    .review-product-info span {
        font-weight: 600;
    }

    .refund-status {
        margin-left: 20px;
        flex-shrink: 0;
        /* Prevent refund status from shrinking */
    }

    .refund-approved {
        background-color: #f0f5f5;
        color: #333;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 12px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .return-header {
            flex-direction: column;
            /* Stack elements vertically on smaller screens */
            align-items: flex-start;
        }

        .return-location {
            margin-left: 0;
            margin-top: 10px;
        }

        .review-product {
            flex-direction: column;
            /* Stack product details vertically on smaller screens */
            align-items: flex-start;
        }

        .refund-status {
            margin-left: 0;
            margin-top: 10px;
            /* Add space between product details and refund status on small screens */
        }
    }

    @media (max-width: 480px) {
        .review-product img {
            max-width: 50px;
            /* Make the image smaller on very small screens */
        }

        .review-product-info {
            font-size: 12px;
            /* Adjust text size for smaller screens */
        }

        .refund-approved {
            font-size: 11px;
            /* Adjust refund status font size for smaller screens */
        }
    }
</style>
<div class="returns-container">
    <h2>My Returns</h2>

    @forelse($returns as $return)
    <div class="return-item">
        <div class="return-header">
            <div class="return-info">
                <p>
                    Returned on {{ $return->created_at->format('Y-m-d H:i:s') }}
                    <span class="return-location">Return to OMC</span>
                </p>
                <p>
                    Order
                    <a href="#" class="order-link">#{{ $return->order->order_code ?? 'N/A' }}</a>
                </p>
            </div>
            <div class="more-details">
                <a href="{{ route('returns.details', $return->id) }}" class="more-details-link">MORE DETAILS</a>
            </div>
        </div>

        @foreach($return->order->items as $item)
        <div class="review-product">
            <div class="col-md-1 d-flex align-items-center">
                <div style="margin-right: 15px;">
                    <a href="#">
                        @if($item->product && $item->product->images->first())
                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="Product Image">
                        @else
                        <img src="/assets/images/no-image.png" alt="No Image">
                        @endif

                    </a>
                </div>
            </div>

            <div class="col-md-3 d-flex flex-column justify-content-center review-product-info">
                <span>{{ $item->product->product_name ?? 'Product' }}</span>
                <div>
                    <span class="me-2">Color: <span>{{ $item->color ?? '-' }}</span></span> |
                    <span class="me-2 ms-2">Size: <span>{{ $item->size ?? '-' }}</span></span> |
                    <span class="ms-2">Qty: <span>{{ $item->quantity ?? '-' }}</span></span>
                </div>
                <h6 class="mt-2" style="font-size: 13px;font-weight: bold;">
                    Rs {{ $item->cost ?? '0' }}
                </h6>
            </div>

            <div class="refund-status">
                @if($return->status === 'approved')
                <span class="refund-approved">Your refund has been approved</span>
                @elseif($return->status === 'pending')
                <span class="refund-approved" style="background:#fff3cd; color:#856404;">Pending Review</span>
                @else
                <span class="refund-approved" style="background:#f8d7da; color:#721c24;">Rejected</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @empty
    <p>You have no return requests yet.</p>
    @endforelse
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const today = new Date();
        const formatted = today.toISOString().split('T')[0]; // YYYY-MM-DD
        const time = today.toTimeString().split(' ')[0]; // HH:MM:SS
        document.getElementById("return-date").textContent = `${formatted} ${time}`;
    });
</script>

@endsection