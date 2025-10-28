<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\ReturnRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ReturnRequestStatusController extends Controller
{
    public function index()
    {
        $returnRequests = ReturnRequest::with(['user', 'order'])->get();
        return view('admin_dashboard.return_requests', compact('returnRequests'));
    }

    public function updateStatus(Request $request, $id)
    {
        $returnRequest = ReturnRequest::findOrFail($id);

        $request->validate([
            'status' => 'required|string',
        ]);

        $returnRequest->status = $request->status;
        $returnRequest->save();

        // ✅ If refund is approved, process refund logic
        if ($request->status === 'approved') {
            try {
                DB::beginTransaction();

                $order = CustomerOrder::where('id', $returnRequest->order_id)->first();

                if (!$order) {
                    Log::error("Refund failed: Order not found for ReturnRequest ID {$returnRequest->id}");
                    return response()->json(['success' => false, 'message' => 'Order not found.']);
                }

                if ($order->payment_method === 'Card' && $order->payment_status === 'Paid') {
                    // 🔹 Example: call OnePay Refund API
                    $refundResponse = Http::withHeaders([
                        'Authorization' => config('onepay.api_key'),
                    ])->post(config('onepay.base_url') . '/refund', [
                        'app_id'        => config('onepay.app_id'),
                        'reference'     => $order->transaction_id,
                        'amount'        => $order->total_cost,
                        'currency'      => 'LKR',
                    ]);

                    Log::info('OnePay Refund Response', [
                        'order_code' => $order->order_code,
                        'response' => $refundResponse->json()
                    ]);

                    if ($refundResponse->successful()) {
                        $order->update([
                            'payment_status' => 'Refunded',
                        ]);
                        $returnRequest->update(['refund_status' => 'Completed']);
                    } else {
                        Log::error("Refund API failed", ['body' => $refundResponse->body()]);
                        DB::rollBack();
                        return response()->json(['success' => false, 'message' => 'Refund API failed.']);
                    }
                } else {
                    // 🔹 If COD, just mark it refunded manually
                    $order->update([
                        'payment_status' => 'Refunded',
                    ]);
                    $returnRequest->update(['refund_status' => 'Manual']);
                }

                DB::commit();

                Log::info("Refund processed successfully for Order {$order->order_code}");
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Error during refund process: {$e->getMessage()}", [
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ]);
                return response()->json(['success' => false, 'message' => 'Refund failed.']);
            }
        }

        return response()->json(['success' => true, 'status' => $request->status]);
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
}
