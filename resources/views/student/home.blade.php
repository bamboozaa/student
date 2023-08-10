@extends('layouts.layout')
@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
@stop
@section('content')

<div class="container">

    <form action="{{ url('/students') }}" method="get">
        <h1> {!! Form::label('room_type', 'ประเภทการใช้งานห้อง') !!} </h1>
        @foreach ($room_types as $key => $room_type)
        <div class="form-check form-check">
            <input class="form-check-input" type="radio" name="room_type_value" id="Radio{{ $key+1 }}" value="{{ $room_type->id }}">
            <label class="form-check-label" for="Radio{{ $key+1 }}">{{ $room_type->name }}</label>
        </div>
        @endforeach
        <div class="form-group">
            {!! Form::label('student_id', 'รหัสนักศึกษา') !!}
            {!! Form::text('student_id', null, ['class' => 'form-control', (isset($_GET['student_id'])) ? '' : 'autofocus', 'id' => 'student_id']) !!}
        </div>
    </form>

    @php
    foreach($_GET as $key=>$val) {
        ${$key}=$val;
    }

    if (isset($student_id)) {
        //$student_id = $_GET['student_id'];
        $data = DB::connection('odbc')->table('AVSREG.VIEWSTUDENTPROFILE')->where('STUDENT_ID', $student_id)->get();
        if (count($data) > 0) {
            $data = $data[0];
            foreach ($data as $key => $value) {
                $tis_arr[$key] = iconv("tis-620", "utf-8", $value);
            }
            unset($data);
        } else {
            header("Location: localhost/students");
        }
    }
    @endphp


    @if (isset($tis_arr))
        {{-- {{ dd($tis_arr) }} --}}
        {{-- {{ $student_name = $tis_arr['STUDENT_ID'] . " " . $tis_arr['FNAME'] . " " . $tis_arr['LNAME'] }} --}}
        @php
            $student_name = $tis_arr['STUDENT_ID'] . " " . $tis_arr['FNAME'] . " " . $tis_arr['LNAME'];
        @endphp
        <form action="{{ url('/students') }}" method="get">
            <div class="form-group">
                {!! Form::label('room_name', 'ชื่อห้อง') !!}
                {!! Form::text('room_name', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
            </div>
            {!! Form::hidden('student_name', $student_name) !!}
            {!! Form::hidden('room_type_value', $room_type_value) !!}
        </form>
    @endif

    @php
    if (isset($room_name)) {
        $seat = substr($room_name, 0, 2);
        $room = substr($room_name, 2, 4);
        echo($student_name . " " . $seat . " " . $room . " " . $room_type_value);
    }




    @endphp
</div>

<script>
    $("#student_id").on('change', function(){
        var id = $("#student_id").val();
        $.ajax({
            //url: "{{ url("students"). "/" }}"+sid,
            url: '{{ url('students/{id}') }}'.replace('{id}', id),
            //url: "{{ route('reservations.show', "sid") }}",
            type: 'GET',
            data: {
                'id': id
            },
           success: function(result){
                //console.log(result)
                $.each(result, function (key, value) {
                    $('#exampleid').append(value.FNAME+" "+value.LNAME);
                })
           }
        });
    });

</script>
@endsection
