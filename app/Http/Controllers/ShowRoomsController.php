<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ShowRoomsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // вывод на экран простейшей строки
        // return response('A listing of rooms', 200);

        // вывод на экран всех комнат из БД в формате JSON
        $rooms = DB::table('rooms')->get();
        return response()->json($rooms);
    }
}
