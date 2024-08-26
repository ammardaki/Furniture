<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class WebCommentController extends Controller
{
    public function index()
    {
        $comment= Comment ::all();
        return view('comment.index', compact('comment'));
    }
    public function inde()
    {
        $comment= Comment ::all();
        return view('comment.inde', compact('comment'));
    }
 // دالة تخزين التعليق

 public function store(Request $request)
 {
     // التحقق من صحة البيانات
     $validator = Validator::make($request->all(), [
         'user_id' => 'required|numeric|min:1',
         'furniture_id' => 'required|numeric|min:1',
         'body' => 'required|string|max:255',
     ]);

     if ($validator->fails()) {
         return redirect()->route('comment.create')
                          ->withErrors($validator)
                          ->withInput();
     }

     try {
         // إنشاء تعليق جديد
         Comment::create([
             'user_id' => $request->input('user_id'),
             'furniture_id' => $request->input('furniture_id'),
             'body' => $request->input('body'),
         ]);

         return redirect()->route('comment.index')
                          ->with('success', 'تم إضافة التعليق بنجاح!');
     } catch (\Exception $e) {
         return redirect()->route('comment.index')
                          ->with('error', 'حدث خطأ أثناء عملية الإضافة: ' . $e->getMessage());
     }
 }
 public function success()
 {
     return view('comment.success');
 }
}