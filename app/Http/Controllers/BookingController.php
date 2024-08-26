<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        //السطرين تبع المستخدم الحالي بيطلو خطا
        $user = Auth::user();
        $bookings = Reservation::where('user_id', $user->id)->get(); // جلب الحجوزات الخاصة بالمستخدم الحالي
        //     $bookings = Reservation::all(); // أو يمكنك استخدام pagination
        return view('booking.index', compact('bookings'));
    }


    public function getAllReservations()
    {
        // $bookings = Reservation::all();
        $bookings = Reservation::with('furniture')->get();

        // إرجاع الاستجابة كـ JSON مع كود الحالة 200
        return view('booking.adindex', compact('bookings'));

    }

    public function successe()
    {
        return view('booking.successde');
    }

    public function showForm(Request $request)
    {
        $user_id = auth()->user()->id;

        // Pass the data to the form view
        return view('booking.create', [
            'furniture_id' => $request->furniture_id,
            'user_id' => $user_id,
            'furniture_name' => $request->furniture_name,
            'quantity' => $request->quantity,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'furniture_id' => 'required|integer',
            'user_id' => 'required|integer',
            'quantity' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        $reservation = Reservation::create($data);

        return view('booking.success');
    }

    public function success()
    {
        return view('booking.success');
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            $reservation->delete();
            return redirect()->route('booking.successde')->with('success', 'Booking deleted successfully.');
        } else {
            // return redirect()->route('booking.index')->with('error', 'Booking not found.');
        }
    }
}
