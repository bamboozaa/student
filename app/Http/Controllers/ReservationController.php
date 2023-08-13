<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_types = RoomType::all();
        $bookings = Reservation::whereNull('checkout_date')->get();
        return view('bookings.home', compact('bookings', 'room_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->json()->all());
        $input = $request->all();
        $room = $input['room'];
        $input['room_type'] = $request->room_type_value;
        // $type = $input['room_type'];
        //$input['checkin_date'] = Carbon::now();
        $digiCount = strlen((string) $input['student_id']);
        if ($digiCount == 13) {
            $exists = Reservation::where('student_id', $input['student_id'])->whereNull('checkout_date')->first();

            if ($exists) {
                $exists->checkout_date = Carbon::now();
                $exists->save();
                return response()->json(['room' => $room, 'type' => $input['room_type'], 'status' => 'success', 'message' => 'ระบบได้ทำการลงชื่อออกจากห้องเรียบร้อยแล้ว']);
            } else {
                $input['checkin_date'] = now();
                Reservation::create($input);
                return response()->json(['room' => $room, 'type' => $input['room_type'], 'status' => 'success', 'message' => 'ระบบได้ทำการลงชื่อเข้าห้องเรียบร้อยแล้ว']);
            }
        } else if ($digiCount == 5) {
            $chunkSize = 4; // กำหนดความยาวของชุดย่อย (จำนวนตัวเลขในแต่ละชุด)
            $chunks = str_split($input['student_id'], $chunkSize);

            if (count($chunks) >= 2) {
                list($room, $type) = $chunks;
            } else {
                $room = $digiCount;
                $type = "";
            }

            /*echo "First chunk: " . $firstChunk . "\n";
            echo "Second chunk: " . $secondChunk . "\n";*/
            return response()->json(['room' => $room, 'type' => $type, 'status' => 'success', 'message' => 'ระบบได้ทำการเปลี่ยนหมายเลขห้องเรียบร้อยแล้ว']);
        }

        //Reservation::create($request->all());
        //return redirect('/reservations')->with('completed', 'Booking has been saved!');



        //return response()->json(['data' => $request->all()]);
        /*$storeData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        $student = Student::create($storeData);
        return redirect('/reservations')->with('completed', 'Student has been saved!');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
