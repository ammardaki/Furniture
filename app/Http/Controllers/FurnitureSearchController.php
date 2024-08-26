<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Furniture;
use App\Models\Ad;

class FurnitureSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $furniture = Furniture::where('furniture_name', 'LIKE', "%$query%")->get();
        $ads = Ad::all(); // استرداد الإعلانات بنفس الطريقة الحالية
        return view('furnitures.ex', compact('furniture', 'ads'));
    }
}
