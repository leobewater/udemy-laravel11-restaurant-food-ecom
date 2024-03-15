<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function index():View
	{
        $sliders = Slider::where('status', 1)->latest()->get();

		return view('frontend.home.index', [
            'sliders' => $sliders
        ]);
	}
}
