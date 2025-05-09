@extends('member_dashboard.user_sidebar')

@section('dashboard-content')
<script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="min-h-screen bg-gray-50 p-4 md:p-6">
    <!-- Profile Header -->
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 flex items-center mb-6">
        @if(isset($user))
            <img src="{{ $user->profile_image_url }}" alt="Profile Picture"
                 class="w-16 h-16 md:w-20 md:h-20 rounded-full object-cover mr-4 md:mr-6 border-2 border-blue-100">
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-500 text-sm md:text-base">Member since {{ $user->created_at->format('M Y') }}</p>
            </div>
        @else
            <p class="text-red-500">No user details available.</p>
        @endif
    </div>

    <!-- My Orders Section -->
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 mb-6">
        <h3 class="text-lg md:text-xl font-semibold text-blue-600 border-b border-blue-100 pb-3 mb-4">My Orders</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="flex flex-col items-center p-3 hover:bg-gray-50 rounded-lg transition">
                <img src="https://icons.veryicon.com/png/128/miscellaneous/document-format/reviewed-5.png"
                     alt="Confirmed" class="w-40 h-40 mb-2">
                <span class="text-xs md:text-sm text-center">Confirmed</span>
            </div>
            <div class="flex flex-col items-center p-3 hover:bg-gray-50 rounded-lg transition">
                <img src="https://icons.veryicon.com/png/128/miscellaneous/cb/to-be-shipped-25.png"
                     alt="To be shipped" class="w-40 h-40 mb-2">
                <span class="text-xs md:text-sm text-center">To be shipped</span>
            </div>
            <div class="flex flex-col items-center p-3 hover:bg-gray-50 rounded-lg transition">
                <img src="https://icons.veryicon.com/png/128/miscellaneous/bigmk_app_icon/in-transit.png"
                     alt="Shipped" class="w-40 h-40 mb-2">
                <span class="text-xs md:text-sm text-center">Shipped</span>
            </div>
            <a href="{{ route('myreviews') }}" class="flex flex-col items-center p-3 hover:bg-gray-50 rounded-lg transition">
                <img src="https://icons.veryicon.com/png/o/application/collaborative-software-foundation-icon/comment-235.png"
                     alt="To be reviewed" class="w-40 h-40 mb-2">
                <span class="text-xs md:text-sm text-center">To be reviewed</span>
            </a>
        </div>
    </div>

    <!-- Dashboard Content Columns -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Recent Activity Section -->
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 flex-1">
            <h3 class="text-lg md:text-xl font-semibold text-blue-600 border-b border-blue-100 pb-3 mb-4">Recent Activities</h3>
            <ul class="space-y-3">
                @if(!empty($activities))
                    @foreach($activities as $activity)
                        <li class="p-3 hover:bg-gray-50 rounded-lg transition">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-5 w-5 text-blue-500 mr-3 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="text-sm md:text-base text-gray-700">{!! $activity !!}</div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-red-500 p-3">No recent activities.</li>
                @endif
            </ul>
        </div>

        <!-- Notifications Section -->
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 flex-1">
            <h3 class="text-lg md:text-xl font-semibold text-blue-600 border-b border-blue-100 pb-3 mb-4">Notifications</h3>
            <ul class="space-y-3">
                @if(!empty($notifications))
                    @foreach($notifications as $notification)
                        <li class="p-3 hover:bg-gray-50 rounded-lg transition">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-5 w-5 text-yellow-500 mr-3 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="text-sm md:text-base text-gray-700">{!! $notification !!}</div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-red-500 p-3">No new notifications.</li>
                @endif
            </ul>
        </div>
    </div>

    <!-- FAQ Section (optional) -->
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 mt-6 max-w-4xl mx-auto">
        <h3 class="text-lg md:text-xl font-semibold text-blue-600 border-b border-blue-100 pb-3 mb-4">Frequently Asked Questions</h3>
        <div class="space-y-2">
            <div class="faq-item border rounded-lg overflow-hidden">
                <button class="faq-question w-full flex justify-between items-center p-4 text-left bg-white hover:bg-gray-50 transition">
                    <span>How do I track my order?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer p-4 bg-gray-50 hidden">
                    <p>You can track your order by visiting the "My Orders" section in your dashboard. Once your order is shipped, you'll receive a tracking number.</p>
                </div>
            </div>
            <!-- Add more FAQ items as needed -->
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // FAQ toggle functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const icon = question.querySelector('svg');

                // Toggle answer visibility
                answer.classList.toggle('hidden');

                // Rotate icon
                icon.classList.toggle('rotate-180');

                // Close other open answers
                document.querySelectorAll('.faq-question').forEach(q => {
                    if (q !== question) {
                        q.nextElementSibling.classList.add('hidden');
                        q.querySelector('svg').classList.remove('rotate-180');
                    }
                });
            });
        });
    });
</script>
@endsection
