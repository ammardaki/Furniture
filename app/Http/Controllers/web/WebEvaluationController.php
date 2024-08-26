<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
class WebEvaluationController extends Controller
{
    public function index()
    {
        $evaluation= Evaluation ::all();
        return view('comment.index', compact('comments'));
    }
 // دالة تخزين التقييم

 public function Store(Request $request)
 {
     // التحقق من صحة البيانات
     $validator = Validator::make($request->all(), [
         'user_id' => 'required|numeric|min:1',
         'furniture_id' =>'required|numeric|min:1' ,
         'value' => 'required|numeric|min:1',
     ]);
 
     if ($validator->fails()) {
         return redirect()->route('evaluation.create')
                          ->withErrors($validator)
                          ->withInput();
     }
 
     try {
         // إنشاء تعليق جديد
         $evaluation = Evaluation::create([
             'user_id' => $request->input('user_id'),
             'furniture_id' => $request->input('furniture_id'),
             'value' => $request->input('value'),
         ]);
 
         return redirect()->route('evaluation.success')
                          ->with('success', 'تم إضافة الإعلان بنجاح!');
     } catch (\Exception $e) {
         return redirect()->route('evaluation.success')
                          ->with('error', 'حدث خطأ أثناء عملية الإضافة: ' . $e->getMessage());
     }
}
}