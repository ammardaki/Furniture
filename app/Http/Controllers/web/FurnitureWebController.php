<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Furniture;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class FurnitureWebController extends Controller
{
    // دالة عرض صفحة إضافة الأثاث
    public function create(): View
    {
        return view('furnitures.create');
    }
    // public function createAd(): View
    // {
    //     return view('furnitures.create');
    // }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'furniture_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:1',
            'img_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->route('furnitures.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        try {
            // إنشاء عنصر أثاث جديد
            $furniture = Furniture::create([
                'furniture_name' => $request->input('furniture_name'),
                'quantity' => $request->input('quantity'),
                'img_url' => $request->input('img_url'),
            ]);

            return redirect()->route('furnitures.create')
                             ->with('success', 'تم إضافة العنصر بنجاح!');
        } catch (\Exception $e) {
            return redirect()->route('furnitures.create')
                             ->with('error', 'حدث خطأ أثناء عملية الإضافة: ' . $e->getMessage());
        }
    }
    public function destroy($id)
{
    $furniture = Furniture::find($id);

    if ($furniture) {
        $furniture->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}

}