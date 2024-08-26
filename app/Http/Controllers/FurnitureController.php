<?php

namespace App\Http\Controllers;

use App\Models\furniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FurnitureController extends Controller
{


//الاساسي

    public function store(Request $request)
    {

        // التحقق من صحة البيانات المرسلة
        $validatedData = $request->validate([
            // 'furniture_id' => 'required',
            'furniture_name' => 'required',
            'quantity' => 'required|numeric|min:1',
            'img_url' => 'required',
        ]);

        try {
            // إنشاء عنصر أثاث جديد
            $furniture = Furniture::create([
                'furniture_name' => $validatedData['furniture_name'],
                'quantity' => $validatedData['quantity'],
                'img_url' => $validatedData['img_url'],
            ]);

            return response()->json([
                'message' => 'تم إضافة العنصر بنجاح!',
                'furniture' => $furniture,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'حدث خطأ أثناء عملية الإضافة',
                'error' => $e->getMessage(),
            ], 500);
        }

    }
    public function showbyid($id)
    {
        $furniture = Furniture::findOrFail($id);
        return view('show', compact('furniture'));
    }
    public function Ashowbyid($id)
    {
    
        $furniture = Furniture::findOrFail($id);
        return view('Ashow', compact('furniture'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\furniture  $furniture
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $furniture = DB::select('select * from furniture where id=?', [$id]);
        return response()->json($furniture);

    }

    public function getFurnitureData()
    {
        $furniture = Furniture::all();
        return response()->json($furniture);
    }
    public function getAll(Request $request)
    {

        $data = furniture::get();
        if (furniture::get()) {
            return ['message' => 'furniture exist', 'all furniture' => $data];
        } else {
            return ['message' => 'furniture does not exist'];
        }

    }

    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            // تحديث الاستعلام لاستخدام اسم العمود الصحيح في قاعدة البيانات
            $furniture = Furniture::where('furniture_name', $request->name)->firstOrFail();
            return response()->json(['furniture' => $furniture]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Furniture not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function edit(furniture $furniture, $id)
    {
        $furniture = furniture::find($id);
        return response()->json($furniture);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = furniture::find($id);

        $request->validate([
            'image' => ['image'],
        ]);

        if ($request->image && !is_string($request->image)) {
            $photo = $request->image;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/users', $newPhoto);
            $request["img_url"] = 'uploads/users/' . $newPhoto;
        }
        $new_data = furniture::where('id', $id)->update([

            'name' => $request->name,
            'quantity' => $request->quantity,
            'img_url' => $request["img_url"],

        ]);
        return response()->json($new_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (furniture::destroy($id)) {
            return ['message' => 'deleted successfully'];
        } else {
            return ['message' => 'Not deleted'];
        }

    }

}
