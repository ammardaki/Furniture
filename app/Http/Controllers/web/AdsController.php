<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class AdsController extends Controller
{

    
        public function index()
        {
            $ads = Ad::all();
            return view('ads.index', compact('ads'));
        }
    
        public function show($id)
        {
            $ad = Ad::findOrFail($id);
            return view('ads.show', compact('ad'));
        }
        public function indext()
        {
            $ads = Ad::all();
    
            return response()->json(['ads' => $ads], 200);
        }
    

     // دالة تخزين الإعلان
    
     public function StoreAds(Request $request)
     {
         // التحقق من صحة البيانات
         $validator = Validator::make($request->all(), [
             'title' => 'required|string|max:255',
             'description' => 'required|string|max:255',
             'image_url' => 'required|url',
         ]);
     
         if ($validator->fails()) {
             return redirect()->route('ads.create')
                              ->withErrors($validator)
                              ->withInput();
         }
     
         try {
             // إنشاء إعلان جديد
             $ad = Ad::create([
                 'title' => $request->input('title'),
                 'description' => $request->input('description'),
                 'image_url' => $request->input('image_url'),
             ]);
     
             return redirect()->view('ads.success')
                              ->with('success', 'تم إضافة الإعلان بنجاح!');
         } catch (\Exception $e) {
             return redirect()->route('ads.success')
                              ->with('error', 'حدث خطأ أثناء عملية الإضافة: ' . $e->getMessage());
         }
     }
     
     public function destroyAds($id)
     {
         $ad = Ad::find($id);
     
         if ($ad) {
             $ad->delete();
             return response()->json(['success' => true]);
         }
     
         return response()->json(['success' => false], 404);
     }
     public function success()
     {
         return view('ads.success');
     }
}
