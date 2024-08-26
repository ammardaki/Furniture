<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Furniture; // Import the Furniture model


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    /**
     * Show the homeadmin page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admindex()
    {
        // Get furniture data
        $furniture = Furniture::all();
        
        // Return the homeadmin view with furniture data
        return view('homeadmin', compact('furniture'));
    }
}
