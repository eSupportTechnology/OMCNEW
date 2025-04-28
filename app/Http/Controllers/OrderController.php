<?php

namespace App\Http\Controllers;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $allOrders = CustomerOrder::all();
        $inProgressOrders = CustomerOrder::where('status', 'In Progress')->get();
        $deliveredOrders = CustomerOrder::where('status', 'Delivered')->get();
        $cancelledOrders = CustomerOrder::where('status', 'Cancelled')->get();
        $shippedOrders = CustomerOrder::where('status', 'Shipped')->get();
        $pendingOrders = CustomerOrder::where('status', 'Confirmed')->get();
        $paidOrders = CustomerOrder::where('status', 'Paid')->get();
    
        return view('admin_dashboard.orders', compact(
            'allOrders', 
            'inProgressOrders', 
            'deliveredOrders', 
            'cancelledOrders', 
            'shippedOrders',
            'pendingOrders',
            'paidOrders'
        ));
    }
    
    


    public function destroy($id)
    {
        $order = CustomerOrder::findOrFail($id);
        $order->items()->delete();
        $order->delete();
    
        return redirect()->route('orders')->with('status', 'Order and related items deleted successfully');
    }
    

    
    public function setOrderCode(Request $request)
    {
        $request->session()->put('current_order_code', $request->input('order_code'));
        return response()->json(['success' => true]);
    }
    

    public function show()
    {
        $order_code = session('current_order_code');

        if (!$order_code) {
            return redirect()->route('orders')->with('error', 'No order code provided');
        }

        $order = CustomerOrder::where('order_code', $order_code)->firstOrFail();
        $items = $order->items()->with('product.images')->get(); 
        $totalQuantity = $items->sum('quantity');

        return view('admin_dashboard.order-details', compact('order', 'items', 'totalQuantity'));
    }

    
    
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $order = CustomerOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return redirect()->route('orders')->with('status', 'Order status updated successfully.');
    }



}
