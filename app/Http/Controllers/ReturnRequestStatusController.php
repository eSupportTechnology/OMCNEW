<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\ReturnRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReturnRequestStatusController extends Controller
{
    public function index()
    {
        $returnRequests = ReturnRequest::with('user')->get();
        return view('admin_dashboard.return_requests', compact('returnRequests'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $returnRequest = ReturnRequest::find($id);

        if (!$returnRequest) {
            return response()->json(['success' => false, 'message' => 'Return request not found']);
        }

        $returnRequest->status = $request->status;
        $returnRequest->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    public function destroy($id)
    {
        $returnRequest = ReturnRequest::find($id);

        if (!$returnRequest) {
            return back()->with('error', 'Return request not found');
        }

        $returnRequest->delete();
        return back()->with('success', 'Return request deleted successfully');
    }
    public function create()
    {
        $userId = Auth::id();

        $orders = CustomerOrder::where('user_id', $userId)
            ->where('status', 'Delivered')
            ->get();

        return view('frontend.ReturnProduct', compact('orders'));
    }
}
