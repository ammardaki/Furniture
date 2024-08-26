<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(categories $categories)
    {
        //
    }
}



// <?php

// namespace App\Http\Controllers;

// use App\Models\categories;
// use Illuminate\Http\Request;

// class CategoriesController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         $categories = categories::all();
//         return response()->json($categories, 200);
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//         ]);

//         $category = categories::create([
//             'name' => $request->name,
//         ]);

//         return response()->json($category, 201);
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  \App\Models\categories  $categories
//      * @return \Illuminate\Http\Response
//      */
//     public function show(categories $category)
//     {
//         return response()->json($category, 200);
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \App\Models\categories  $categories
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, categories $category)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//         ]);

//         $category->update([
//             'name' => $request->name,
//         ]);

//         return response()->json($category, 200);
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  \App\Models\categories  $categories
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy(categories $category)
//     {
//         $category->delete();
//         return response()->json(null, 204);
//     }
// }
