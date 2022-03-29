<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        // 
        // \DB::table('bookings')->get()->dd();

        // получение всех записей из таблицы БД
        $bookings = DB::table('bookings')->get();

        // передача переменной во вью не с помощью массива, а с помощью with()
        return view('bookings.index')
            ->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('users')->get()->pluck('name', 'id')->prepend('none');
        $rooms = DB::table('rooms')->get()->pluck('number', 'id');

        return view('bookings.create')
            ->with('users', $users)
            ->with('rooms', $rooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd($request->input('room_id'));
        //dd($request);
        // Позволяет играть с отправкой POST
        // dd($request->all());

        // Здесь ловятся значения из формы.
        // Вставка значений в таблицу bookings 
        // и получение идентификатора.       
        $id = DB::table('bookings')->insertGetId([
            'room_id' => $request->input('room_id'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            // значение по умолчанию false
            'is_reservation' => $request->input('is_reservation', false),
            // значение по умолчанию false
            'is_paid' => $request->input('is_paid', false),
            'notes' => $request->input('notes'),
        ]);
        // Вставка значений в таблицу bookings_users 
        DB::table('bookings_users')->insert([
            'booking_id' => $id,
            'user_id' => $request->input('user_id'),
        ]);

        // Редирект
        return redirect()->action('BookingController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        // Понимание $booking,
        // отображается на "/bookings/1"
        // согласно маршруту bookings.show
        // dd($booking);
        

        // Получение всех атрибутов в массиве из объекта $booking
        //   dd($booking->getAttributes());
        // Получение единичных данных из объекта $booking
        //   dd($booking->room_id, $booking->notes);

        // По факту передали объект во вью,
        // где можно обращаться к его свойствам
        return view('bookings.show', ['booking' => $booking]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
