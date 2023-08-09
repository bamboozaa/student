@extends('layouts.layout')
@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap');
        body {
            font-family: 'Mitr', sans-serif;
        }
    </style>
@stop
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>ลงทะเบียนเข้าใช้งานห้อง</h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card border-0 showdow">
                <div class="card-body">
                    <form action="{{ url('/reservations/create') }}" method="get">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::label('room_type', 'ประเภทการใช้งานห้อง') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @foreach ($room_types as $key => $room_type)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="room_type_value" id="Radio{{ $key+1 }}" value="{{ $room_type->id }}">
                                    <label class="form-check-label" for="Radio{{ $key+1 }}">{{ $room_type->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                {!! Form::label('student_id', 'รหัสนักศึกษา') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                {!! Form::text('student_id', null, ['class' => 'form-control', (isset($_GET['student_id'])) ? '' : 'autofocus', 'id' => 'student_id']) !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            header("Location: localhost/reservations/create");
        }
    }
    @endphp


    @if (isset($tis_arr))
        {{-- {{ dd($tis_arr) }} --}}
        {{-- {{ $student_name = $tis_arr['STUDENT_ID'] . " " . $tis_arr['FNAME'] . " " . $tis_arr['LNAME'] }} --}}
        @php
            $student_name = $tis_arr['STUDENT_ID'] . " " . $tis_arr['FNAME'] . " " . $tis_arr['LNAME'];
        @endphp
        <form action="{{ url('/reservations/create') }}" method="get">
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


@endsection
