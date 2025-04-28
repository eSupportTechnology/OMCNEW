<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendTemplateController extends Controller
{
    public function main()
    {
        return view('frontend.home');
    }
}
