@extends('layouts.affiliate_main.master')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .dt-icon-div {
          font-size: 10px !important;
          border-radius: 50% !important;
          position: absolute;
          top: -27px;
          left: -40px;
        }
        .span-cart {
          width: 36px !important;
          position: absolute;
          top: -25px;
          left: -10px;
        }

        </style>
    <div class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <div class="flex flex-col items-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Checkout Payment</h2>
                <ul class="flex text-sm">
                    <li class="flex items-center">
                        <a href="/affiliate/dashboard" class="text-blue-600 hover:text-blue-800">Home</a>
                        <span class="mx-2">/</span>
                    </li>
                    <li class="text-gray-600">Payment</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Alert Message -->
        <div id="successAlert"
            class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            <span class="block sm:inline">Payment successful!</span>
            <button type="button" class="absolute top-0 right-0 px-4 py-3"
                onclick="document.getElementById('successAlert').classList.add('hidden')">
                <span class="text-xl">&times;</span>
            </button>
        </div>

        <!-- Checkout Wrapper -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Payment Methods -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded shadow-md overflow-hidden">
                    <div class="border-b px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-800">Select Payment Method</h3>
                    </div>
                    <div class="p-6">
                        <!-- Payment Tabs -->
                        <div class="mb-6">
                            <ul class="flex flex-wrap gap-4" id="paymentTabs">
                                <li class="flex-1 min-w-[140px]">
                                    <button id="creditCardTab"
                                        class="w-full bg-blue-50 border border-blue-600 text-blue-600 p-4 rounded flex flex-col items-center justify-center transition-all hover:shadow-md active">
                                        <i class="fa fa-credit-card text-2xl mb-2"></i>
                                        <span>Credit/Debit Card</span>
                                    </button>
                                </li>

                                <li class="flex-1 min-w-[140px]">
                                    <button id="codTab"
                                        class="w-full bg-white border border-gray-300 text-gray-600 p-4 rounded flex flex-col items-center justify-center transition-all hover:shadow-md hover:bg-gray-50">
                                        <i class="fa fa-money-bill-wave text-2xl mb-2"></i>
                                        <span>Cash on Delivery</span>
                                    </button>
                                </li>

                            </ul>
                        </div>

                        <!-- Tab Content -->
                        <div class="bg-white rounded p-4 md:p-6 border border-gray-200">
                            <!-- Credit Card Form -->
                            <div id="creditCardContent" class="w-full md:w-2/3">
                                {{-- <form id="cardPaymentForm"> --}}
                                    <form id="cardPaymentForm" action="{{ route('confirm.card.order', $order_code) }}" method="POST">
                                        @csrf
                                        <div class="mt-6">
                                            <button type="submit"
                                                class="w-full bg-blue-600 text-white py-3 px-4 rounded font-medium hover:bg-blue-700 transition-colors">
                                                Pay with Card via OnePay
                                            </button>
                                        </div>
                                    </form>

                            </div>

                            <!-- Cash on Delivery Content -->
                            <div id="codContent" class="hidden">
                                <div class="bg-blue-50 border border-blue-100 p-4 rounded mb-6">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                                        <h6 class="font-semibold text-gray-800">Cash on Delivery Information</h6>
                                    </div>
                                    <ul class="pl-5 space-y-2">
                                        <li class="text-gray-600">Pay in cash to our courier upon receiving your parcel</li>
                                        <li class="text-gray-600">Check your delivery status is updated to 'Out for
                                            Delivery' before accepting</li>
                                        <li class="text-gray-600">Keep the exact amount ready to ensure smooth delivery</li>
                                    </ul>
                                </div>
                                {{-- <form id="codForm"> --}}
                                    <form action="{{ route('order.confirm.cod', $order_code) }}" method="POST">
                                        @csrf
                                    <button type="submit"
                                        class="bg-blue-600 text-white py-3 px-6 rounded font-medium hover:bg-blue-700 transition-colors">
                                        Confirm Order with Cash on Delivery
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded shadow-md overflow-hidden">
                    <div class="border-b px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-800">Order Summary</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between text-gray-600 mb-3">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 mb-4">
                            <span>Delivery Fee</span>
                            <span>Rs. {{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4 mb-6">
                            <div class="flex justify-between font-semibold">
                                <span class="text-gray-800">Total Amount</span>
                                <span class="text-gray-800">Rs. {{ number_format($total, 2) }}</span>
                            </div>
                        </div>


                        <div class="bg-gray-50 p-4 rounded">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-shield-alt text-blue-600 mr-2"></i>
                                <h6 class="font-semibold text-gray-800">Secure Payment</h6>
                            </div>
                            <p class="text-sm text-gray-600">Your payment information is processed securely. We do not
                                store credit card details.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const creditCardTab = document.getElementById('creditCardTab');
            const codTab = document.getElementById('codTab');
            const creditCardContent = document.getElementById('creditCardContent');
            const codContent = document.getElementById('codContent');

            creditCardTab.addEventListener('click', function() {
                // Update tab styling
                creditCardTab.classList.add('bg-blue-50', 'border-blue-600', 'text-blue-600');
                creditCardTab.classList.remove('bg-white', 'border-gray-300', 'text-gray-600');
                codTab.classList.add('bg-white', 'border-gray-300', 'text-gray-600');
                codTab.classList.remove('bg-blue-50', 'border-blue-600', 'text-blue-600');

                // Show/hide content
                creditCardContent.classList.remove('hidden');
                codContent.classList.add('hidden');
            });

            codTab.addEventListener('click', function() {
                // Update tab styling
                codTab.classList.add('bg-blue-50', 'border-blue-600', 'text-blue-600');
                codTab.classList.remove('bg-white', 'border-gray-300', 'text-gray-600');
                creditCardTab.classList.add('bg-white', 'border-gray-300', 'text-gray-600');
                creditCardTab.classList.remove('bg-blue-50', 'border-blue-600', 'text-blue-600');

                // Show/hide content
                creditCardContent.classList.add('hidden');
                codContent.classList.remove('hidden');
            });

            // Form input formatting
            const cardNumberInput = document.getElementById('cardNumber');
            cardNumberInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 16) value = value.slice(0, 16);
                let formattedValue = '';
                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) formattedValue += ' ';
                    formattedValue += value[i];
                }
                e.target.value = formattedValue;
            });

            const expiryDateInput = document.getElementById('expiryDate');
            expiryDateInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 4) value = value.slice(0, 4);
                if (value.length > 2) {
                    value = value.slice(0, 2) + '/' + value.slice(2);
                }
                e.target.value = value;
            });

            const cvvInput = document.getElementById('cvv');
            cvvInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 3) value = value.slice(0, 3);
                e.target.value = value;
            });

            // Form submission
            // const cardPaymentForm = document.getElementById('cardPaymentForm');
            // cardPaymentForm.addEventListener('submit', function(e) {
            //     e.preventDefault();
            //     // In a real application, you would process the payment here
            //     document.getElementById('successAlert').classList.remove('hidden');
            //     window.scrollTo(0, 0); // Scroll to top to show the alert
            // });

            const codForm = document.getElementById('codForm');
            codForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // In a real application, you would process the order here
                document.getElementById('successAlert').classList.remove('hidden');
                window.scrollTo(0, 0); // Scroll to top to show the alert
            });
        });
    </script>
@endsection
