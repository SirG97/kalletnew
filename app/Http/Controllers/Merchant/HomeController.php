<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('merchant.auth:merchant');
    }

    /**
     * Show the Merchant dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('merchant.home');
    }
}
