@extends('member_dashboard.user_sidebar')

@section('dashboard-content')
<style>
.list-group-item {
    border: 1px solid #e0e0e0;
    border-radius: 5px; 
}

.list-group-item h6 {
    color: #007bff; 
}

.list-group-item p {
    margin-bottom: 0.5rem; 
}

.list-group-item small {
    font-style: italic; 
}


</style>



<div class="d-flex justify-content-between align-items-center py-2 px-2">
    <h4>Customer Inquiries</h4>
    <a href="{{ route('inquiry.create') }}" class="btn default-btn">Write an Inquiry</a>
</div>

<div class="container p-4">
    <div class="list-group">
        @forelse($inquiries as $inquiry)
            <div class="list-group-item mb-3 position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 p-3" style="font-size:12px;" aria-label="Close"></button>
                <h6 style="color: black;" class="mb-1">{{ $inquiry->subject }}</h6>
                <p class="mb-1"><strong>Message:</strong> {{ $inquiry->message }}</p>
                <small class="text-muted">Date: {{ $inquiry->created_at->format('Y-m-d') }}</small>
                <hr>
                <h6 class="mt-2">Admin Response:</h6>
                <p>{{ $inquiry->reply ?? 'No response yet.' }}</p>
                <small class="text-muted">Date of Response: {{ $inquiry->updated_at->format('Y-m-d') }}</small>
            </div>
        @empty
            <div class="list-group-item mb-3">
                <p class="text-center">No inquiries available.</p>
            </div>
        @endforelse
    </div>
</div>





<script>
    document.querySelectorAll('.btn-close').forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.list-group-item').remove(); 
    });
});

</script>
@endsection
