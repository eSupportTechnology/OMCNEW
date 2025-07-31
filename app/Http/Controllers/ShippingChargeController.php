<?php

namespace App\Http\Controllers;

use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    public function index()
{
    $charges = ShippingCharge::all();
    return view('admin_dashboard.shipping_charges', compact('charges'));
}

public function create()
{
    return view('admin_dashboard.shipping_charges_create');
}

public function store(Request $request)
{
    $request->validate([
        'min_quantity' => 'required|integer|min:1',
        'max_quantity' => 'required|integer|gte:min_quantity',
        'charge' => 'required|numeric|min:0',
    ]);

    ShippingCharge::create($request->all());

    return redirect()->route('shipping-charges.index')->with('success', 'Shipping charge added.');
}

public function edit($id)
{
    $shippingCharge = ShippingCharge::findOrFail($id);
    return view('admin_dashboard.shipping_charges_edit', compact('shippingCharge'));
}

public function update(Request $request, $id)
{
    $shippingCharge = ShippingCharge::findOrFail($id);
    $request->validate([
        'min_quantity' => 'required|integer|min:1',
        'max_quantity' => 'required|integer|gte:min_quantity',
        'charge' => 'required|numeric|min:0',
    ]);

    $shippingCharge->update($request->all());

    return redirect()->route('shipping-charges.index')->with('success', 'Shipping charge updated.');
}

public function destroy(ShippingCharge $shippingCharge)
{
    $shippingCharge->delete();
    return redirect()->route('shipping-charges.index')->with('success', 'Shipping charge deleted.');
}

public function getChargeByQuantity($qty)
{
    $charge = ShippingCharge::where('min_quantity', '<=', $qty)
        ->where('max_quantity', '>=', $qty)
        ->first();

    return response()->json([
        'charge' => $charge ? $charge->charge : 0,
    ]);
}

}
