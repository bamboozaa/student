@extends('layouts.main2')
@section('importcss')
    @parent
    {{-- {{ Html::style('css/custom.css') }} --}}
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap');

        body {
            font-family: 'Mitr', sans-serif;
        }
    </style>
@stop
@section('content')

    @php
        foreach ($_GET as $key => $value):
            ${$key} = $value;
        endforeach;
    @endphp

    <div class="row">
        <div class="col-md-12 text-center">
            <h2 style="color:blue"><strong>CHECK-IN</strong></h2>
            <p id="realTime"></p>
        </div>
    </div>
    {{-- {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\ReservationController@store']) !!} --}}
    {{-- <form id="myForm">
        @csrf
        <div class="row"> --}}
    {{-- <div class="col-md-12">
                @foreach ($room_types as $key => $room_type)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="room_type_value" id="Radio{{ $key+1 }}" value="{{ $room_type->id }}">
                    <label class="form-check-label" for="Radio{{ $key+1 }}">{{ $room_type->name }}</label>
                </div>
                @endforeach
            </div> --}}
    {{-- </div> --}}
    {{-- <div class="form-floating mb-3">
            <input type="text" class="form-control" id="lab_number" name="room" placeholder="หมายเลขห้อง">
            <label for="lab_number">หมายเลขห้อง</label>
        </div> --}}
    {{-- <div class="form-floating">
            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="รหัสนักศึกษา" autofocus>
            <label for="student_id">รหัสนักศึกษา</label>
        </div> --}}

    {{-- <a href="#" class="submit-data">Submit data</a> --}}

    {{-- <div id="exampleid"></div> --}}


    {{-- </form> --}}




    <form id="myForm">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <fieldset class="border p-3 px-auto">
                    <legend class="float-none w-auto">ประเภทการใช้งาน</legend>
                    @foreach ($room_types as $key => $room_type)
                        <div class="form-check form-check-inline mb-4">
                            <input class="form-check-input" type="radio" name="room_type_value"
                                id="Radio{{ $key + 1 }}" value="{{ $room_type->id }}"
                                @if (isset($type)) @if ($room_type->id == $type) checked @endif
                                @endif>
                            <label class="form-check-label" for="Radio{{ $key + 1 }}">{{ $room_type->name }}</label>
                        </div>
                    @endforeach
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="border px-3 pb-4">
                    <legend class="float-none w-auto">หมายเลขห้อง</legend>
                    <div class="form-floating mt+1">
                        <input type="text" class="form-control" id="room" name="room"
                            value="{{ isset($room) ? $room : '' }}">
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="รหัสนักศึกษา"
                autofocus>
            <label for="student_id">แสกนบาร์โค๊ด</label>
        </div>

    </form>
    <div class="row">
        <fieldset class="border p-3 mt-3">
            <legend class="float-none w-auto">การเข้าใช้ห้องปฏิบัติการคอมพิวเตอร์</legend>
            <table class="table table-responsive table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <td>หมายเลขห้อง</td>
                        <td>ประเภทการใช้ห้อง</td>
                        <td>รหัสนักศึกษา</td>
                        <td>วัน-เวลาใช้ห้อง</td>
                    </tr>
                </thead>
                @if (count($bookings) > 0)
                    @foreach ($bookings as $key => $booking)
                        <tr>
                            @php
                                $carbonDate = Carbon\Carbon::parse($booking->checkin_date);
                                $thaiDate = $carbonDate->locale('th')->tz('Asia/Bangkok')->isoFormat('LLL'); // 'LL' represents the long date format
                            @endphp
                            <td>{{ $booking->room }}</td>
                            <td>{{ $booking->roomtype->name }}</td>
                            <td>{{ $booking->student_id }}</td>
                            <td>{{ $thaiDate }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">ไม่พบข้อมูลการใช้ห้องในขณะนี้</td>
                    </tr>
                @endif

            </table>
        </fieldset>
    </div>

    <script>
        $(document).ready(function() {
            //dd $("#student_id").keypress(function() {
            // $("#student_id").keypress(function() {
            $('#student_id').on('keydown', function(event) {
                if (event.which === 13) { // Check if Enter key was pressed
                    var form = $("#myForm")[0]; // Get the form element
                    var formData = new FormData(form); // Create a FormData object
                    // formData.append('username', 'john_doe');
                    // formData.append('email', 'john@example.com');
                    console.log(formData);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('reservations.store') }}", // Replace with your actual Laravel controller route
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log("Data sent successfully", response);
                            Swal.fire({
                                icon: response.status === 'success' ? 'success' :
                                    'error',
                                title: response.status === 'success' ? 'Success' :
                                    'Error',
                                text: response.message,
                                timer: 6000, // Timer in milliseconds (3 seconds)
                                showConfirmButton: false // Hide the "OK" button
                            });
                            redirectToAnotherPage(response);
                        },
                        error: function() {
                            console.error("Error sending data");
                        }
                    });
                }
            });
        });

        function redirectToAnotherPage(data) {
            var queryString = $.param(data); // Convert the data object to a query string
            var redirectUrl = '/reservations?' + queryString;
            window.location.href = redirectUrl;
        }


        /*$(document).ready(function() {
            $('#student_id').on('input', function() {
                var scannedData = $(this).val();
                $('#room').val(room);
            });
        });*/

        $(document).ready(function() {
            var $input = $('#student_id');

            $input.focus(); // Initial focus

            // Reapply focus when focus is lost
            $input.blur(function() {
                $input.focus();
            });
        });
    </script>

    <script>
        function updateRealTime() {
            const realTimeElement = document.getElementById('realTime');
            const now = new Date();
            const dayNames = ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'];
            const monthNames = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',
                'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
            ];
            const day = dayNames[now.getDay()];
            const date = now.getDate();
            const month = monthNames[now.getMonth()];
            const year = now.getFullYear() + 543;
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const formattedTime = `วัน ${day} ที่ ${date} ${month} ${year} ${hours}:${minutes}:${seconds}`;
            realTimeElement.textContent = formattedTime;
        }

        // Initial update
        updateRealTime();

        // Update every second
        setInterval(updateRealTime, 1000);
    </script>

@endsection
