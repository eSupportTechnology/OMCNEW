@extends('member_dashboard.user_sidebar')

@section('dashboard-content')
<style>
    .details-container {
        background-color: #f4f6f8;
        padding: 20px;
        border-radius: 8px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 10px;
    }

    .return-info {
        flex: 1;
    }

    .return-info p {
        margin: 5px 0;
        color: #333;
    }

    .return-info a {
        color: #2979FF;
        text-decoration: none;
    }

    .return-info a:hover {
        text-decoration: underline;
    }

    .buttons {
        display: flex;
        gap: 10px;
        align-self: flex-start;
        margin-bottom: 5px;
    }

    button {
        padding: 10px 20px;
        background-color: orange;
        border: none;
        color: #fff;
        cursor: pointer;
        border-radius: 5px;
        font-weight: bold;
    }

    button.download-btn {
        background-color: #a9a9a9;
    }

    button:hover {
        background-color: #e69500;
    }

    button.download-btn:hover {
        background-color: #888;
    }

    .refund-info {
        flex-basis: 100%;
        text-align: right;
        font-size: 12px;
        color: #888;
        margin-top: -40px;
    }

    .progress-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 0 15px;
        gap: 10px;
    }

    .progressbar {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 40px 0;
    }

    .progressbar::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #ddd;
        transform: translateY(-50%);
        z-index: -1;
    }

    .progress {
        position: absolute;
        top: 50%;
        left: 0;
        height: 2px;
        background-color: green;
        transform: translateY(-50%);
        width: 0%;
        transition: width 0.3s ease;
    }

    .progress-step {
        width: 20px;
        height: 20px;
        background-color: #ddd;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .progress-step::before {
        content: attr(data-title);
        position: absolute;
        top: 35px;
        width: 120px;
        text-align: center;
        font-size: 9px;
        color: #333;
    }

    .progress-step-active {
        background-color: green;
    }

    @media screen and (max-width: 600px) {
        .progress-step::before {
            font-size: 8px;
            width: 90px;
        }

        .details-container {
            flex-direction: column;
        }

        .buttons {
            flex-direction: column;
        }
    }

    .notification {
        background-color: #f0f0f0;
        padding: 20px;
        margin: 15px auto;
        border-left: 4px solid #ccc;
        border-radius: 5px;
        width: 80%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .notification p {
        font-size: 11px;
        color: #333;
    }

    .review-product {
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 15px 0;
    }

    .review-product-info {
        flex-grow: 1;
    }
</style>

<h4 class="py-2 px-2">Return Details</h4>
<div class="details-container" id="print-section">
    <div class="return-info">
        <p>Returned on {{ $return->created_at->format('Y-m-d H:i:s') }}</p>
        <p>Order <a href="#">#{{ $return->order->order_code ?? 'N/A' }}</a></p>
        <p>RA Code: <span>{{ $return->ra_code ?? 'N/A' }}</span></p>
    </div>
    <div class="buttons">
        <button class="print-btn" onclick="printPage()">PRINT</button>
        <button class="download-btn" onclick="downloadPDF()">DOWNLOAD</button>
    </div>
    <div class="refund-info">
        <p>Refund via {{ ucfirst($return->refund_method ?? 'Points') }}</p>
    </div>
</div>

{{-- PROGRESS BAR --}}
<div class="progress-container">
    <div class="progressbar">
        <div class="progress" id="progress"></div>
        <div class="progress-step" data-title="1. Request Received"></div>
        <div class="progress-step" data-title="2. Pending Pick Up"></div>
        <div class="progress-step" data-title="3. In Transit"></div>
        <div class="progress-step" data-title="4. Package Received"></div>
        <div class="progress-step" data-title="5. Refund Processing"></div>
        <div class="progress-step" data-title="6. Refund Approved"></div>
    </div>
</div>

<div class="notification">
    <p><strong>{{ $return->created_at->format('Y-m-d H:i:s') }}</strong></p>
    <span>
        The courier will contact you to arrange pick-up within 5-7 working days.
        Please pack the return securely.
    </span>
</div>

@foreach($return->order->items as $item)
<div class="review-product">
    <div style="margin-right: 15px;">
        @if($item->product && $item->product->images->first())
        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" width="50" alt="Product">
        @else
        <img src="/assets/images/no-image.png" width="50" alt="No Image">
        @endif
    </div>
    <div class="review-product-info">
        <span style="font-weight: 600;">{{ $item->product->product_name ?? 'Product' }}</span>
        <div>
            <span>Color: {{ $item->color ?? '-' }}</span> |
            <span>Size: {{ $item->size ?? '-' }}</span> |
            <span>Qty: {{ $item->quantity ?? '-' }}</span>
        </div>
        <h6>Rs {{ $item->cost ?? 0 }}</h6>
    </div>
    <p><strong>Reason:</strong> {{ $return->reason ?? '-' }}</p>
</div>
@endforeach

<script>
    // Print function
    function printPage() {
        var printContents = document.getElementById('print-section').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    // Progress bar status mapping
    const status = "{{ $return->status }}";
    let stepIndex = 1;

    switch (status) {
        case "pending":
            stepIndex = 1;
            break;
        case "pickup":
            stepIndex = 2;
            break;
        case "in_transit":
            stepIndex = 3;
            break;
        case "received":
            stepIndex = 4;
            break;
        case "processing":
            stepIndex = 5;
            break;
        case "approved":
            stepIndex = 6;
            break;
        default:
            stepIndex = 1;
    }

    const progress = document.getElementById('progress');
    const steps = document.querySelectorAll('.progress-step');

    steps.forEach((step, idx) => {
        if (idx < stepIndex) {
            step.classList.add('progress-step-active');
        }
    });
    progress.style.width = ((stepIndex - 1) / (steps.length - 1)) * 100 + '%';
</script>

<!-- Include jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    async function downloadPDF() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();
        const fullText = document.getElementById("print-section").innerText;
        doc.text(fullText, 20, 30);
        doc.save("return-details.pdf");
    }
</script>
@endsection