@extends('layouts.admin_main.master')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Product Q&amp;A</h4>
        </div>
        <div class="card-body">
            @if ($questions->isEmpty())
                <p>No product questions found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Question</th>
                                <th>Asked By</th>
                                <th>Date</th>
                                <th>Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $q)
                                <tr>
                                    <td>{{ $q->product->product_name ?? 'N/A' }}</td>
                                    <td>{{ $q->question }}</td>
                                    <td>{{ $q->user->name ?? 'Guest' }}</td>
                                    <td>{{ $q->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if ($q->status === 'answered')
                                            <div id="answer-display-{{ $q->id }}">
                                                <strong>Answered:</strong> {{ $q->answer }}
                                            </div>
                                            <form id="edit-answer-form-{{ $q->id }}" method="POST" action="{{ route('admin.product.question.answer', $q->id) }}" style="display:none;">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="answer" class="form-control" rows="2" required>{{ $q->answer }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm mt-1">Update</button>
                                                <button type="button" class="btn btn-secondary btn-sm mt-1" onclick="toggleEdit({{ $q->id }}, false)">Cancel</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.product.question.answer', $q->id) }}">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="answer" class="form-control" rows="2" placeholder="Type your answer here..." required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-success btn-sm mt-1">Submit Answer</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($q->status === 'answered')
                                            <button class="btn btn-warning btn-sm" onclick="toggleEdit({{ $q->id }}, true)">Edit</button>
                                            <form method="POST" action="{{ route('admin.product.question.delete', $q->id) }}" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this answer?')">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    function toggleEdit(id, show) {
        document.getElementById('answer-display-' + id).style.display = show ? 'none' : '';
        document.getElementById('edit-answer-form-' + id).style.display = show ? '' : 'none';
    }
</script>
@endsection 