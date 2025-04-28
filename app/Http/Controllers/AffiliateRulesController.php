<?php

namespace App\Http\Controllers;

use App\Models\AffiliateRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AffiliateRulesController extends Controller
{

    public function index()
    {
        $rules = AffiliateRule::all(); 
        return view('admin_dashboard.affiliate_rules', compact('rules'));
    }



    public function store(Request $request)
    {
        
            $request->validate([
                'rule' => 'required|string|max:255',
            ]);
        
            AffiliateRule::create([
                'rule' => $request->rule,
            ]);
        
            return redirect()->route('affiliate_rules')->with('status', 'Rule added successfully.');
    }
    
    
    public function update(Request $request, $id)
    {
            $affiliateRule = AffiliateRule::findOrFail($id);
            $affiliateRule->rule = $request->rule;
            $affiliateRule->save();
    
            return redirect()->route('affiliate_rules')->with('status', 'Rule updated successfully.');
    }
    


    public function destroy($id)
    {
        $rule = AffiliateRule::findOrFail($id);
        $rule->delete();

        return redirect()->route('affiliate_rules')->with('success', 'Rule deleted successfully.');
    }



    public function showrules()
    {
        $rules = AffiliateRule::all();
        return view('affiliate_dashboard.affiliate_rules', compact('rules'));
    }

}
