<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AdController extends Controller
{
    
    //show all ads
    public function index()
    {
        $ads = Ad::all();

        return response()->json(['ads' => $ads], 200);
    }
    //create ads انشاء اعلان
    public function storeads(Request $request)
    {
        // التحقق من التوكن وصلاحية المستخدم
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // التحقق من صحة البيانات المرسلة
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url',
        ]);

        try {
            // إنشاء إعلان جديد
            $ad = Ad::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'image_url' => $validatedData['image_url'],
            ]);

            return response()->json([
                'message' => 'تم إضافة الإعلان بنجاح!',
                'ad' => $ad,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'حدث خطأ أثناء عملية الإضافة',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function show($id)
    {
        $ad = Ad::find($id);

        if (!$ad) {
            return response()->json(['message' => 'Ad not found'], 404);
        }

        return response()->json(['ad' => $ad], 200);
    }
    public function updateads(Request $request, $id)
    {
        // التحقق من التوكن وصلاحية المستخدم
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $ad = Ad::find($id);

        if (!$ad) {
            return response()->json(['message' => 'Ad not found'], 404);
        }

        // التحقق من صحة البيانات المرسلة
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url',
        ]);

        try {
            // تحديث الإعلان
            $ad->update($validatedData);

            return response()->json(['message' => 'Ad updated successfully', 'ad' => $ad], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'حدث خطأ أثناء عملية التحديث',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        $ad = Ad::find($id);

        if (!$ad) {
            return response()->json(['message' => 'Ad not found'], 404);
        }

        $ad->delete();

        return response()->json(['message' => 'Ad deleted successfully'], 200);
    }
}
