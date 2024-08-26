<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * جلب جميع الحجوزات
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllReservations()
    {
        $reservations = Reservation::all();

        // إرجاع الاستجابة كـ JSON مع كود الحالة 200
        return response()->json($reservations, 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $userId = auth()->id(); // الحصول على معرف المستخدم الحالي
        $reservations = Reservation::where('user_id', $userId)->get(); // جلب الحجوزات للمستخدم الحالي
        return response()->json($reservations, 200);
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

        // التحقق من صحة البيانات المرسلة من النموذج
        $validatedData = $request->validate([

            'furniture_id' => 'required|exists:furniture,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required',
            'time' => 'required',
        ]);
        // إنشاء سجل حجز جديد
        $reservation = new Reservation();

        $reservation->furniture_id = $validatedData['furniture_id'];

        $reservation->user_id = auth()->id();
        $reservation->quantity = $validatedData['quantity'];
        $reservation->date = $validatedData['date'];
        $reservation->time = $validatedData['time'];
        $reservation->save();
        // إعادة التوجيه أو الرد بنجاح العملية
        return response([
            'message' => 'Reservation made successfully',
            'data' => $reservation,
        ]);
        return response()->json($reservation);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(reservation $reservation, $id)
    {
        $reservation = Reservation::find($id);
        return response()->json($reservation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Reservation::find($id);
        $new_data = Reservation::where('id', $id)->update([
            'furniture_id' => $request->furniture_id,
            'quantity' => $request->quantity,
            'date' => $request->date,
            'time' => $request->time,
        ]);
        return response()->json($new_data);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (reservation::destroy($id)) {
            return ['message' => 'deleted successfully'];
        } else {
            return ['message' => 'Not deleted'];
        }

    }
    public function cancel(Request $request)
    {
        //
    }
}
