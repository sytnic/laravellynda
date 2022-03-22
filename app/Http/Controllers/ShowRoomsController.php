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
        //  если в запросе указан id (он не null)
        if ($request->query('id') !== null) {
            // то перезаписываем $rooms только теми, у которых room_type_id	== id из запроса
            $rooms = $rooms->where('room_type_id', $request->query('id'));
        }

        return response()->json($rooms);
    }
}
